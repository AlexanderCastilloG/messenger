<template>
    <b-media :right-align="writtenByMe" vertical-align="center" class="mb-2">
        <b-img rounded="circle" slot="aside" :src="image" width="48" alt="placeholder">
        </b-img>
        <b-card>
            <slot></slot>
        </b-card>
    </b-media>
</template>

<script>
export default {
    props: {
        image: String,
        writtenByMe: Boolean
    },
    data() {
        return {
           
        };
    },
}
</script>