<template>
    <b-container fluid style="height: calc(100vh - 56px);">
        <!--no-gutters -> para eliminar todos lo padding de las columnas -->
        <b-row no-gutters class="h-100">
            <b-col cols="4">
               <contact-form-component />
                <contact-list-component />
            </b-col>

            <b-col cols="8">
                <active-conversation-component 
                    v-if="selectedConversation"/>
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
        };
    },

    mounted() {
        this.$store.commit('setUser', this.user); // mutation
        
        // action
        this.$store.dispatch('getConversations')
            .then( () => {
                const conversationId = this.$route.params.conversationId;
                if (conversationId) {
                    const conversation = this.$store.getters.getConversationById(conversationId);
                    if(conversation !== undefined){
                        this.$store.dispatch('getMessages', conversation);
                    }
                }
            });
        

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
        // mutations, tener un getter
        changeStatus(user, status) {
            const index = this.$store.state.conversations.findIndex((conversation)=>{
                return conversation.contact_id == user.id;
            });
            
            if(index >= 0){
                // this.conversations[index].online = true;
                this.$set(this.$store.state.conversations[index], 'online', status);
            }
        },

        addMessage(message) {
            this.$store.commit('addMessage', message);
        }
    },

    computed: {
        selectedConversation() {
            return this.$store.state.selectedConversation;
        }
    }
}
</script>