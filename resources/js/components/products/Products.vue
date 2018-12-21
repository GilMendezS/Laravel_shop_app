<template>
    <v-add-product :statuses="statuses"></v-add-product>
</template>
<script>
import AddProduct from './AddProduct.vue';
export default {
    components: {
        'v-add-product': AddProduct
    },
    data(){
        return {
            statuses: []
        }
    },
    mounted() {
        this.getStatuses();
    },
    methods: {
        getStatuses(){
            axios.get(`/api/statuses`)
            .then(response => {
                console.log(response.data)
                this.statuses = response.data;
            })
            .catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
