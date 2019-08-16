<template>
     <b-img 
        :blank-color="online ? 'green' : 'gray'" 
        :title="online ? 'Conectado' : 'Desconectado'"
        width="10" height="10" blank
        rounded="circle" alt="Circle image">
    </b-img>
</template>

<script>
export default {
    props: {
        online: Boolean
    },

    data() {
        return {
            
        }
    },
}
</script>