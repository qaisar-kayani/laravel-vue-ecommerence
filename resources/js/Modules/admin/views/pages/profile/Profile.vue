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
                            <div class="col-md-4">
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
                                {{ this.file }}
                            </div>
                        </form>
                    </div>
                </div>
                
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
            formData: {
                id: this.$store.getters.getAuth.id,
                user_name: null,
                first_name: this.$store.getters.getAuth.first_name,
                last_name: this.$store.getters.getAuth.last_name,
                user_name: this.$store.getters.getAuth.user_name,
                phone: this.$store.getters.getAuth.phone,
                mobile: this.$store.getters.getAuth.mobile,
                profile_photo: null,
            },
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
            formData: {
                user_name: { required },
                first_name: { required },
                last_name: { required },
                phone      :{required},
                mobile      :{required}
            },
            // vendorForm: {
            //     shop_name: { required },
            //     business_email: { required },
            //     last_name: { required },
            //     shop_address :{required},
            //     office_phone  :{required}
            // },
            
        };
    },
    //  validations() {
    //     return {
    //         vendorForm: {
    //             shop_name: { required },
    //             business_email: { required },
    //             last_name: { required },
    //             shop_address :{required},
    //             office_phone  :{required}
    //         },
    //     };
    // },
    methods: {
        updateProfile() {
            // this.formSpinner = true;
            this._validator.$validate();
            if (!this._validator.$error) {
            this.$store.dispatch("uploadProfile", this.formData);
            // this.formSpinner = false;
            }
        },
        updateStore() {
            this.$store.dispatch("updateData", this.vendorForm).then((res)=>{
                if (res.status==200) {
                    console.log(res.data.data.vendor)
                    this.$store.commit('setVendor',res?.data?.data.vendor)
                    localStorage.setItem('vendor_auth',JSON.stringify(this.$store.getters.getAuth))
                    this.$toast.success("Action Successfully");

                }
            });
            
        },
        handleProfileImage(file) {
            if(file){

                this.formData.profile_photo= this.imageBase64(file)
                
                this.formData.profile_photo=this.formData.profile_photo[0]
            }else
            {
                this.formData.profile_photo=null

            }
        },
    },
};
</script>
<style lang=""></style>
