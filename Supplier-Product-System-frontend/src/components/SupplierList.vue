<template>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Contact Person</th>
                    <th scope="col">Mobile Number 1</th>
                    <th scope="col">Mobile Number 2</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody v-for="supplier in suppliers" :key="supplier.id">
                <tr class="table-secondary">
                    <th scope="row">{{supplier.id}}</th>
                    <th scope="row">{{supplier.supplier_name}}</th>
                    <th scope="row">{{supplier.contact_person}}</th>
                    <th scope="row">{{supplier.mobile_number_1}}</th>
                    <th scope="row">{{supplier.mobile_number_2}}</th>
                    <th scope="row"><router-link :to="{ name: 'EditSupplier', params: { id: supplier.id }}" class="btn btn-primary btn-sm"    
                        >Edit</router-link></th>
                    <th scope="row"><button class="btn btn-danger btn-sm"    
                        @click.prevent = "deleteSupplier(supplier.id)">Delete</button></th>
                    
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import router from '@/router';
import axios from 'axios';

    export default {
        name: 'SupplierList' ,
        data() {
            return {
                suppliers:Array
            }

        },
        created() {
            this.getSuppliers();
        },
        methods: {
            async getSuppliers() {
                let url = 'http://127.0.0.1:8000/api/suppliers' ;
                await axios.get(url).then(response => {
                    this.suppliers = response.data.suppliers;
                    console.log(this.suppliers);
                }).catch(error => {
                    console.log(error);
                });
            },
            async deleteSupplier(id) {
                let url = `http://127.0.0.1:8000/api/delete_supplier/${id}`;
                await axios.delete(url).then(response => {
                    if(response.data.code == 200) {
                        alert(response.data.message);
                        this.getSuppliers();
                    }
                }).catch(error => {
                    console.log(error);
                });

            }
        },
        mounted() {
            console.log('Supplier List Component mounted');
        }
    }
</script>