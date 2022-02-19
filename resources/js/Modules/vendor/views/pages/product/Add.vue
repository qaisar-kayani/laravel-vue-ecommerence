<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Product',
                        currentRouteName: 'product-add',
                        nextRouteName: 'product-list',
                        nextRouteHeading: 'Back',
                    }"
                />
                <!-- //card  -->
                <form ref="anyName" @submit.prevent="saveProduct" >
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
                                                >Product Name</label
                                            >
                                            <input
                                                v-model="formData.name"
                                                type="text"
                                                class="form-control"
                                                :class="_vClass(_validator.formData,'name')
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
                                                >Product Type </label
                                            >
                                            <select  id="inputState" class="form-select" v-model="formData.type">
                                                <option value="simple">Simple</option>
                                                <option value="configurable">Configurable</option>
                                            </select>
                                             

                                        </div>
                                    </div>
                                            
                                        </div>

                                        <div class="mb-4">
                                            <div>
                                                <label
                                                    for="form-product/short-description"
                                                    class="form-label"
                                                    >Short description</label
                                                >
                                                <textarea
                                                    v-model="formData.summary"
                                                    class="form-control"
                                                    rows="2"
                                                    :class="_vClass(_validator.formData,'summary')"
                                                ></textarea>
                                         <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'summary')}}</div>

                                            </div>
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
                                    </div>
                                </div>
                                <div class="card mt-5">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Pricing
                                            </h2>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label
                                                    for="form-product/price"
                                                    class="form-label"
                                                    
                                                    >Regular Price</label
                                                >
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    v-model="formData.regular_price"
                                                    :class="_vClass(_validator.formData,'regular_price')"
                                                    
                                                />
                                         <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'regular_price')}}</div>

                                            </div>
                                            <div class="col">
                                                <label
                                                    for="form-product/old-price"
                                                    class="form-label"
                                                    >Sale Price</label
                                                >
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    v-model="formData.sale_price"
                                                    :class="_vClass(_validator.formData,'sale_price')"

                                                />
                                         <div class="invalid-feedback">{{_vErrorMessage(_validator.formData,'sale_price')}}</div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end  -->
                                <!-- images  -->
                                 <div class="card w-100 mt-5">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Gallery Image
                                            </h2>
                                        </div>
                                        <UploadImages
                                        :max="5"
                                        fileError="images files only accepted"
                                         @changed="handleGallery"
                                         />
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
                                            />
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
                                            <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">
                                                    keywords
                                                </h2>
                                            </div>
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="formData.seo_keywords"
                                            />
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="sa-entity-layout__sidebar">
                                <div class="card w-100">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Visibility
                                            </h2>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-check">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    name="status"
                                                    value="pending"
                                                    v-model="formData.status"
                                                />
                                                <span class="form-check-label"
                                                    >Pending</span
                                                >
                                            </label>
                                           
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card w-100 mt-5">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Categories
                                            </h2>
                                        </div>
                                       
                                         <treeselect  v-if="options" v-model="formData.category_id" :multiple="true" :options="options" 
                                             value-consists-of="ALL"
                                               search-nested
                                               :flat="true"
                                            
                                         />
                                        <div class="mt-4 mb-n2">
                                        </div>
                                    </div>
                                </div>
                          
                                
                                <div class="card w-100 mt-5">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">
                                                Feature Image
                                            </h2>
                                        </div>
                                        <UploadImages
                                        :max="1"
                                        fileError="images files only accepted"
                                         @changed="handleFeatureImages"
                                         >
                                         </UploadImages>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-b mt-5">
                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            <!--v-if-->Submit form
                        </button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Multiselect from "@suadelabs/vue3-multiselect";
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
    components: { Multiselect,UploadImages,Treeselect},
    setup() {
     
        return {
            _validator: useVuelidate(),
        };
    },

    mounted() {
        this.head_link("assets/css/dropdown.css");
        this.getCategories()
        this.getVendorList()
        
    },
    data() {
        return {
            category: "",
            vendorList:[],
          options:[],  
        
            formSpinner: false,
            formData: {
                name: "",
                category_id: [],
                vendor_id:this.$store.getters.getAuth.vendor.id,
                type: "simple",
                summary: "",
                details: "",
                seo_title: "",
                seo_details: "",
                seo_keywords: "",
                regular_price: 0,
                sale_price: 0,
                sku: "dd",
                by_user: this.$store.getters.getAuth.id,
                feature_image:null,
                gallery:[],
                status:'pending'
            },
        };
    },
    validations() {
        return {
            formData: {
                name: { required:helpers.withMessage('This field cannot be empty', required) },
                
                summary: { required:helpers.withMessage('This field cannot be empty', required) },
                details: { required:helpers.withMessage('This field cannot be empty', required) },
                category_id: { required:helpers.withMessage('This field cannot be empty', required) },
                seo_title: { required:helpers.withMessage('This field cannot be empty', required) },
                regular_price: { required:helpers.withMessage('This field cannot be empty', required) },
                sale_price: { required:helpers.withMessage('This field cannot be empty', required) },
            },
        };
    },
    methods: {
        submit() {
            this.formSpinner = true;
        },
        saveProduct() {
            this._validator.$validate();
            if (!this._validator.$error) {
            this.$store.commit('setToast',true)
            this.$store
                    .dispatch("saveProduct", this.formData)
                    .then((res) => {
                        if (res.status == 200) {
                            this.$toast.success("Product successfull save");
                            if(this.formData.type=='configurable')
                            {
                                this.$router.push({name:'product-attribute',params:{product_id:res.data.data._id}})
                            }else
                            {
                                this.$router.push({name:'product-list'})

                            }
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
         getVendorList()
        {
            this.$store.dispatch('getRow',{url:'vendor/list'}).then((res)=>{

               if(res.status==200) 
               {   let list=[]
                    res?.data.data.data.forEach(element => {
                    list.push({id:element.id,label:element.shop_name})
                    });
                    this.vendorList=list
               }
            })
        },
        handleFeatureImages(file)
        {  
            if(file){

                this.formData.feature_image=file[0]
               
            }else
            {
                this.formData.feature_image=null

            }
           
        },
        handleGallery(file)
        {   
            console.log(file[0])
            if(file)
            {

                this.formData.gallery=file
            }else
            {
                this.formData.gallery=null

            }
                

        },
       
    },
};
</script>
