<template>
    <b-list-group>
        <contact-component 
            v-for="conversation in conversationsFiltered" 
            :key="conversation.id"
            :conversation="conversation"
            :selected="isSelected(conversation)"
            @click.native="selectConversation(conversation)">
        </contact-component>
    </b-list-group>
</template>

<script>
export default {

    methods: {
        selectConversation(conversation) {
             // dispatch es para llamar un action
            this.$store.dispatch('getMessages', conversation);
        },

        isSelected(conversation) {
            if(this.selectedConversation)
                return this.selectedConversation.id === conversation.id
            
            return false;
        }
    },

    computed: {
        selectedConversation() {
            return this.$store.state.selectedConversation;
        },

        conversationsFiltered() {
            // getters.->para llamar los getter de la conversations
            return this.$store.getters.conversationsFiltered;
        }
    }
}
</script>