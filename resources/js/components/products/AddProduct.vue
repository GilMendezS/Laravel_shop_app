<template>
    <div>
        <h3><i class="fa fa-plus-circle"></i> Add Product</h3>
        <form @submit.prevent="onSubmit">
            <div class="input-field col s12">
                <input v-model="product.name" placeholder="Title...." id="name" type="text" class="validate">
                <label for="name">Title</label>
            </div>
            <div class="input-field col s12">
                <textarea v-model="product.description" id="description" class="materialize-textarea"></textarea>
                <label for="description">Textarea</label>
            </div>
            <div class="input-field col s12">
                <input v-model="product.price" placeholder="$" step="0.0.1" min="0" id="price" type="number" class="validate">
                <label for="price">Price</label>
            </div>
            <div class="switch">
                <label>
                Featured
                <input type="checkbox" v-model="product.featured">
                <span class="lever"></span>
                Not Featured
                </label>
            </div>
            <div class="input-field col s12">
                <div class="row">
                    <div class="sm4">
                        <div class="switch">
                            <label>
                            Limited
                            <input type="checkbox" v-model="product.inlimited">
                            <span class="lever"></span>
                            Inlimited
                            </label>
                        </div>
                    </div>
                    <div class="sm8">
                        <input v-model="product.stock" :disabled="product.inlimited" placeholder="" min="1" id="quantity" type="number" class="validate">
                        <label for="">Quantity</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <input type="text" v-model="product.number" name="" id="product_number">
                    <label for="product_number">Product Number</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" v-model="product.brand" name="" id="brand">
                    <label for="brand">Brand</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" v-model="product.barcode" name="" id="barcode">
                    <label for="barcode">Barcode</label>
                </div>
                
                <div class="input-field col s12">
                    <input type="text" v-model="product.weight" id="weight">
                    <label for="weight">Weight</label>
                </div>
                <div class="input-field col s12">
                    <label for="">Status</label>
                    <select class="browser-default" v-model="product.status_id">
                        <option v-for="status in statuses" :key=status.id :value="status.id">
                            {{status.title}}
                        </option>
                    </select>
                </div>
                
            </div>
            <button :title="titleButton" :disabled="invalidForm" class="btn btn-small black" type="submit">Add <i class="fa fa-plus"></i></button>
            <button @click="cancelAdding" class="btn btn-small red" type="reset">Cancel <i class="fa fa-times"></i></button>
        </form>
    </div>
</template>
<script>
import Product from '../../models/product.js';
export default {
    props: ['statuses'],
    data(){
        return {
            product: new Product('','','',false,0,false,10,'','','','','')
        }
    },
    mouted(){
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, {});
        });
    },
    methods: {
        onSubmit(){
            axios.post(`/api/products`, this.product)
            .then(response => {
                console.log(response.data);
                this.$emit('reloadProducts')
            })
            .catch(err => {
                console.log(err)
            })
        },
        cancelAdding(){
            this.$emit('hideForms');
        }
    },
    computed: {
        invalidForm(){
            return this.product.name == ''
                || this.product.status_id == ''
                || this.product.price == ''
                || this.product.weight == ''
        },
        titleButton(){
            return this.invalidForm ? 'All filds are required' : '';
        }
    }
}
</script>

