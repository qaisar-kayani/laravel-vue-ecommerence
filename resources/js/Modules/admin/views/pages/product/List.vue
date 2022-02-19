<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Product',
                        currentRouteName: 'product-list',
                        nextRouteName: 'product-add',
                        nextRouteHeading: 'Create New',
                    }"
                />
                <div class="card">
                    <div class="p-4">
                        <div class="row">
                            <div class="col-sm-3">
                                 <label for="validationCustom01" class="form-label">Product name</label>
                                    <input type="text" placeholder="Start typing to search for product"
                                        class="form-control form-control--search mx-auto"
                                        id="table-search"
                                        v-model="nameSearch"
                                    />    
                            </div>
                            <div class="col-md-3">
                                <label for="validationDefault04" class="form-label">Product Status</label
                                ><select class="form-select" id="validationDefault04" v-model="searchProductStatus" >
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="pending">Pending</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn mt-5" @click="fetchProduct()">Search</button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="sa-divider"></div>
                    <div class="card-body">
                     
                    <table
                        class="table"
                        data-order='[[ 1, "asc" ]]'
                        data-sa-search-input="#table-search"
                    >
                        <thead>
                            <tr>
                                
                                <th class="w-max">Name</th>
                                <th>Regular  Price</th>
                                <th>Sale  Price</th>
                                <th>Image</th>
                                <th>status</th>
                                <th>Date</th>
                                <th class="w-min" data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody  >
                            <tr v-for="(item, index) in this.$store.getters.getProductList?.data?.data.data" :key="index">
                                <td>
                                   {{item?.name}}
                                </td>
                                <td>
                                    {{vpNum(item.regular_price)}}
                                </td>
                                <td>
                                    {{item.sale_price}}
                                </td>
                                <td>
                                    <img :src="showImage(item.thumbnail)" />
                                </td>
                                <td><span :class="productStatus(item.status)">{{toUpperCase(item.status)}}</span></td>
                                
                                <td class="text-nowrap">{{vpDate(item.created_at)}}</td>
                                
                                <td>
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-sa-muted btn-sm"
                                            type="button"
                                            :id="'customer-context-menu-'+index"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                            aria-label="More"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="3"
                                                height="13"
                                                fill="currentColor"
                                            >
                                                <path
                                                    d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                                                ></path>
                                            </svg>
                                        </button>
                                        <ul
                                            class="
                                                dropdown-menu dropdown-menu-end
                                            "
                                            
                                            :aria-labelledby="'customer-context-menu-'+index"
                                        >
                                            <li>
                                               <router-link class="dropdown-item" :to="{name:'product-edit',params:{id:item._id}}" >Edit</router-link>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <a
                                                    class="
                                                        dropdown-item
                                                        text-danger
                                                    "
                                                    href="#"
                                                    >Delete</a
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination v-model="page" :records="total" :per-page="perpage" @paginate="fetchProduct($event)"/>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    
    data() {
        return { page:1,total:0,perpage:parseInt(process.env.MIX_API_perPage),search:'',
            filter:[],
            nameSearch:null,
            searchProductStatus:null
        };
    },
    mounted() {
        this.fetchProduct();
        
        // this.generatefilter('general',this.filter)
    },
    watch:{
        nameSearch:{
            handler(val,old)
            {   
               let newFilter=this.filter.filter(item => item.name != 'name');
               if(val.length>0){

                   newFilter.push({type:'general',name:'name',value:val})
               }
                   this.filter=newFilter
             
            }
        },
        searchProductStatus:{
            handler(val,old)
            {   
                let newFilter=this.filter.filter(item => item.name != 'status');
                if (val.length>0) {
                    newFilter.push({type:'general',name:'status',value:val})
                }
                    this.filter=newFilter

            }
        }
    },
    methods: {
        fetchProduct(page=1) {
           let  query='?page='+page+'&'+'perPage='+process.env.MIX_API_perPage
           query+=this.generatefilter(this.filter)??''
            this.$store.dispatch("fetchProductList",{query}).then((res)=>{
               
                this.total=this.$store.getters.getProductList?.data?.data.total
            })
        },
        
        
    },
};
</script>
<style lang=""></style>
