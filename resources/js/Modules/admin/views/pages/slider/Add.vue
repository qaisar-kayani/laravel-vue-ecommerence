<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Create slider',
                        currentRouteName: 'slider-add',
                         nextRouteName: 'slider-list',
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
                                    >Name</label
                                ><input
                                    type="text"
                                    class="form-control"
                                    v-model="formData.name"
                                    :class="_vClass(_validator.formData,'name')"
                                />
                               <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'name')}}</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Type</label
                                >
                                <select class="form-select" v-model="formData.type">
                                <option value="home-slider">Home-Slider</option>
                                </select>
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'type')}}</div>
                            </div>
                            <div class="col-md-4">
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    >Status</label
                                >
                                <select class="form-select" v-model="formData.status">
                                <option value="active">Active</option>
                                <option value="inactive">InActive</option>
                            </select>
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'status')}}</div>

                            </div>
                           
                          
                            

                            
                            <div class="col-md-4 mb-5" >
                                <label
                                    for="validationCustom02"
                                    class="form-label"
                                    > image</label
                                >
                                  <UploadImages
                                        :max="5"
                                        fileError="images files only accepted"
                                         @changed="handleProfileImage"
                                         >
                                         </UploadImages>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                           <div class="col-12 mt-5">

                                <button class="btn btn-primary" type="submit">
                                    <span v-if="formSpinner" class="
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
                <!-- slider  -->
          
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
            // _validatorslider: useVuelidate(),
        };
    },
    data() {
        return {
            formSpinner: false,
            countryList:null,
            formData: {
                name: null,
                type: 'home-slider',
                status: 'active',
                images: null,
                url:'admin/plugins/slider/add'
            }
        };
    },
    validations() {
        return {
            formData: {
                name: { required },
                type: { required },
                status: { required },
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
                this.$store.commit('setToast',true)
                this.$store.dispatch("saveData", this.formData).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('slider successfully Created')
                    this.$router.push({name:'slider-list'})
                }
            });
            }
        },
        
        handleProfileImage(file) {
            if(file){

                this.formData.images=file
            }else
            {
                this.formData.images=null

            }
        },
    },
};
</script>
<style lang=""></style>
