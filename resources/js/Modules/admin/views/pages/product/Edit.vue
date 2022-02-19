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
                <form ref="anyName" @submit.prevent="saveProduct">
                    <div class="sa-entity-layout sa-entity-layout--size--lg
                            sa-entity-layout--size--md "
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
                                                        :class="
                                                            _vClass(
                                                                _validator.formData,
                                                                'name'
                                                            )
                                                        "
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-4">
                                                    <label
                                                        for="form-product/name"
                                                        class="form-label"
                                                        >Vendors</label
                                                    >
                                                    <treeselect
                                                        v-if="editAble"
                                                        v-model="
                                                            formData.vendor_id
                                                        "
                                                        :options="vendorList"
                                                    />
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
                                                ></textarea>
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
                                            >
                                            </textarea>
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
                                                    v-model="
                                                        formData.regular_price
                                                    "
                                                />
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
                                                    v-model="
                                                        formData.sale_price
                                                    "
                                                />
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
                                <!-- images  -->
                             <div class="row">
                                    <div class="col-sm-4" v-for="(item, index) in formData.gallery"  :key="index" :src="showImage(item.images)">
                                        <div class="card w-100 mt-5">
                                            <div class="card-body p-5">
                                                <!-- <div class="mb-5"><h2 class="mb-0 fs-exact-18">Image</h2></div> -->
                                                <div class="border p-4 d-flex justify-content-center">
                                                    <div class="max-w-20x">
                                                       
                                                        <img :src="showImage(item.thumbnail)" class="w-100 h-auto" width="320" height="320" alt="">
                                                    </div>
                                                </div>
                                                <div class="mt-4 mb-n2">
                                                    <span @click="removeImage(item,this.$route.params.id,index)"   class="text-center badge badge-sa-pill badge-sa-danger me-3 pe-2">Remove </span>
                                                </div>
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
                                           
                                            <label class="form-check mb-0">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    name="status"
                                                     value="active"
                                                    v-model="formData.status"
                                                />
                                                <span class="form-check-label"
                                                    >Active</span
                                                >
                                            </label>
                                             <label class="form-check mb-0">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    name="status"
                                                    value="inactive"
                                                    v-model="formData.status"
                                                />
                                                <span class="form-check-label"
                                                    >Hidden</span
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

                                        <treeselect
                                            required
                                            v-if="editAble"
                                            v-model="formData.category_id"
                                            :multiple="true"
                                            :options="options"
                                            value-consists-of="ALL"
                                            search-nested
                                            :flat="true"
                                        />

                                        <div class="mt-4 mb-n2"></div>
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
                                     <!-- edit imagers  -->
   
    
                                <div class="row">
                                    <div class="col-sm-12" v-if="formData.thumbnail">
                                        <div class="card w-100 mt-5">
                                            <div class="card-body p-5">
                                                <div class="mb-5"><h2 class="mb-0 fs-exact-18">Image</h2></div>
                                                <div class="border p-4 d-flex justify-content-center">
                                                    <div class="max-w-20x">
                                                        <img :src="showImage(formData.thumbnail)" class="w-100 h-auto" width="320" height="320" alt="">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                </div>
                            </div>
                           
                        </div>
                       


                    </div>
                        
                    <div>
                             <div class="col-8 mb-b mt-5">
                                <button
                                    class="btn btn-primary"
                                    type="submit"
                                >
                                    <!--v-if--> Update
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
import { required } from "@vuelidate/validators";
//image lib
import UploadImages from "vue-upload-drop-images";
//dropwown tree
// import the component
import Treeselect from "vue3-treeselect";
// import the styles
import "vue3-treeselect/dist/vue3-treeselect.css";
export default {
    components: { Multiselect, UploadImages, Treeselect },
    setup() {
        return {
            _validator: useVuelidate(),
        };
    },

    mounted() {
        this.getProduct(this.$route.params.id);

        this.$store.commit("setToast", true);
        this.getCategories();
        this.getVendorList();
    },
    data() {
        return {
            category: "",
            editAble:false,
            vendorList: [],
            options: [],
            
            formSpinner: false,
            formData: {
                name: "",
                category_id: [],
                vendor_id: null,
                type: "Simple",
                summary: "",
                details: "",
                seo_title: "",
                seo_details: "",
                seo_keywords: "",
                regular_price: 0,
                sale_price: 0,
                sku: "dd",
                by_user: this.$store.getters.getAuth.id,
                feature_image: null,
                gallery: [],
                new_feature_image: null,
                new_gallery: [],
            },
        };
    },
    validations() {
        return {
            formData: {
                name: { required },
                category_id: { required },
                summary: { required },
            },
        };
    },
    methods: {
        getProduct(id) {
            this.$store.commit('setToast',true)
            this.$store
                .dispatch("getRow", { url: "catalog/product/list/" + id })
                .then((res) => {
                    if (res.status == 200) {
                        console.log(res.data.data);
                        this.formData = res.data.data;
                        this.editAble=true
                    }
                });
        },
        submit() {
            this.formSpinner = true;
        },
        saveProduct() {
            this._validator.$validate();
            if (!this._validator.$error) {
                this.$store
                    .dispatch("updateProduct", this.formData)
                    .then((res) => {
                        if (res.status == 200) {
                            this.$toast.success("Product successfull Update");
                            this.formData = res.data.data;
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
        getVendorList() {
            this.$store
                .dispatch("getRow", { url: "vendor/list" })
                .then((res) => {
                    if (res.status == 200) {
                        let list = [];
                        res?.data.data.data.forEach((element) => {
                            list.push({
                                id: element.id,
                                label: element.shop_name,
                            });
                        });
                        this.vendorList = list;
                    }
                });
        },
        removeImage(data,id,index)
        {   
            data.url='catalog/product/gallery/delete/'+id
            this.$store.dispatch('delRow',data)

        },
        handleFeatureImages(file) {
            if (file) {
                this.formData.new_feature_image = file[0];
            } else {
                this.formData.new_feature_image = null;
            }
        },
        handleGallery(file) {
            if (file) {
                this.formData.new_gallery = file;
            } else {
                this.formData.new_gallery = file;
            }
        },
    },
};
</script>
