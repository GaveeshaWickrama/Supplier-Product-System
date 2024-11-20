<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                 
                <form @submit.prevent="updateSupplier" novalidate>
                    <fieldset>
                        <div class="form-group">
                            <label class="form-label t-4"> Supplier Name</label>
                            <input type="text" class="form-control" v-model="supplier.supplier_name" placeholder="Enter Supplier Name">
                        </div>
                        <div class="form-group">
                            <label class="form-label t-4">Contact Person</label>
                            <input type="text" class="form-control" v-model="supplier.contact_person" placeholder="Enter Contact Person Name">
                        </div>
                        <div class="form-group">
                            <label class="form-label t-4">Mobile Number 1</label>
                            <input type="text" class="form-control" v-model="supplier.mobile_number_1" placeholder="Enter Mobile Number 1">
                        </div>
                        <div class="form-group">
                            <label class="form-label t-4">Mobile Number 2</label>
                            <input type="text" class="form-control" v-model="supplier.mobile_number_2" placeholder="Enter Mobile Number 2">
                        </div>

                        <button class="btn btn-primary mt-4">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EditSupplier' ,
    data() {
        return {
            supplier: {},
            supplier_name: '' ,
            contact_person: '' ,
            mobile_number_1: '' ,
            mobile_number_2: '' ,
            errors: []
        }
        
    },
    created() {
        this.getSupplierById();
    },
    methods: {
        async getSupplierById() {
            let url = `http://127.0.0.1:8000/api/get_supplier/${this.$route.params.id}`;
            await axios.get(url).then(response => {
                console.log(response);
                this.supplier = response.data;
            });
        },
        mounted: function() {
            console.log('Edit Component Form Component Loaded...');
        },


        async updateSupplier() {
            this.errors = [];
            if(!this.supplier.supplier_name) {
                this.errors.push("Supplier Name is required")
            }else if (!/^[a-zA-Z]+$/.test(this.supplier.supplier_name)) {
                this.errors.push("Supplier Name can only contain letters");
            }

            if(!this.supplier.contact_person) {
                this.errors.push("Contact Person is required")
            }else if (!/^[a-zA-Z]+$/.test(this.supplier.contact_person)) {
                this.errors.push("Contact Person can only contain letters");
            }

            if(!this.supplier.mobile_number_1) {
                this.errors.push("One Mobile Number is required")
            }else if (!/^\d{10}$/.test(this.supplier.mobile_number_1)) {
                this.errors.push("Mobile number 1 must include only 10 digits");
            }

            if ((this.supplier.mobile_number_2)  && (!/^\d{10}$/.test(this.supplier.mobile_number_2))) {
                this.errors.push("Mobile number 2 must include only 10 digits");
            }

            if(!this.errors.length){
                let formData = new FormData();
                formData.append('supplier_name', this.supplier.supplier_name);
                formData.append('contact_person', this.supplier.contact_person);
                formData.append('mobile_number_1', this.supplier.mobile_number_1);
                formData.append('mobile_number_2', this.supplier.mobile_number_2);
                let url = `http://127.0.0.1:8000/api/update_supplier/${this.$route.params.id}`;
                await axios.post(url, formData).then((response) => {
                    console.log(response);
                    if(response.status == 200){
                        alert(response.data.message);
                    }else{
                        console.log('error');
                    }
                }).catch(error => {
                    this.errors.push(error.response);        
                });
            }

        }
    }
}
</script>