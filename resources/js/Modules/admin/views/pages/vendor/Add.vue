<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Create vendor',
                        currentRouteName: 'vendor-add',
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
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Password</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.password"
                                    :class="_vClass(_validator.formData,'password')"

                                />
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'password')}}</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Confirm Password</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.password_confirmation"
                                    :class="_vClass(_validator.formData,'password_confirmation')"

                                />
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'password_confirmation')}}</div>
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
                           
                       
                    </div>
                </div>
                <div class="card">
                    <div class="card-body row">
                       
                            <div class="col-md-4">
                                <label
                                    for="validationCustom01"
                                    class="form-label"
                                    >Shop name</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.shop_name"
                                    :class="_vClass(_validator.formData,'shop_name')"
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
                                    v-model="formData.business_email"
                                    :class="_vClass(_validator.formData,'business_email')"
                                />
                                 <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'business_email')}}</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Shop Address</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.shop_address"
                                    :class="_vClass(_validator.formData,'shop_address')"
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
                                    v-model="formData.office_phone"
                                    :class="_vClass(_validator.formData,'office_phone')"
                                />
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'office_phone')}}</div>
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
                                    >Save
                                </button>
                              
                            </div>
                    </div>
                </div>
                
                 </form>
            </div>
                <!-- vendor  -->
          
        </div>
    </div>
</template>
<script>
//image lib
 import UploadImages from "vue-upload-drop-images"
 //form validation
 import useVuelidate from "@vuelidate/core";
import { required,email ,numeric,sameAs ,minLength} from "@vuelidate/validators";
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
            countryList:null,
            formData: {
                user_name: null,
                first_name: null,
                last_name: null,
                user_name: null,
                email: null,
                phone: null,
                mobile: null,
                country: null,
                password: null,
                password_confirmation: null,
                country_code:'+971',

                profile_photo: null,
                //shop
                id:null,
                shop_name:null,
                shop_unique_name:null,
                business_email:null,
                shop_address:null,
                office_phone:null,
                url:'vendor/add'
            }
        };
    },
    validations() {
        return {
            formData: {
                user_name: { required },
                first_name: { required },
                last_name: { required },
                email: { required,email },
                phone      :{required,numeric},
                mobile      :{required,numeric},
                shop_name: { required },
                password: { required, minLength: minLength(6)  },
                password_confirmation: { required,sameAs: sameAs(this.formData.password) },

                business_email: { required ,email },
                last_name: { required },
                shop_address :{required},
                office_phone  :{required ,numeric}
            },
            
            
        };
    },
    mounted() {
        this.$store.dispatch('getData',{url:'country/list'}).then((res)=>{
            console.log(res)
        })
    },
    
    methods: {
        saveData() {
           
            this._validator.$validate();
            if (!this._validator.$error) {
            this.$store.dispatch("saveData", this.formData).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('Vender successfully Created')
                    this.$router.push({name:'vendor-list'})
                }
            });
            }
        },
        
        handleProfileImage(file) {
            if(file){

                this.formData.profile_photo=file[0]
            }else
            {
                this.formData.profile_photo=null

            }
        },
    },
};
</script>
<style lang=""></style>
