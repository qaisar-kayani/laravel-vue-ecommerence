<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Product Attribute ',
                        currentRouteName: 'product-add',
                        nextRouteName: 'product-list',
                        nextRouteHeading: 'Back',
                    }"
                />
                <!-- //card  -->
                    <div class="sa-entity-layout sa-entity-layout--size--lg sa-entity-layout--size--md "
                        data-sa-container-query='{"920":"sa-entity-layout--size--md","1100":"sa-entity-layout--size--lg"}'
                    >
                        <div class="sa-entity-layout__body">
                            <div class="sa-entity-layout__main">
                                <div class="card">
                        <form  @submit.prevent="saveAttribute" v-if="!generated">
                                    <div class="card-body p-5" >
                                        <div v-for="(item, index) in attributeList" :key="index">
                                        <div class="mb-5 mt-5 ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h2 class="mb-0 fs-exact-18 ">
                                                        {{item.name}}
                                                        </h2>
                                                </div>
                                                <div class="col-sm-6">
                                            <button type="button" class="btn btn-sm float-right" style="float:right" @click="removeAttribute(index,item.name)">Remove</button>

                                                </div>
                                            </div>
                                        </div>
                                        <treeselect 
                                            v-model="attribute[item.name]"
                                            :multiple="true"
                                            :options="showAttributeValue(item)"
                                            value-consists-of="ALL"
                                            search-nested
                                            :flat="true"
                                        />
                                        </div>
                                        <div class="col-8 mb-b mt-5">
                                            <button class="btn btn-primary" type="submit">Generate</button>
                                         </div>
                                     
                                    </div>
                                    
                         </form>
                                </div>
                                <!-- end  -->
                                <!-- generated  -->
                                       <div class="card mt-5">
                                         
                                     <form  @submit.prevent="saveProduct" v-if="generated">
                                    <div class="card-body p-5" >
                                        <div class="mb-5 mt-5 ">
                                            
                                             <div  v-for="(item, index) in bulkProductList" :key="index">
                                                <div class="row ">
                                                     <div class="col-sm-2">
                                                         <label class="form-label"><small>Name</small></label>
                                                         <input type="text" class="form-control" v-model="formData[index].name"    />
                                                     </div>
                                                     <div class="col-sm-2">
                                                         <label class="form-label"><small> Sku</small></label>
                                                         <input type="text" class="form-control" v-model="formData[index].sku" />
                                                     </div>

                                                     <div class="col-sm-1" v-for="(i, index) in item.productAttributes " :key="index">
                                                         <label class="form-label"><small> {{toUpperCase(index)}} </small></label>
                                                         <input readonly type="text" class="form-control" :value="i"/>
                                                     </div>
                                                     <div class="col-sm-1">
                                                         <label class="form-label"><small>Stock</small></label>
                                                         <input type="text" class="form-control" v-model="formData[index].stock"/>
                                                     </div>
                                                     <div class="col-sm-1">
                                                         <label class="form-label"><small>Regular Price</small></label>
                                                         <input type="text" class="form-control" v-model="formData[index].regular_price"/>
                                                     </div>
                                                     <div class="col-sm-1">
                                                         <label class="form-label"><small>Sale Price</small></label>
                                                         <input type="text" class="form-control" v-model="formData[index].sale_price"/>
                                                     </div>
                                                     <div class="col-sm-2">
                                                         <div class="row g-3 mt-4">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal"
                                                                data-bs-target=".exampleModal" 
                                                                @click="AddImage(index)"
                                                                >
                                                                <i class="fas fa-images"></i></button>
                                                        </div>
                                                        <!-- <div class="col-auto">
                                                            <button type="button" class="btn btn-primary btn-sm" @click="removeRow(index)">
                                                               <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div> -->
                                                        
                                                    </div>
                                                     </div>
                                                 </div>
                                             </div>
                                        
                                       
                                    </div>
                                        <div class="col-8 mb-b mt-5">
                                            <button class="btn btn-primary" type="submit">save</button>
                                         </div>
                                     
                                    </div>
                                    
                         </form>
                                </div>
                             
                                
   
                            </div>
                            
                           
                        </div>
                       


                    </div>
                        
                    <div>
                               
                    </div>
            </div>
        </div>
    </div>
    <!-- ///model code  -->
    
    <div 
     class="modal fade exampleModal"
    
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button
                    type="button"
                    class="sa-close sa-close--modal"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="card-body p-5">
                    <div class="mb-5">
                        <h2 class="mb-0 fs-exact-18">
                            Feature Image
                        </h2>
                    </div>
                    <UploadImages  ref="featureImage"
                        :max="1"
                        fileError="images files only accepted"
                        @changed="handleFeatureImages"
                    >
                    </UploadImages>
                </div>
                <div class="card-body p-5">
                    <div class="mb-5">
                        <h2 class="mb-0 fs-exact-18">
                            Gallery Image
                        </h2>
                    </div>
                    <UploadImages ref="galleryImage"
                        :max="5"
                        fileError="images files only accepted"
                        @changed="handleGalleryImages"
                    >
                    </UploadImages>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
            </div>
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
   

    mounted() {
        this.getAttributeWithChild()
        

        
    },
    data() {
        return {
            generated:false,
            attributeList:null,
            attribute:{},
            bulkProductList:[],
            currentIndex:null, 
            formData:{
                name:[],
                sku:[],
                attribute:{},
                stock:[],
                regular_price:[],
                sale_price:[],
                feature_image:[],
                gallery:[],
               
            }
        };
    },
    // validations() {
    //     return {
    //         formData: {
    //             name: { required },
    //         },
    //     };
    // },
    methods: {
        
       
        getAttributeWithChild()
        {
            this.$store.dispatch('getData',{url:'catalog/attribute/withchild'}).then((res)=>{
               if(res.status==200)
               {   
                   this.attributeList=res.data.data
                   
                   
                   
               }
            })
        },
        showAttributeValue(item)
        {
       
        let options=[]
           
        options=item.attribute_values.map((list,index)=>{
            return {'id':list.name,'label':list.name}
        })
            return options
        },
        removeAttribute(index,name)
        {   
           this.attribute[name]=null
        
            this.attributeList.splice(index,1)
        },
        saveAttribute()
        {   
            this.$store.commit('setToast',true)
            let url='catalog/product/attribute/generate/'+this.$route.params.product_id
            this.$store.dispatch('saveData',{url,pattributes:this.attribute,requesttype:'POST'}).then((res)=>{
             this.bulkProductList=res.data
             this.formData=res.data
             this.generated=true
            })
        },
        //save bulkproduct
       async saveProduct()
        {  
            this.$store.commit('setToast',true)
            await  this.formData.forEach(element => {
            if(element){
                element.url='/catalog/product/add'
                element.productAttributes=JSON.stringify(element.productAttributes)
                element.type='configurable'
                element.status='pending'
                this.$store.dispatch("saveData", element);
                  }
                });
                this.$router.push({name:'product-list'})
                this.$toast.success('Action Successfully')
        },
        //remove Row
        removeRow(current)
        {       
              this.bulkProductList[current]=null
              this.formData[current]=null
          
        },
        //add image using model
        AddImage(index)
        {   
            this.currentIndex=index
             this.$refs.featureImage.reset()
             this.$refs.galleryImage.reset()
            
            
        },
         handleFeatureImages(file) {
            if (file) {
                this.formData[this.currentIndex].feature_image = file[0];
            } else {
                this.formData[this.currentIndex].feature_image = null;
            }
        },
         handleGalleryImages(file) {
            if (file) {
                this.formData[this.currentIndex].gallery = file;
            } else {
                this.formData[this.currentIndex].gallery = file;
            }
        },
      
        
        
    },
};
</script>
