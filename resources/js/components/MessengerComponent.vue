<template>
    <b-container fluid style="height: calc(100vh - 56px);">
        <!--no-gutters -> para eliminar todos lo padding de las columnas -->
        <b-row no-gutters class="h-100">
            <b-col cols="4">
                <b-form class="my-3 mx-2">
                    <b-form-input 
                        class="text-center" 
                        type="text" 
                        v-model="querySearch"
                        placeholder="Buscar contacto...">
                    </b-form-input>
                </b-form>

                <!-- escuchar un evento -->
                <contact-list-component 
                    @conversationSelected="changeActiveConversation($event)"
                    :conversations="conversationsFiltered">
                </contact-list-component>
            </b-col>

            <b-col cols="8">
                <active-conversation-component 
                    v-if="selectedConversation"
                    :contact-id="selectedConversation.contact_id"
                    :contact-name="selectedConversation.contact_name"
                    :contact-image="selectedConversation.contact_image"
                    :messages="messages"
                    :my-image="myImageUrl"
                    @messageCreated="addMessage($event)">
                </active-conversation-component>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    props: {
        user: Object
    },
    data() {
        return {
            selectedConversation: null,
            messages: [],
            conversations: [],
            querySearch: ''

        };
    },

    mounted() {
        this.getConversations();

        // Escuchar si te envia un mensaje
        Echo.private(`users.${this.user.id}`)
        .listen('MessageSent', (data) => {
            const message = data.message;
            message.written_by_me = false;

            this.addMessage(message);
        });


        Echo.join('messenger')
            .here((users) => {
                //nos informar que usuarios están presentes
                console.log('online', users);
                users.forEach(user => this.changeStatus(user, true));
            })
            .joining((user) => {
                //nos informa que usuario acaban de ingresar
                console.log('acabo de conectarse', user.id);
                this.changeStatus(user, true);
            })
            .leaving((user) => {
                //nos informa del usuario que acaba de salir
                console.log('usuario retirado', user.id);
                this.changeStatus(user, false);
            });
    },

    methods: {
        changeActiveConversation(conversation) {
            this.selectedConversation = conversation;
            this.getMessages();
        },

        getMessages() {
            axios.get(`/api/messages?contact_id=${this.selectedConversation.contact_id}`)
            .then( (response)=> {
                this.messages = response.data;
            });
        },

        // al enviar un mensaje y escuchar un mensaje
        addMessage(message) {
            const conversation = this.conversations.find( (conversation) => {
                return conversation.contact_id == message.from_id ||
                       conversation.contact_id == message.to_id;
            });

            const author = this.user.id === message.from_id ? 'Tú' : conversation.contact_name;

            conversation.last_message =  `${author}: ${message.content}`;
            conversation.last_time = message.created_at;

            // Primero es cuando te envian el mensaje
            // Segundo cuando tu envias el mensaje
            if(this.selectedConversation.contact_id == message.from_id ||
               this.selectedConversation.contact_id == message.to_id) {
                this.messages.push(message);
                console.log(message);
            }
        },

        getConversations(){
            axios.get('/api/conversations').then((response)=>{
                this.conversations = response.data;
            });
        },

        changeStatus(user, status) {
            const index = this.conversations.findIndex((conversation)=>{
                return conversation.contact_id == user.id;
            });
            
            if(index >= 0){
                // this.conversations[index].online = true;
                this.$set(this.conversations[index], 'online', status);
            }
        }
    },

    computed: {
        conversationsFiltered() {
            return this.conversations.filter((conversation)=>{
                return conversation.contact_name.toLowerCase().includes(this.querySearch.toLowerCase())
            });    
        },

        myImageUrl() {
            return `/users/${this.user.image}`;
        }
    },
}
</script>