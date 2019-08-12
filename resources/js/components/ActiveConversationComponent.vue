<template>
    <b-row class="h-100">
        <b-col cols="8">
             <b-card
                    footer-bg-variant="light"
                    footer-border-variant="dark"
                    title="Conversación activa"
                    class="h-100">

                    <message-conversation-component 
                            v-for="message in messages" 
                            :key="message.id"
                            :written-by-me="message.written_by_me"> <!-- directiva v-bind o : -->
                        {{ message.content }}
                    </message-conversation-component>

                    <div slot="footer">
                        <b-form class="mb-0" @submit.prevent="postMessage">
                            <b-input-group>
                                <b-form-input 
                                        v-model="newMessage" 
                                        class="text-center" 
                                        type="text" placeholder="Escribe un mensaje..." autocomplete="off">
                                </b-form-input>

                                <b-input-group-append>
                                    <b-button type="submit" variant="primary">Enviar</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </b-form>
                    </div>
            </b-card>
        </b-col>

        <b-col cols="4">
            <b-img  blank blank-color="#777" width="60" height="60" class="m-1" 
            rounded="circle" alt="Circle image"></b-img>
            <p>Usuario seleccionado</p>
            <hr>
            <b-form-checkbox>
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            newMessage: '',
            contactId: 2
        }
    },
    mounted() {
       this.getMessages();
    },
    methods: {
        getMessages() {
            axios.get(`/api/messages?contact_id=${this.contactId}`).then( (response)=> {
                this.messages = response.data;
                console.log(response.data);
            });
        },

        postMessage() {
            const params = {
                to_id : this.contactId,
                content: this.newMessage
            };

            axios.post('/api/messages', params ).then((response) => {
                console.log(response);
                if(response.data.success) {
                    this.newMessage = '';
                    this.getMessages();
                }
            });
        }
    },
}
</script>