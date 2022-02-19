<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Categories',
                        currentRouteName: 'category-add',
                        nextRouteName: 'category-list',
                        nextRouteHeading: 'Back',
                    }"
                />
                <!-- //card  -->
                <form ref="anyName" @submit.prevent="saveCategory" >
                    <div
                        class="
                            sa-entity-layout
                            sa-entity-layout--size--lg
                            sa-entity-layout--size--md
                        "
                        data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'
                    >
                        <div class="sa-entity-layout__body">
                            <div class="sa-entity-layout__main">
                                <div class="card">
                                    <div class="card-body p-5">
                                        
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Basic information
                                            </h2>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                 <div class="mb-4">
                                            <label
                                                for="form-product/name"
                                                class="form-label"
                                                >Name</label
                                            >
                                            <input
                                                v-model="formData.name"
                                                type="text"
                                                class="form-control"
                                                :class="_vClass(_validator.formData,'name','category name require!')
                                                "
                                            />
                                            <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'name')}}</div>

                                        </div>
                                            </div>
                                            <div class="col-sm-6">
                                                 <div class="mb-4">
                                            <label
                                                for="form-product/name"
                                                class="form-label"
                                                >Parent Categories</label
                                            >
                                            <treeselect  v-if="options" v-model="formData.parent_id" :multiple="true" :options="options" 
                                               :flat="true"
                                                 :show-count="true"
                                               search-nested
                                            
                                         /> 
                                        
                                            <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'name')}}</div>

                                        </div>
                                            </div>
                                        </div>
                                       

                                        <div class="mb-4">
                                            
                                            <label
                                                for="form-product/description"
                                                class="form-label"
                                                >Description</label
                                            >
                                            <textarea
                                                id="form-product/description"
                                                class="form-control"
                                                rows="8"
                                                v-model="formData.details"
                                                :class="_vClass(_validator.formData,'details')"
                                            >
                                            </textarea>
                                            <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'details')}}</div>

                                        </div>
                                        <div class="col-sm-6">
                                                 <div class="mb-4">
                                            <label
                                                for="form-product/name"
                                                class="form-label"
                                                >Filters </label
                                            >
                                            <treeselect  v-if="options" v-model="formData.categoryFilter" :multiple="true" :options="filters" 
                                               :flat="true"
                                                 :show-count="true"
                                               search-nested
                                            
                                         /> 
                                        
                                            <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'name')}}</div>

                                        </div>
                                            </div>
                                    </div>
                                </div>
                                <!-- end  -->
                                <!-- images  -->
                                 <div class="card w-100 mt-5 ">
                                    <div class="card-body p-5 mb-5">
                                        <div class="row mb-5">
                                            <div class="col-sm-4">
                                            <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Category Image
                                            </h2>
                                            </div>
                                        <UploadImages
                                        :max="1"
                                        fileError="images files only accepted"
                                         @changed="handleGallery"
                                         />
                                            </div>
                                        <div class="col-sm-4">
                                            <div class="mb-5">
                                                       <h2 class="mb-0 fs-exact-18">
                                                 Icon Image
                                                 </h2>
                                                </div>
                                                <UploadImages
                                                :max="1"
                                                fileError="images files only accepted"
                                                @changed="handleicon"
                                                />
                                            </div>
                                            <!-- banner images  -->
                                            <div class="col-sm-4">
                                                <div class="mb-5">
                                                       <h2 class="mb-0 fs-exact-18">
                                                 Banner Image
                                                 </h2>
                                                </div>
                                                <UploadImages
                                                :max="1"
                                                fileError="images files only accepted"
                                                @changed="handlebanner"
                                                />
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- seo  -->
                                <div class="card mt-5">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Search engine optimization
                                            </h2>
                                            <div class="mt-3 text-muted">
                                                Provide information that will
                                                help improve the snippet and
                                                bring your product to the top of
                                                search engines.
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label
                                                for="form-product/seo-title"
                                                class="form-label"
                                                >Page title</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="formData.seo_title"
                                                :class="_vClass(_validator.formData,'seo_title')"
                                            />
                                         <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'seo_title')}}</div>

                                        </div>
                                        <div>
                                            <label
                                                for="form-product/seo-description"
                                                class="form-label"
                                                >Meta description</label
                                            >
                                            <textarea
                                                class="form-control"
                                                rows="2"
                                                v-model="formData.seo_details"
                                            ></textarea>
                                        </div>
                                        <div class="mb-b">
                                            <label
                                                for="form-product/seo-description"
                                                class="form-label"
                                                >Keywords</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="formData.seo_keywords"
                                            />
                                        </div>
                                        <div class="col-12 mb-b mt-5">
                                            <button
                                                class="btn btn-primary"
                                                type="submit"
                                            >
                                                <!--v-if-->Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required,helpers } from "@vuelidate/validators";
//image lib
 import UploadImages from "vue-upload-drop-images"
 //dropwown tree
  // import the component
  import Treeselect from 'vue3-treeselect'
  // import the styles
  import 'vue3-treeselect/dist/vue3-treeselect.css'
export default {
    components: { UploadImages,Treeselect},
    setup() {
        return {
            _validator: useVuelidate(),
        };
    },

    mounted() {
        this.head_link("assets/css/dropdown.css");
        this.getCategories()
        this.getAttribute()
        
    },
    data() {
        return {
        category: "",
        options:[],
        filters:[],  
        formSpinner: false,
            formData: {
                url:'catalog/category/add',
                name: "",
                parent_id:[],
                icon:'',
                image:'',
                details: "",
                seo_title: "",
                seo_details: "",
                seo_keywords: "",
                categoryFilter:[],
                bannerImage:''
            },
        };
    },
    validations() {
        return {
            formData: {
                name:{  required: helpers.withMessage('This field cannot be empty', required) },
                details: {  required: helpers.withMessage('This field cannot be empty', required) },
                seo_title: {  required: helpers.withMessage('This field cannot be empty', required) },
            },
        };
    },
    methods: {
        submit() {
            this.formSpinner = true;
        },
        saveCategory() {
            this._validator.$validate();
            if (!this._validator.$error) {
                this.formData.url='catalog/category/add',
                this.$store
                    .dispatch("saveData", this.formData)
                    .then((res) => {
                        console.log(res);
                        if (res.status == 200) {
                            this.$toast.success("Category successfull save");
                        }
                    });
            }
        },
        getCategories()
        {
            this.$store.dispatch('getRow',{url:'catalog/category/allCategories'}).then((res)=>{
                console.log(res)
               if(res.status==200)
               {   
                   this.options=res.data
                   
               }
            })
        },
        getAttribute(page=1) {
            let url='catalog/attribute/list';
           let  query='?page='+page+'&'+'perPage=1000&search='
            this.$store.dispatch("getData",{url,query}).then((res)=>{
               if(res.status==200)
               {    let list=res.data.data.data
                    console.log(list)
                    list.forEach(element => {
                        this.filters.push({id:element._id,label:element.name})    
                    });                   
               }
            })
        },
        handleicon(file)
        {  
            if(file){

                this.formData.icon=file[0]
               
            }else
            {
                this.formData.icon=null

            }
           
        },
        handleGallery(file)
        {   
            if(file)
            {
                this.formData.image=file[0]
            }else
            {
                this.formData.image=null

            }
        },
        handlebanner(file)
        {
            if (file) {
                this.formData.bannerImage=file[0]
            }else
            {
                this.formData.bannerImage=null
            }
        }
       
    },
};
</script>
