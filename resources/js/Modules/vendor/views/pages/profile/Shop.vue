<template lang="">
    <div class="container">
               <div class="py-5">
                            <div class="row g-4 align-items-center">
                                <div class="col">
                                    
                                    <h1 class="h3 m-0">Store</h1>
                                </div>
                                
                            </div>
                        </div>
                <div class="card">
                    <div class="card-body">
                        <form
                            class="row g-4 needs-validation"
                            @submit.prevent="updateStore"
                        >
                            <div class="col-md-4">
                                <label
                                    for="validationCustom01"
                                    class="form-label"
                                    >Shop name</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="vendorForm.shop_name"
                                    :class="_vClass(_validator.vendorForm,'shop_name')"
                                />
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                             <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Business Email</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="vendorForm.business_email"
                                    :class="_vClass(_validator.vendorForm,'business_email')"

                                />
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Shop Address</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="vendorForm.shop_address"
                                    :class="_vClass(_validator.vendorForm,'shop_address')"

                                />
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                           
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    > contact No</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="vendorForm.office_phone"
                                    :class="_vClass(_validator.vendorForm,'office_phone')"

                                />
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                           

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">
                                    <span
                                        v-if="formSpinner"
                                        class="
                                            spinner-grow spinner-grow-sm
                                            me-3
                                        "
                                        role="status"
                                        aria-hidden="false"
                                    >
                                    </span
                                    >Update Store
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
</template>
<script>
//image lib
 import UploadImages from "vue-upload-drop-images"
 //form validation
 import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
export default {
    components:{
        UploadImages
    },
    setup() {
        return {
            _validator: useVuelidate(),
            // _validatorVendor: useVuelidate(),
        };
    },
    data() {
        return {
            formSpinner: false,
            
            vendorForm:{
                id:this.$store.getters.getAuth.vendor.id,
                shop_name:this.$store.getters.getAuth.vendor.shop_name,
                shop_unique_name:this.$store.getters.getAuth.vendor.shop_unique_name,
                business_email:this.$store.getters.getAuth.vendor.business_email,
                shop_address:this.$store.getters.getAuth.vendor.shop_address,
                office_phone:this.$store.getters.getAuth.vendor.office_phone,
                url:'vendor/edit/'+this.$store.getters.getAuth.vendor.id
            }
        };
    },
    validations() {
        return {
         
            vendorForm: {
                shop_name: { required },
                business_email: { required },
                shop_address :{required},
                office_phone  :{required}
            },
            
        };
    },
 
    methods: {
       
        updateStore() {
           
            this._validator.$validate();
            if (!this._validator.$error) {
                // this.vendorForm.requesttype='FilePOST'
            this.$store.dispatch("saveData", this.vendorForm).then((res)=>{
                if (res.status==200) {
                   
                    console.log(res.data.data.vendor)
                    this.$store.commit('setVendor',res?.data?.data.vendor)
                    localStorage.setItem('vendor_auth',JSON.stringify(this.$store.getters.getAuth))
                    this.$toast.success("Action Successfully");

                }
            });
            }
            
        },
        handleShopeImage(file) {
            if(file){

                this.vendorForm.profile_photo=file[0]
            }else
            {
                this.vendorForm.profile_photo=null

            }
        },
    },
};
</script>
<style lang=""></style>
