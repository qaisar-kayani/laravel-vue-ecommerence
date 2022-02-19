<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Edit vendor',
                        currentRouteName: 'vendor-edit',
                        nextRouteName: 'vendor-list',
                        nextRouteHeading: 'Back',
                    }"
                />
    <form class="row g-4 needs-validation" @submit.prevent="saveData" >
                <div class="card">
                    <div class="card-body row">
                            <div class="col-md-4">
                                
                                <label
                                    for="validationCustom01"
                                    class="form-label"
                                    >First name</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.first_name"
                                    :class="_vClass(_validator.formData,'first_name')"
                                />
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Last name</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.last_name"
                                    :class="_vClass(_validator.formData,'last_name')"

                                    
                                    
                                />
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Email</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.email"
                                    :class="_vClass(_validator.formData,'email')"

                                />
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'email')}}</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Mobile No</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.mobile"
                                    :class="_vClass(_validator.formData,'mobile')"

                                />
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'mobile')}}</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >contact No</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.phone"
                                    :class="_vClass(_validator.formData,'phone')"

                                />
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'phone')}}</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Country</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.country"
                                    :class="_vClass(_validator.formData,'country')"

                                />
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'country')}}</div>
                            </div>
                             
                          
                            
                            
                            <div class="col-md-4 mb-5" >
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Profile image</label
                                >
                                  <UploadImages
                                        :max="1"
                                        fileError="images files only accepted"
                                         @changed="handleProfileImage"
                                         >
                                         </UploadImages>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-sm-4" v-if="formData.thumbnail">
                                 <div class="card w-100 mt-5">
                                            <div class="card-body p-5">
                                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Image</h2></div>
                                                <div class="border p-4 d-flex justify-content-center">
                                                    <div class="max-w-20x">
                                                        <img :src="showImage(formData.thumbnail)" class="w-100 h-auto" width="320" height="320" alt="">
                                                    </div>
                                                </div>
                                                <div class="mt-4 mb-n2">
                                                    <a href="#" class="text-danger me-3 pe-2">Remove </a>
                                                </div>
                                            </div>
                                        </div>

                                    
                            </div>
                           <div class="col-12 mt-5">
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
                                    >Update vendor
                                </button>
                              
                            </div>
                       
                    </div>
                    
                </div>
                
                 </form>
            </div>
                <!-- vendor  -->
                <store :store_id="this.$route.params.shop_id"/>
          
        </div>
    </div>
</template>
<script>
//image lib
 import UploadImages from "vue-upload-drop-images"
 //form validation
 import useVuelidate from "@vuelidate/core";
import { required,email ,numeric,sameAs ,minLength} from "@vuelidate/validators";
import store from "./Store.vue"
export default {
    components:{
        UploadImages,
        store
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
            formData: {
                first_name: null,
                last_name: null,
                user_name: null,
                email: null,
                phone: null,
                mobile: null,
                country: null,
                country_code:'+971',

                profile_photo: null,
                new_profile_photo: null,
                //shop
               
            }
        };
    },
    validations() {
        return {
            formData: {
                first_name: { required },
                last_name: { required },
                email: { required,email },
                phone      :{required,numeric},
                mobile      :{required,numeric},
               

            },
            
            
        };
    },
    mounted() {
        this.editData(this.$route.params.vendor_id,'vendor/profile/')
    },
    
    methods: {
        editData(id,url) {
            this.$store.commit('setToast',true)
            this.$store
                .dispatch("getRow", { url: url + id })
                .then((res) => {
                    if (res.status == 200) {
                        this.formData = res.data;
                        this.formData.url = 'vendor/profile/edit/'+id;
                        
                    }
                });
        },
        saveData() {
           
            this._validator.$validate();
            if (!this._validator.$error) {
            this.$store.commit('setToast',true)
            this.$store.dispatch("saveData", this.formData).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('Vender successfully Created')
                    this.formData=res.data
                }
            });
            }
        },
        
        handleProfileImage(file) {
            if(file){

                this.formData.new_profile_photo=file[0]
            }else
            {
                this.formData.new_profile_photo=null

            }
        },
    },
};
</script>
<style lang=""></style>
