<template>
    <b-row class="h-100">
        <b-col cols="8">
             <b-card no-body
                    footer-bg-variant="light"
                    footer-border-variant="dark"
                    title="Conversación activa"
                    class="h-100">

                    <b-card-body class="card-body-scroll">
                        <message-conversation-component 
                                v-for="message in messages" 
                                :key="message.id"
                                :image="message.written_by_me ? myImage   : contactImage "
                                :written-by-me="message.written_by_me"> <!-- directiva v-bind o : -->
                            {{ message.content }}
                        </message-conversation-component>
                    </b-card-body>

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
            <b-img  :src="contactImage" width="60" height="60" class="m-1" 
            rounded="circle" alt="Circle image"></b-img>
            <p>{{ contactName }}</p>
            <hr>
            <b-form-checkbox>
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<style>
    .card-body-scroll {
        max-height: calc(100vh - 63px);
        overflow-y: auto;
    }    
</style>

<script>
export default {
    props: {
        contactId: Number,
        contactName: String,
        contactImage: String,
        myImage: String,
        messages: Array
    },

    data() {
        return {
            newMessage: ''
        }
    },
    mounted() {
        // eventBus.$on('example', function(data) {
        //     console.log('Ocurrió el evento example', data);
        // });
    },
    methods: {
        postMessage() {
            const params = {
                to_id : this.contactId,
                content: this.newMessage
            };

            axios.post('/api/messages', params )
                 .then((response) => {
                    if(response.data.success) {
                        this.newMessage = '';
                        const message = response.data.message;
                        message.written_by_me = true;
                        this.$emit('messageCreated', message);
                    }
                });
        },

        scrollToBottom() {
            const el = document.querySelector('.card-body-scroll');
            el.scrollTop = el.scrollHeight;
        }
    },
    updated() {
        this.scrollToBottom();
    },
    // watch: {
    //     messages() {
    //         setTimeout(() => {
    //             this.scrollToBottom();
    //         }, 100);
    //         console.log('mesanje')
    //     }
    // },
    // para observar cambios de una propiedad
    // watch: {
    //     // es el mismo nombre de tu propiedad (props)
    //     contactId(value){
    //         // console.log(`contactId => ${this.contactId}`);
    //         this.getMessages();
    //     }
    // },
}
</script>