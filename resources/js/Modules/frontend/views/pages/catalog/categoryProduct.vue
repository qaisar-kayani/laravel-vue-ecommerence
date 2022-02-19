<template>

  <div class="row" v-if="loading" >
     <!--Right Part Start -->
     <categoty-filter :catid="categories._id" :catslug="categories.slug" @submitFilter="filterValue($event)" />
    <!--Middle Part Start-->
    <div id="content" class="col-md-9 col-sm-8 ">
      <div class="products-category">
        <h3 class="title-category " style="margin-top:10px">{{ categories.name }}</h3>
        <div class="category-derc" >
          <div class="row">
            <div class="col-sm-12">
              <div class="banners">     
                <div  v-if="categories.bannerImage">
                  <a href="#"
                    ><img
                      :src="showImage(categories.bannerImage)"
                      alt="img cate" /><br
                  /></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Paging -->
        <div class="product-filter product-filter-top filters-panel ">
          <div class="row">
            <div class="col-md-5 col-sm-3 col-xs-12 view-mode">
              <div class="list-view">
                <button
                  class="btn btn-default grid active"
                  data-view="grid"
                  data-toggle="tooltip"
                  data-original-title="Grid"
                >
                  <i class="fa fa-th"></i>
                </button>
                <!-- <button
                  class="btn btn-default list"
                  data-view="list"
                  data-toggle="tooltip"
                  data-original-title="List"
                >
                  <i class="fa fa-th-list"></i>
                </button> -->
              </div>
            </div>
            <div
              class="
                short-by-show
                form-inline
                text-right
                col-md-7 col-sm-9 col-xs-12
              "
            >
              <div class="form-group short-by">
                <label class="control-label" for="input-sort">Sort By:</label>
                
                <select
                  id="input-sort"
                  class="form-control"
                  @change="sortingOrder($event)"
                >
                  <option value="" selected="selected">Default</option>
                  <option value="name-ASC">Name (A - Z)</option>
                  <option value="name-DESC">Name (Z - A)</option>
                  <option value="regular_price-ASC">Price (Low &gt; High)</option>
                  <option value="regular_price-DESC">Price (High &gt; Low)</option>
                  <option value="rating-DESC">Rating (Highest)</option>
                  <option value="rating-ASC">Rating (Lowest)</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-limit">Show:</label>
                <select
                  id="input-limit"
                  class="form-control"
                  v-model="perpage"
                  @change="byLimitProduct($event)"
                >
                  <option :value="defaultPage" >{{defaultPage}}</option>
                  <option value="15">15</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </select>
              </div>
            </div>
            <!-- <div class="box-pagination col-md-3 col-sm-4 col-xs-12 text-right">
                                <ul class="pagination">
                                    <li class="active"><span>1</span></li>
                                    <li><a href="">2</a></li><li><a href="">&gt;</a></li>
                                    <li><a href="">&gt;|</a></li>
                                </ul>
                            </div> -->
          </div>
          
        </div>
        <!-- //end Filters -->
        <!--changed listings-->
        <div class="products-list row nopadding-xs so-filter-gird grid">
          <div v-for="(product, index) in $store.getters.getProduct" :key="index"    
               class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-12"
           
          >
            <div class="product-item-container">
              <div class="left-block">
                <div class="product-image-container second_img">

                  <a
                    :href="baseUrl('product/'+product.slug+'/'+product._id)"
                    target="_self"
                    title="Chicken swinesha"
                  >
                    <img
                     :src="showImage(product.feature_image)"
                      class="img-1 img-responsive"
                      alt="image"
                    />
                    <img
                     :src="showImage(product.feature_image)"
                      class="img-2 img-responsive"
                      alt="image"
                    />
                  </a>
                </div>
                <div class="box-label" v-if="product.sale_price>0">
                  <span class="label-product label-sale">-{{isProductPercentage(product.sale_price,product.regular_price)}}%</span>
                </div>
                <div class="button-group so-quickview cartinfo--left">
                  <button
                    type="button"
                    class="addToCart btn-button"
                    title="Add to cart"
                   @click="addToCart(product)"
                  >
                    <i class="fa fa-shopping-basket"></i>
                    <span>Add to cart </span>
                  </button>
                  <button
                    type="button"
                    class="wishlist btn-button"
                    title="Add to Wish List"
                    onclick="wishlist.add('60');"
                  >
                    <i class="fa fa-heart"></i><span>Add to Wish List</span>
                  </button>
                  <button
                    type="button"
                    class="compare btn-button"
                    title="Compare this Product "
                    onclick="compare.add('60');"
                  >
                    <i class="fa fa-refresh"></i
                    ><span>Compare this Product</span>
                  </button>
                  <!--quickview-->
                  <a
                    class="
                      iframe-link
                      btn-button
                      quickview quickview_handler
                      visible-lg
                    "
                    :href="baseUrl('product/'+product.slug+'/'+product._id)"
                    title="Quick view"
                    data-fancybox-type="iframe"
                    ><i class="fa fa-eye"></i><span>Quick view</span></a
                  >
                  <!--end quickview-->
                </div>
              </div>
              <div class="right-block">
                <div class="caption">
                  <div class="rating">
                    <span class="fa fa-stack" v-for="index in 5" :key="index"><i :class='ratingClass(index,product.rating.rate)' class="fa  fa-stack-1x"></i></span>
                  </div>
                  <h4>
                    <a
                      :href="baseUrl('product/'+product.slug+'/'+product._id)"
                      title="Chicken swinesha"
                      target="_self"
                      >{{ textLimit(product.name,30) }}</a
                    >
                  </h4>
                  <div v-if="product.sale_price>0" class="price">
                    <span class="price-new">{{currency(product.sale_price)}}</span>
                    <span class="price-old">{{currency(product.regular_price)}}</span>
                  </div>
                   <div v-if="product.sale_price==0" class="price">
                     <span class="price-new">{{currency(product.regular_price)}}</span>
                    </div>
                  <div class="description item-desc">
                    <p>
                      {{ product.summary }}
                    </p>
                  </div>
                  <div class="list-block hidden" >
                    <button
                      class="addToCart btn-button"
                      type="button"
                      title="Add to Cart"
                      onclick="cart.add('101', '1');"
                    >
                      <i class="fa fa-shopping-basket"></i>
                    </button>
                    <button
                      class="wishlist btn-button"
                      type="button"
                      title="Add to Wish List"
                      onclick="wishlist.add('101');"
                    >
                      <i class="fa fa-heart"></i>
                    </button>
                    <button
                      class="compare btn-button"
                      type="button"
                      title="Compare this Product"
                      onclick="compare.add('101');"
                    >
                      <i class="fa fa-refresh"></i>
                    </button>
                 
                      <a class="
                        iframe-link
                        btn-button
                        quickview quickview_handler
                        visible-lg
                      "
                      href="quickview.html"
                      title="Quick view"
                      data-fancybox-type="iframe"
                      ><i class="fa fa-eye"></i
                    ></a>
                    </div>
                </div>
              </div>
            </div>
          </div>
           <div class="alert alert-warning" v-if="$store.getters.getProduct.length<1"><i class="fa fa-warning"></i> Warning No Result Found...</div>
        </div>
        
        <!--// End Changed listings-->
        <!-- Filters -->
        <div class="product-filter product-filter-bottom filters-panel" v-if="$store.getters.getProduct.length>0">
          <div class="row">
            <div class="col-sm-12 text-center">
              <button  class="button_grey button_submit" @click="loadMore()">show More</button>
            </div>
          
          </div>
         
        </div>
        <!-- //end Filters -->
      </div>
    </div>

    <!--Middle Part End-->

   
    <!--Right Part End -->
  </div>
</template>

<script>
import categoryFilter from './categoryFilter.vue';
export default {
  components: { categoryFilter },
  name:'category producct',
  props:["categoryprops",'filter'],
  mounted() {
    this.filterList=JSON.parse(this.filter)

    let filter=[] 

    $.each(this.filterList['productAttributes'],(index , item)=>{
      item.forEach(element => {
        filter.push({name:index,value:element})
        });
    })

    this.$store.commit('setfilter',filter)
    this.categories=JSON.parse(this.categoryprops)
    this.fetchProduct();
  },
  data () {

    return {
      categories:[],
      productList:[],
      loading:false,
      filterList:{},
      limitStart:0,
      perpage:parseInt(process.env.MIX_API_limit),
      defaultPage:parseInt(process.env.MIX_API_limit),
      limitEnd:parseInt(process.env.MIX_API_limit),
      search:'',
      sortingOrderLIst:{priceAsc:[{name:'price',value:'ASC'},]},
      currentSortingValue:{}

    }

  },

  
  methods: {

    fetchProduct(type=null) {

      let url="frontend/category/"+this.categories._id+"/product"+'?limitStart='+this.limitStart+'&limitEnd='+this.limitEnd+'&search='+this.search
      this.productList=this.$store.getters.getProduct;
      let sort=(this.currentSortingValue)?this.currentSortingValue:[]
     
      this.$store.dispatch('fetchProduct',{ requesttype:'POST',url,filter:this.filterList,sort}).then((res)=>{
      
      if(type=='loadmore')
      { 
          res.data.forEach(element => {
            this.productList.push(element)
          });
          this.$store.commit('setProduct',this.productList)

      }
      this.loading=true
    })
    },
    loadMore()
    {
      this.limitStart=this.limitEnd;
      this.limitEnd+=parseInt(process.env.MIX_API_limit)
      this.fetchProduct('loadmore')
    },
    //sorting order
    sortingOrder(item)
    {
      //  this.defaultLimit()//for reset product limit
       let sort=item.target.value.split('-')
       console.log(sort)
       this.currentSortingValue={}
      this.currentSortingValue[sort[0]]=sort[1]
      this.fetchProduct()
      // console.log(sort)
      
    },
    byLimitProduct(item) //by limit show product
    {
      this.limitStart=0
      this.limitEnd=parseInt(item.target.value)
      this.fetchProduct()
    },
    //set default limit
    defaultLimit()
    {
      this.limitStart=0;
      this.limitEnd=parseInt(process.env.MIX_API_limit)

    },


    filterValue(title)
    {
      console.log(title)
    }
  },
};
</script>

