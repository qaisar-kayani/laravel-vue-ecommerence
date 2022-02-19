<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Attribute value List',
                        currentRouteName: 'attributevalue-list',
                        nextRouteName: 'attributevalue-add',
                        nextRouteHeading: 'Add New',
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
                                
                                <th class="min-w-20x"> Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="w-min" data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody  >
                            <tr v-for="(item, index) in this.pageData" :key="index">
                                <td>
                                   {{item.name}}
                                </td>
                                <td>
                                    {{item.code}}
                                </td>
                                <td>
                                    {{item.status}}
                                </td>
                                
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
                                               <router-link class="dropdown-item" :to="{name:'attributevalue-edit',params:{id:item._id}}" >Edit</router-link>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li>
                                                <span
                                                    class="dropdown-item text-danger"
                                                    @click="delRow(item._id,index)"
                                                   >Delete</span
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination v-model="page" :records="total" :per-page="perpage" @paginate="getPageData($event)"/>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    
    data() {
        return { pageData:[],page:1,total:0,perpage:parseInt(process.env.MIX_API_perPage),search:null};
    },
    mounted() {
        this.getPageData();
    },
    methods: {
        getPageData(page=1) {
            this.$store.commit('setToast',true)
            let url='catalog/attribute/attributevalue/list';
            let  query='?page='+page+'&'+'perPage='+process.env.MIX_API_perPage+'&search='+this.search
            this.$store.dispatch("getData",{url,query}).then((res)=>{
               if(res.status==200)
               {   
                  
                   this.pageData=res.data.data.data
                   this.total=res.data.data.total
               }
            })
        },
        
        delRow(id,index)
        {   
            this.$store.commit('setToast',true)
            this.$store.dispatch("delRow", {url:'catalog/attribute/attributevalue/delete/'+id,type:'DELETE'}).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('attributevalue successfully Created')
                    this.pageData.pop(index)
                }
            });
        }
        
    },
};
</script>
<style lang=""></style>
