<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Create Attribute',
                        currentRouteName: 'attribute-add',
                         nextRouteName: 'attribute-list',
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
                                    code="text"
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
                                    >code</label
                                >
                                <input
                                    code="text"
                                    class="form-control"
                                    v-model="formData.code"
                                    :class="_vClass(_validator.formData,'code')"
                                />
                                
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'code')}}</div>
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
                           
                          
                            

                          
                           <div class="col-12 mt-5">

                                <button class="btn btn-primary" code="submit">
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
                <!-- attribute  -->
          
        </div>
    </div>
</template>
<script>
 //form validation
 import useVuelidate from "@vuelidate/core";
import { required,email ,numeric,sameAs ,minLength} from "@vuelidate/validators";
export default {
   
    setup() {
        return {
            _validator: useVuelidate(),
            // _validatorattribute: useVuelidate(),
        };
    },
    data() {
        return {
            formSpinner: false,
            countryList:null,
            formData: {
                name: null,
                code: '',
                status: 'active',
                images: null,
                url:'catalog/attribute/add'
            }
        };
    },
    validations() {
        return {
            formData: {
                name: { required },
                code: { required },
                status: { required },
            },
            
            
        };
    },
    mounted() {
        
    },
    
    methods: {
        saveData() {
           
            this._validator.$validate();
            if (!this._validator.$error) {
            this.$store.dispatch("saveData", this.formData).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('attribute successfully Created')
                    this.$router.push({name:'attribute-list'})
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
