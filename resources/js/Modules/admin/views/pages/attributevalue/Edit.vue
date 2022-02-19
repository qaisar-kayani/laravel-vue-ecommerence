<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Edit attribute value',
                        currentRouteName: 'attributevalue-edit',
                         nextRouteName: 'attributevalue-list',
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
                                    >Attribute</label
                                >
                                <select class="form-select" v-model="formData.attribute_id">
                                 <option v-for="(i,idx) in attributeList" :value="i._id">{{ i.name }}</option>
                            </select>
                                <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'attribute_id')}}</div>

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
            // _validatorattribute: useVuelidate(),
        };
    },
    data() {
        return {
            attributeList:null,
            formData: {
                
                name: null,
                code: null,
                status: null,
                attribute_id:null,

                
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

       this.editData(this.$route.params.id,'catalog/attribute/attributevalue/list/');
       this.$store.dispatch('getData',{url:'catalog/attribute/list'}).then((res)=>{
            this.attributeList=res.data.data.data
            this.formData.attribute_id=res.data.data.data[0]._id
        })
    },
    
    methods: {
         editData(id,url) {
            this.$store
                .dispatch("getRow", { url: url + id })
                .then((res) => {
                    if (res.status == 200) {
                        
                        this.formData = res.data.data;
                    }
                });
        },
        saveData() {
           
            this._validator.$validate();
            if (!this._validator.$error) {
                this.formData.url='catalog/attribute/attributevalue/edit/'+this.$route.params.id
                
            this.$store.dispatch("saveData", this.formData).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('attribute successfully Created')
                    this.$router.push({name:'attributevalue-list'})
                }
            });
            }
        },
       
        
        
    },
};
</script>
<style lang=""></style>
