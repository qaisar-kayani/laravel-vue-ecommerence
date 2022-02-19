<template lang="">
    <aside class="col-sm-4 col-md-3 content-aside" id="column-left">

        <div class="module category-style" v-if="categories">
                	<h3 class="modtitle">Categories</h3>
                	<div class="modcontent">
                		<div class="box-category">
                            <!-- dynamic category  -->
                		</div>
                		
                		
                	</div>
        </div>

      <div class="module">
        <h3 class="modtitle">Filter</h3>
        <div class="modcontent">
          <form class="type_2">
            <div class="table_layout filter-shopby">
              <div class="table_row">
                <!-- - - - - - - - - - - - - - Category filter - - - - - - - - - - - - - - - - -->
                <div class="table_cell" style="z-index: 103">
                  <legend>Search</legend>
                  <input
                    class="form-control"
                    type="text"
                    value=""
                    size="50"
                    autocomplete="off"
                    placeholder="Search"
                    name="search"
                  />
                </div>
                <!--/ .table_cell -->
                <!-- - - - - - - - - - - - - - End of category filter - - - - - - - - - - - - - - - - -->
                <!-- - - - - - - - - - - - - - SUB CATEGORY - - - - - - - - - - - - - - - - -->
                
                <div class="table_cell"  v-for="(item, index) in filterList" :key="index">
                  <!-- <fieldset> -->
                    <legend>{{toUpperCase(index)}}</legend>
                    <ul class="checkboxes_list" >
                      <li v-for="(i, ind) in item" :key="index">
                        <input
                          type="checkbox"
                           name="category"
                          :id="index+'-'+ind"
                          v-model="checkedFilter"
                          :value="{name:index,value:ind}"
                        @change="addAndRemoveFilter(index,i)"
                        />
                        <label :for="index+'-'+ind">{{toUpperCase(i,'full')}}</label>
                      </li>
                    
                       
                    </ul>
                  <!-- </fieldset> -->
                </div>
                <!--/ .table_cell -->
                <div class="table_cell">
                  <fieldset>
                    <legend>Price Range</legend>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group row"> 
                          <lable class="col-sm-2 col-form-label mt-2" style="margin-top:7px">Min-</lable>
                          <div class="col-sm-8">
                          <input type="text"  class="form-control" min="1" v-model="filterPrice.min">
                         </div>
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group row"> 
                          <lable class="col-sm-2 col-form-label mt-2" style="margin-top:7px">MAx-</lable>
                          <div class="col-sm-8">
                          <input type="text"  class="form-control" v-model="filterPrice.max" >
                         </div>
                        </div>
                      </div>
                      <div class="col-sm-12 text-center">
                        
                       <button type="button" @click="priceFilter()" class="button_grey button_submit ">Go</button>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <!--/ .table_cell -->

                <!-- - - - - - - - - - - - - - End price - - - - - - - - - - - - - - - - -->


                <!-- - - - - - - - - - - - - - End price - - - - - - - - - - - - - - - - -->
              </div>
              <!--/ .table_row -->
              <footer class="bottom_box">
                <!-- <div class="buttons_row">
                  <button type="button" @click="submitFilter()" class="button_grey button_submit">
                    Search
                  </button>
                  <button type="reset" class="button_grey filter_reset">
                    Reset
                  </button>
                </div> -->
                <!--Back To Top-->
                <div class="back-to-top"><i class="fa fa-angle-up"></i></div>
              </footer>
            </div>
            <!--/ .table_layout -->
          </form>
        </div>
      </div>

    </aside>
</template>
<script>
export default {
    name: 'filterList',
    props:['catid','catslug'],
    mounted() {
         this.getCategoryFilter()
         //filter checked
         let filter=this.$store.getters.getfilter
         filter.forEach(element => {
             this.checkedFilter.push(element)
         });
        
    },
    data() {
        return {
            filterList:[],
            categories:[],
            checkedFilter:[],
            selectedFilter:this.$store.getters.getfilter??[],
            queryAttribute:[],
            dropDown:'',
            dropDownCount:0,
            minMaxPrice:{},
            filterPrice:{min:0,max:0}
        }
    },
    watch:{

        dropDown(){ //category dropdown
             $(".box-category").html(this.dropDown) //sorry for js
              this.filterjs()
              
        }
    },
    methods: {

        getCategoryFilter()
        {
                 this.$store.dispatch('getData',{url:'frontend/category/'+this.catid+'/filter',requesttype:'POST'}).then((res)=>{
                if(res.status==200)
                {
                    this.filterList=res.data.attribute
                    this.categories=res.data.categories
                    this.dropDown=  this.createList(this.categories)
                  
                }
            })      
        },

        addAndRemoveFilter(filterName,filterValue,tag='productAttributes')
        {   
            let obj={name:filterName,value:filterValue}
            let check=this.selectedFilter.filter((el)=>el.name==obj.name &&el.value==obj.value)
           
            if(check.length>0)
            {
                this.selectedFilter.pop(obj)
            }else
            {

                this.selectedFilter.push({name:filterName,value:filterValue})
            }   
                this.$store.commit('setfilter',this.selectedFilter)
                this.filter()
                
            
        },
        filter()
        {
          let filter=this.$store.getters.getfilter
                let anchorTga=this.catslug+""
                
                filter.forEach((element,index) => {
                    if(index==0)
                    {   
                        anchorTga+='?filter[productAttributes]['+element.name+'][]='+element.value+''
                        
                    }else
                    {
                        anchorTga+='&filter[productAttributes]['+element.name+'][]='+element.value+''

                    }
                    
                });

                location.href=anchorTga
        },

      priceFilter(){//price filter

            let price=this.priceFilter
            let minMAx=this.selectedFilter.filter((el)=>el.name=='min' ||el.name=='max')
            if(minMAx.length>0)
            {
              this.filterList.pop(minMAx)
            }
              this.filterList.push({filterTag:'priceRange',name:'min',value:price.min})
              this.filterList.push({filterTag:'priceRange',name:'max',value:price.max})
            
            


        },

        createList:function(array){//category filter
            let $vm=this
            var html= (this.dropDownCount==0)?'<ul   id="cat_accordion" class="list-group cat_accordion">':' <ul style="display: none;">';this.dropDownCount++;
            $.each( array, function(k, item){
                let childLi=''
                let slug=$vm.baseUrl('category/'+item.slug)
                
                if(item.children &&item.children.length>0)
                {
                     childLi=`<li  class="hadchild cutom-parent-li"><a class="cutom-parent" href="`+slug+`">`+$vm.textLimit(item.label,20)+`<span class="dcjq-icon"></span></a>   <span  class="button-view  fa fa-plus-square-o"></span>`
                }else
                {
                     childLi=`<li class="cutom-parent"><a href="`+slug+`" class="cutom-parent">`+$vm.textLimit(item.label,20)+`</a>  <span class="dcjq-icon"></span>`
                }
                html+=childLi
                if( item.children){
                    html+=$vm.createList(item.children);
                }
                html+='</li>';
            });
                html+='</ul>';
            return html;
        },


        filterjs()//colapes
        {
            $('.cat_accordion').cutomAccordion ({
            eventType: 'click',
            autoClose: true,
            saveState: true,
            disableLink: true,
            speed: 'slow',
            showCount: false,
            autoExpand: true,
            cookie	: 'dcjq-accordion-1',
            classExpand	 : 'button-view'
            });
        }
    },
    
}
</script>
