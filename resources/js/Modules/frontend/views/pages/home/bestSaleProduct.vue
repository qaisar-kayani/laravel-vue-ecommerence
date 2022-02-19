<template lang="">
    <div>
                           <!-- Listing tabs -->
                    <div class="module listingtab-layout2">
                        <h3 class="modtitle"><span>Best seller</span></h3>
                        <div id="so_listing_tabs_1" class="so-listing-tabs first-load">
                            <div class="loadeding"></div>
                            <div class="ltabs-wrap">
                                <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="4" data-md="3" data-sm="2" data-xs="1" data-margin="30">
                                    <!--Begin Tabs-->
                                    <div class="ltabs-tabs-wrap"> 
                                    <span class="ltabs-tab-selected">Bathroom</span> <span class="ltabs-tab-arrow">▼</span>
                                        <div class="item-sub-cat">
                                            <ul class="ltabs-tabs cf">
                                                <li v-for="(item, index) in bestSaleProduct" :key="index" class="ltabs-tab " :data-category-id="item._id" :data-active-content="'.items-category-'+item._id" :class="activeTab==item._id?' tab-sel':''" @click="activeTab=item._id"> <span class="ltabs-tab-label">{{toUpperCase(item.name)}}</span> </li>
                                                <!-- <li class="ltabs-tab " data-category-id="18" data-active-content=".items-category-18"> <span class="ltabs-tab-label">Fashion</span> </li>
                                                <li class="ltabs-tab " data-category-id="25" data-active-content=".items-category-25"> <span class="ltabs-tab-label">Electronics</span> </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Tabs-->
                                </div>
                            
                                <div class="ltabs-items-container  products-list grid">
                                    <!--Begin Items-->
                            
                                    <div v-for="(item, index) in bestSaleProduct" :key="index" class="ltabs-items  " :class="'items-category-'+item._id,activeTab==item._id?' ltabs-items-selected':''" :data-total="item.product.length" >
                                         <div class="ltabs-items-inner ltabs-slider" >
                                            <!-- item listing tab -->
                                            <div class="ltabs-item "  v-for="(i, index) in item.product" :key="index">
                                                <div class="item-inner product-layout transition product-grid">
                                                    <div class="product-item-container">
                                                        <div class="left-block">
                                                            <div class="product-image-container second_img">
                                                                <a :href="baseUrl('product/'+i.slug+'/'+i._id)" target="_self" title="Pastrami bacon">
                                                                    <img :src="showImage(i.feature_image)" class="img-1 img-responsive" alt="Pastrami bacon">
                                                                    <img :src="showImage(i.feature_image)" class="img-2 img-responsive" alt="Pastrami bacon">
                                                                </a>
                                                            </div>
                                                            <div class="box-label" v-if="i.sale_price>0">
                                                                    <span class="label-product label-sale">-{{isProductPercentage(i.sale_price,i.regular_price)}}%</span>
                                                                    </div>
                                                            <div class="button-group so-quickview cartinfo--left">
                                                                <button type="button" class="addToCart btn-button" title="Add to cart"  @click="addToCart(i)">  <i class="fa fa-shopping-basket"></i>
                                                                    <span>Add to cart </span>   
                                                                </button>
                                                                <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                                                </button>
                                                                <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                                                </button>
                                                                <!--quickview-->                                                      
                                                                <a class=" btn-button visible-lg"   :href="baseUrl('product/'+i.slug+'/'+i._id)" title="Quick view" ><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                                                <!--end quickview-->
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <div class="rating">    
                                                                     <span class="fa fa-stack" v-for="index in 5" :key="index"><i :class='ratingClass(index,i.rating.rate)' class="fa  fa-stack-1x"></i></span>
                                                                </div>
                                                                <h4><a  :href="baseUrl('product/'+i.slug+'/'+i._id)" title="Pastrami bacon" target="_self">{{ textLimit(i.name,30) }}</a></h4>
                                                                <!-- <div class="price">$42.00</div> -->
                                                                <div v-if="i.sale_price>0" class="price">
                                                                <span class="price-new">{{currency(i.sale_price)}}</span>
                                                                <span class="price-old">{{currency(i.regular_price)}}</span>
                                                            </div>
                                                            <div v-if="i.sale_price==0" class="price">
                                                                <span class="price-new">{{currency(i.regular_price)}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- end item listing tab -->
                                            
                                            
                                        </div>
                                        
                                    </div>
                                   
                                    <!--End Items-->
                                </div>
                                
                            </div>   
                        </div>
                    </div>
                    <!-- end Listing tabs -->        
    </div>
</template>
<script>
export default {
    props:['bestproduct'],
    data() {
        return {
            bestSaleProduct:[],
            activeTab:null,
        }
    },
    watch:{
        activeTab:{
           handler: function(val,news){
      
            this.del_script('frontend/js/themejs/homepage.js')
            this.body_script("frontend/js/themejs/homepage.js");
        },
         deep: true
        }
    },
    mounted() {
        this.bestSaleProduct=this.bestproduct
        console.log(this.bestSaleProduct[0].product)
        this.activeTab=this.bestSaleProduct[0]._id
        // this.product=this.bestSaleProduct[0].product
        // this.del_script('frontend/js/themejs/homepage.js')
        // this.body_script("frontend/js/themejs/homepage.js");
        
    }
}
</script>
<style lang="">
    
</style>