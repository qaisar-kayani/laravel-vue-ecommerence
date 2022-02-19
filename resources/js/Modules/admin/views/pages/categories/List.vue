<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Categories',
                        currentRouteName: 'category-list',
                        nextRouteName: 'category-add',
                        nextRouteHeading: 'Create New',
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
                                
                                <th class="min-w-20x">#N0</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th class="w-min" data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody  v-if="categories" >
                            <tr v-for="(item, index) in categories.data" :key="index">
                                <td>
                                   {{index+1}}
                                </td>
                                <td>
                                    {{item.name}}
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
                                               <router-link class="dropdown-item" :to="{name:'category-edit',params:{id:item._id}}" >Edit</router-link>
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
                    <pagination  v-model="page" :records="total" :per-page="perpage" @paginate="fetchCategories($event)"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    
    data() {
        return {categories:[], page:1,total:0,perpage:parseInt(process.env.MIX_API_perPage),search:null};
    },
    mounted() {
        this.fetchCategories();
    },
    methods: {
        fetchCategories(page=1) {
           let  query='?page='+page+'&'+'perPage='+this.perpage+'&search='+this.search
            this.$store.commit('setToast',true)
            this.$store.dispatch("getData",{url:'catalog/category/list',query:query}).then((res)=>{
                if(res.status==200)
                {   
                    this.categories=res.data.data
                    this.total=res.data.data.total
                }
            })
        },
        
    },
};
</script>
<style lang=""></style>
