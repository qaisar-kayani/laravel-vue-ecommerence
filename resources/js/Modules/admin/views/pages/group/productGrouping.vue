<template lang="">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <BreadCrumb
                    :pageHeader="{
                        pageHeading: 'Product Grouping',
                        currentRouteName: 'group-list',
                        nextRouteName: 'group-add',
                        nextRouteHeading: 'Add New',
                    }"
                />
                <div class="card">
                    <div class="p-4">
                        <div class="row">
                            <div class="col-sm-4">
                                 <label for="exampleInputPassword1">Select Group</label>
                                <select class="form-control " v-model="groupID">
                                    <option value="0">Select Group</option>
                                    <option v-for="(item, index) in groupList" :key="index" :value="item._id">{{item.name}}</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                 <label for="exampleInputPassword1"></label>
                                <input
                            type="text"
                            placeholder="Start typing to search for customers"
                            class="form-control form-control--search mx-auto"
                            id="table-search"
                            v-model="search"
                        />
                            </div>
                        <div class="col-sm-2 pt-5">
                            <button type="button" class="btn btn-primary" @click="getPageData()">Search</button>
                        </div>
                        <div class="col-sm-2 pt-5">
                            <button type="button" class="btn btn-primary" @click="addToGroup()">Add into Group</button>
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
                                <th></th>
                                <th class="min-w-20x"> Name</th>
                                <th>Image</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody  >
                            <tr v-for="(item, index) in this.pageData" :key="index">
                                <td>
                                    <input type="checkbox" :value="item" v-model="selectedItem" class="form-check-input m-0 fs-exact-16 d-block mt-5" aria-label="...">
                                </td>
                                <td>
                                   {{item.name}}
                                </td>
                                <td>
                                    <img :src="showImage(item.thumbnail)"/>
                                </td>
                                
                                <td class="text-nowrap">{{vpDate(item.created_at)}}</td>
                                
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
        return { pageData:[],groupList:[],

                groupID:0,
                search:'',
                selectedItem:[],
                page:1,total:0,perpage:parseInt(process.env.MIX_API_perPage),
        
        };
    },
    mounted() {
        this.getPageData();
        this.getGroupLIst();
    },
    methods: {
        getGroupLIst()
        {
            this.$store.dispatch('getData',{url:'catalog/group/list?perPage=10000'}).then((res)=>{
                
                this.groupList=res.data.data
            })
        },
        // getUnGroupProduct(item)
        // {
        //     alert(item.target.value)
        // },
        getPageData(page=1) {
            let url='catalog/product/unGroup/list'
             let  query='?page='+page+'&'+'perPage='+process.env.MIX_API_perPage+'&name='+this.search
           
            this.$store.commit('setToast',true)
            this.$store.dispatch("getData",{url,query}).then((res)=>{
               if(res.status==200)
               {   
                  
                   this.pageData=res.data.data
                   this.total=res.data.total
               }
            })
        },
        addToGroup()
        {   let form={groupid:this.groupID,products:this.selectedItem}
            if(this.groupID==0||this.groupID==''){
                  this.$toast.error('Group Name Required')
                  return false
            }
            if (this.selectedItem.length<1) {
                this.$toast.error('Please select Prodcut Items')
                  return false
            }
            form.url='/catalog/group/add/'+this.groupID+'/product'
            form.requesttype='POST'
            this.$store.dispatch('saveData',form).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('Group successfully Created')
                    this.getPageData()
                }
            })
        },
        
        delRow(id,index)
        {   this.$store.commit('setToast',true)
            this.$store.dispatch("delRow", {url:'catalog/attribute/delete/'+id,type:'DELETE'}).then((res)=>{
                if (res.status==200) {
                    this.$toast.success('attribute successfully Created')
                    this.pageData.pop(index)
                }
            });
        }
        
    },
};
</script>
<style lang=""></style>
