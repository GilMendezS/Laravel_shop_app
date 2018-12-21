<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div class="input-field xs12">
                <input v-model="status.title" placeholder="Title...." id="title" type="text" class="validate">
                <label for="first_name">Title</label>
            </div>
            <div class="input-field-xs12">
                <textarea v-model="status.description" id="description" class="materialize-textarea"></textarea>
                <label for="description">Textarea</label>
            </div>
            <button :title="titleButton" :disabled="invalidForm" class="btn btn-small black" type="submit">Update <i class="fa fa-sync-alt"></i></button>
            <button @click="cancelEditing" class="btn btn-small red" type="reset">Cancel <i class="fa fa-times"></i></button>
        </form>
    </div>
</template>
<script>
import Status from '../../models/status.js';
export default {
    props: ['id'],
    data(){
        return {
            status: new Status('', '', '', '' ,'')
        }
    },
    methods: {
        getStatus(id){
            axios.get(`/api/statuses/${id}`)
            .then(response => {
                console.log(response)
                this.status = response.data;
            })
            .catch(err => {
                console.log(err)
            })
        },
        onSubmit(){
            axios.put(`/api/statuses/${this.id}`, this.status)
            .then(response => {
                console.log(response.data)
                this.$emit('reloadStatuses');
            })
            .catch(err => {
                console.log(err)
            })
        },
        cancelEditing(){
            this.$emit('hideForms')
        }
    },
    computed: {
        invalidForm(){
            return this.status.title == ''
        },
        titleButton(){
            return this.invalidForm ? 'Title is required' : ''
        }
    },
    watch: {
        id(value){
            if(value != ''){
                this.getStatus(value)
            }
        }
    }
}
</script>
