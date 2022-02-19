<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Bidding',
                        currentRouteName: 'bidding-list',
                        nextRouteName: '',
                        nextRouteHeading: '',
                    }"
                />
                <div class="card">
                    <div class="p-4">
                        <input
                            type="text"
                            placeholder="Start typing to search for customers"
                            class="form-control form-control--search mx-auto"
                            id="table-search"
                        />
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
                                
                            <th class="">prodcut </th>
                                <th>Message</th>
                                <th>Regular  Price</th>
                                <th>Sale  Price</th>
                                <th>Bid  Price</th>
                                <th>Image</th>
                                <th>Date/Time</th>
                                <th class="w-min" data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody  >
                            <tr v-for="(item, index) in pageData" :key="index">
                                <td>
                                   {{item?.product.name}}
                                </td>
                                
                                <td>
                                    {{item.message}}
                                </td>
                                <td>
                                    {{currency(item.product.regular_price)}}
                                </td>
                                <td>
                                    {{currency(item.product.sale_price)}}
                                </td>
                                <td>
                                    <img style="width:50%" :src="showImage(item.product.thumbnail)" />
                                </td>
                                 <td>
                                    {{currency(item.bidPrice)}}
                                </td>
                                <td class="text-nowrap">{{timeAgo(new Date(item.created_at))}}</td>
                                     
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
                                            class="dropdown-menu dropdown-menu-end"
                                            :aria-labelledby="'customer-context-menu-'+index"
                                        >
                                            <li>
                                               <button class="dropdown-item btn btn-info btn-sm"
                                               @click="showModel(item)"
                                                >VIew Details</button>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    
                    <!-- <pagination v-model="page" :records="total" :per-page="perpage" @paginate="fetchProduct($event)"/> -->
                
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
  
<div 
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
<div class="modal-dialog modal-lg" v-if="currrentBid">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bidding no# {{currrentBid?._id}} </h5>
                <button
                    type="button"
                    class="sa-close sa-close--modal"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
                <table class="sa-table">
                    <tbody>
                        <tr>
                            <td class="min-w-20x">
                                <div class=" align-items-center">
                                    <img  :src="showImage(currrentBid?.product?.thumbnail)" class="me-4" width="40" height="40" alt="">
                                    <a href="#" class="text-reset">{{currrentBid?.product?.name}}</a><br>
                                    <p>
                                    <span class="badge badge-sa-success">Regular Price:{{currency(currrentBid?.product?.regular_price)}}</span>
                                    <!-- <span class="badge badge-sa-success">Sale Price: {{currency(currrentBid?.product?.sale_price)}}</span> -->
                                    <span class="badge badge-sa-warning">Last Bid Price: {{currency(currrentBid?.product?.sale_price)}}</span>
                                    <span class="badge badge-sa-danger">Bid Price: {{currency(currrentBid?.bidPrice)}}</span>
                                    </p>
                                    
                                </div>
                            </td>
                            <td class="text-end">
                               <input style="width:50%" mim="0" type="number" v-model="replay.givenPrice" />
                            </td>
                            <td class="text-end">
                                <button class="btn btn-primary" @click="bidConfirm()">Confirm</button>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-danger">Reject</button>
                                
                            </td>
                        </tr>
                        
                        
                    </tbody>
                    
                </table>
            </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close</button
                ><button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>
</template>
<script>
export default {
  
    data() {
        return { pageData:'',page:1,total:0,perpage:parseInt(process.env.MIX_API_perPage),search:null,
         
         currrentBid:[],
         replay:{
             givenPrice:0,
             status:'replied',

         }
        
        };
    },
    mounted() {
        this.fetchProduct();
     
    },
    methods: {
        fetchProduct(page=1) {
            
            this.$store.commit('setToast',true)
        //    let  query='?page='+page+'&'+'perPage='+process.env.MIX_API_perPage+'&search='+this.search
           let url='vendor/bidding/list/'+this.$store.getters.getAuth.vendor.id
            this.$store.dispatch("getData",{url}).then((res)=>{
                if (res.status==200) {
                    
                    this.pageData=res.data
                }
            })
        },
        showModel(item)
        {   
            this.currrentBid=item
            $("#exampleModal").modal('show')
        },
        bidConfirm()
        {
            if(this.replay.givenPrice==0 || this.replay.givenPrice=='')
            {
                this.$toast.error('Please add Bid Price')
                return false
            }
            this.replay.url='vendor/bidding/bidResponse/'+this.currrentBid._id
            this.$store.dispatch('saveData',this.replay).then((res)=>{
                this.$toast.success('Bid Reply success')
                this.fetchProduct()
                console.log($)
                $("#exampleModal").modal('hide')
            })
        }
        
    },
};
</script>
<style lang=""></style>
