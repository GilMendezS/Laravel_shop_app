<template>
    <div>
        
        <table class="striped highlight centered responsive-table" v-show="!showingForms">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="status in statuses" :key="status.id">
                    <td>{{status.title}}</td>
                    <td>{{status.description}}</td>
                    <td>
                        <button class="btn black btn-small" @click="onEditStatus(status)"><i class="fa fa-edit"></i></button>
                        <button class="btn red btn-small" @click="onRemoveStatus(status)"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <v-edit-status @hideForms="onHideForms" v-show="statusEditing" :id="statusEditing"
            @reloadStatuses="onReloadStatuses"
        ></v-edit-status>
        <v-add-status
            v-show="addingStatus"
            @reloadStatuses="onReloadStatuses"
            @hideForms="onHideForms"
        >
        </v-add-status>
        <div class="fixed-action-btn">
            <a v-show="!addingStatus" @click="addingStatus = true" class="btn-floating btn-large black">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</template>
<script>
import AddStatus from './AddStatus.vue';
import EditStatus from './EditStatus.vue';
export default {
    components: {
        'v-edit-status': EditStatus,
        'v-add-status': AddStatus
    },
    data(){
        return {
            statuses: [],
            statusEditing: '',
            addingStatus: false
        }
    },
    mounted(){
        this.getStatuses();
    },
    methods: {
        getStatuses(){
            axios.get('/api/statuses')
            .then(response => {
                console.log(response);
                this.statuses = response.data;
            })
            .catch(err => {
                console.log(err);
            })
        },
        onEditStatus(status){
            this.statusEditing = status.id;
        },
        onReloadStatuses(){
            this.getStatuses();
        },
        onRemoveStatus(status){
            this.confirmDelete(status.id);
        },
        confirmDelete(id){
            axios.delete(`/api/statuses/${id}`)
            .then(response => {
                console.log(response.data)
                this.statuses = this.statuses.filter( s => s.id !== id );
            })
            .catch(err => {
                console.log(err)
            })
        },
        onHideForms(){
            this.statusEditing = '';
            this.addingStatus = false;
        }
    },
    computed: {
        showingForms(){
            return this.addingStatus || this.statusEditing != '';
        },
        
    }
}
</script>
