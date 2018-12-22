<template>
    <div>
        <div v-show="!showingForms">
            <table class="striped highlight centered responsive-table" >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Inlimited</th>
                        <th>Stock</th>
                        <th>Barcode</th>
                        <th>Weight</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{product.name}}</td>
                        <td>{{product.description}}</td>
                        <td>{{product.price}}</td>
                        <td>{{product.status ? product.status.title : ''}}</td>
                        <td>{{product.featured ? 'Yes' : 'No'}}</td>
                        <td>{{product.inlimited ? 'Yes' : 'No'}}</td>
                        <td>{{product.stock}}</td>
                        <td>{{product.barcode}}</td>
                        <td>{{product.weight}}</td>
                        <td>
                            <button class="btn black btn-small" @click="onEditProduct(product)"><i class="fa fa-edit"></i></button>
                            <button class="btn red btn-small" @click="onRemoveProduct(product)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="right">
                <ul class="pagination">
                    <li :class="{'disabled': !canSeePreviousPage}"><a @click="prevPage" href="#!"><i class="fa fa-chevron-left"></i></a></li>
                    <li class="waves-effect" :class="{'active': pagination.current_page == page}" v-for="page in pagination.last_page" :key="page"><a @click="getProducts(`${pagination.path}?page=${page}`)" href="#!">{{page}}</a></li>
                    <li :class="{'disabled': !canSeeeNextPage}"><a @click="nextPage" href="#!"><i class="fa fa-chevron-right"></i></a></li>
                </ul>
            </div>

            
        </div>
        
        <v-add-product  
            @hideForms="onHideForms"
            @reloadProducts="onReloadProducts"
        v-show="addingProduct" :statuses="statuses"></v-add-product>
        <div class="fixed-action-btn">
            <a v-show="!addingProduct" @click="addingProduct = true" class="btn-floating btn-large black">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    
</template>
<script>
import AddProduct from './AddProduct.vue';
export default {
    components: {
        'v-add-product': AddProduct
    },
    data(){
        return {
            statuses: [],
            products: [],
            addingProduct: false,
            productId: '',
            pagination: null
        }
    },
    mounted() {
        this.getStatuses();
        this.getProducts(`/api/products`);
    },
    methods: {
        getProducts(url){
            axios.get(url)
            .then(response => {
                console.log(response.data)
                this.products = response.data.data;
                this.pagination = response.data;
                console.log(this.products)
            })
            .catch(err => {
                console.log(err)
            })
        },
        getStatuses(){
            axios.get(`/api/statuses`)
            .then(response => {
                console.log(response.data)
                this.statuses = response.data;
            })
            .catch(err => {
                console.log(err)
            })
        },
        onReloadProducts(){
            this.getProducts(this.pagination.path)
        },
        onHideForms(){
            this.addingProduct = false;
            this.productId = '';
        },
        onEditProduct(product){

        },
        onRemoveProduct(priduct){

        },
        nextPage(){
            this.getProducts(this.pagination.next_page_url);
        },
        prevPage(){
            this.getProducts(this.pagination.prev_page_url);
        }
    },
    computed: {
        showingForms(){
            return this.addingProduct || this.productId != '';
        },
        canSeeeNextPage(){
            return this.pagination.next_page_url && this.pagination.next_page_url != null;
        },
        canSeePreviousPage(){
            return this.pagination.prev_page_url && this.pagination.prev_page_url != null
        }
    }
}
</script>
