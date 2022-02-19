<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Profile',
                        currentRouteName: 'profile',
                        nextRouteName: '',
                        nextRouteHeading: '',
                    }"
                />
                <div class="card">
                    <div class="card-body">
                        <form
                            class="row g-4 needs-validation"
                            @submit.prevent="updateProfile"
                        >
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
                            <!-- <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >User name</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.user_name"
                                    :class="_vClass(_validator.formData,'user_name')"

                                />
                                <div class="valid-feedback">Looks good!</div>
                            </div> -->
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
                                <div class="valid-feedback">Looks good!</div>
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
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-4"></div>
                            <div class="row">
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
                            <div class="col-sm-4" >
                                 <div class="card w-100 mt-5">
                                            <div class="card-body p-5">
                                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Image</h2></div>
                                                <div class="border p-4 d-flex justify-content-center">
                                                    <div class="max-w-20x">
                                                        <img :src="showImage($store.getters.getAuth.profile_photo)" class="w-100 h-auto" width="320" height="320" alt="">
                                                    </div>
                                                </div>
                                                <div class="mt-4 mb-n2">
                                                    <a href="#" class="text-danger me-3 pe-2">Remove </a>
                                                </div>
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
                                    >Update Profile
                                </button>
                           
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
                <!-- vendor  -->
                <shop/>
        </div>
    </div>
</template>
<script>
//image lib
 import UploadImages from "vue-upload-drop-images"
 //form validation
 import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import shop from './Shop.vue'
export default {
    components:{
        UploadImages,
        shop
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
                id: this.$store.getters.getAuth.id,
                user_name: null,
                first_name: this.$store.getters.getAuth.first_name,
                last_name: this.$store.getters.getAuth.last_name,
                user_name: this.$store.getters.getAuth.user_name,
                phone: this.$store.getters.getAuth.phone,
                mobile: this.$store.getters.getAuth.mobile,
                profile_photo: this.$store.getters.getAuth.profile_photo,
               

            },
            
        };
    },
    validations() {
        return {
            formData: {
                // user_name: { required },
                first_name: { required },
                last_name: { required },
                phone      :{required},
                mobile      :{required}
            },
           
            
        };
    },
    
    methods: {
        updateProfile() {
            // this.formSpinner = true;
           
            this._validator.$validate();
            if (!this._validator.$error) {
            this.$store.dispatch("uploadProfile", this.formData).then((res)=>{
                if (res.status==200) {
                     this.$toast.success("Action Successfully");
                }
            })
            // this.formSpinner = false;
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
