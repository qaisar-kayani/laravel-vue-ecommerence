<template lang="">
    <div class="row">
        <!--Left Part Start -->
			<aside-product data="test" />
            <!--Left Part End -->
            <!--Middle Part Start-->
           
			<div id="content" class="col-md-9 col-sm-8">
                <div class="product-view row">
					<div class="left-content-product">
				
						<div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">
							<div class="large-image  ">
								<img itemprop="image" class="" :src="showImage(product.feature_image)" :data-zoom-image="showImage(product.feature_image)" title="Samsung Galaxy Note 10" alt="Samsung Galaxy Note 10">
							</div>
							<!-- <a class="thumb-video pull-left" href="https://www.youtube.com/watch?v=SIn1mbgBhww"><i class="fa fa-youtube-play"></i></a> -->
							
							<div id="thumb-slider" class="yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="4" data-items_column1="3" data-items_column2="4"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
								<a v-for="(item, index) in product.gallery" :key="index" :data-index="index" class="img thumbnail " :data-image="showImage(item.image)" title="Samsung Galaxy Note 10">
									<img :src="showImage(item.image)" title="Samsung Galaxy Note 10" alt="Samsung Galaxy Note 10">
								</a>
								
							</div>
							
						</div>

						<div class="content-product-right col-md-7 col-sm-12 col-xs-12">
							<div class="title-product">
								<h1>{{toUpperCase(product.name)}} </h1>
							</div>
							<!-- Review ---->
							<div class="box-review form-group">
								<div class="ratings">
									<div class="rating-box">
										<span class="fa fa-stack" v-for="index in 5" :key="index"><i :class='ratingClass(index,product.rating.rate)' class="fa  fa-stack-1x"></i></span>
									</div>
								</div>

								<a class="reviews_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a>	| 
								<a class="write_review_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>
							</div>

                            
							<div class="product-label form-group">
								<div class="product_page_price price mr-4" itemprop="offerDetails" itemscope="" itemtype="http://data-vocabulary.org/Offer">
									<span class="price-new " itemprop="price" v-if="product.sale_price">{{currency(product.sale_price)}}</span>
									<span class="price-new " itemprop="price" v-if="!product.sale_price">{{currency(product.regular_price)}}</span>
                                    <span class="price-old" v-if="!product.sale_price"></span>
									<span class="price-old" v-if="product.sale_price">{{currency(product.regular_price)}}</span>
								</div>
                            
                                <div class="bid">
                                    <a button class="btn btn-default btn-md" 
									  data-toggle="modal" :data-target="$store.getters.auth?'#biddingModel':'#loginModel'">Bid Your Price</a>
                                </div>

								<div class="stock"><span>Availability:</span> <span class="status-stock">In Stock</span></div>
							</div>

							<div class="product-box-desc" v-if="product.summary">
								<div class="inner-box-desc">
									<div class="price-tax"><span>Summary</span></div>
									<div >{{product.summary}}</div>
								</div>
							</div>


							<div id="product">
								
								<h4>Available Options </h4>
								
								<div class="image_option_type form-group required" v-if="product.attributeList" v-for="(item, index) in product.attributeList" :key="index">
									<label class="control-label">{{toUpperCase(index)}}</label>
									<ul class="tags_cloud" id="input-option231">
										<li class="radio m-1" v-for="(item, i) in product.attributeList[index]" :key="i">
											<label>
                                            <button class="filter_btn  " :class="'filter'+index.replace(/\s/g, ''),'active'+item.replace(/\s/g, '')"  @click="addFilter(index,item)"> {{toUpperCase(item)}}</button>

											</label>
										</li>
									
										<li class="selected-option">
										</li>
									</ul>
								</div>
								
								

								<div class="form-group box-info-product">
									<div class="option quantity">
										<div class="input-group quantity-control" unselectable="on" style="-webkit-user-select: none;">
											<label>Qty </label>
											<input class="form-control" type="text" v-model="productqty">
											<span class=" product_quantity_down" @click="min()">−</span>
											<span class=" product_quantity_up"  @click="max()">+</span>
										</div>
									</div>
									<div class="cart">
										<input type="button" data-toggle="tooltip" title="" value="Add to Cart" data-loading-text="Loading..." id="button-cart" class="btn btn-mega btn-lg"  @click="addToCart({...product,quantity:productqty})"  data-original-title="Add to Cart">
									</div>


									<div class="add-to-links wish_comp">
										<ul class="blank list-inline">
											<li class="wishlist">
												<a class="icon" data-toggle="tooltip" title=""
												onclick="wishlist.add('50');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i>
												</a>
											</li>
											<li class="compare">
												<a class="icon" data-toggle="tooltip" title=""
												onclick="compare.add('50');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i>
												</a>
											</li>
										</ul>
									</div>
                                    

								</div>

							</div>
							<!-- end box info product -->

						</div>
				
					</div>
				</div>
                <!-- Product Tabs -->
				<div class="producttab ">
					<div class="tabsslider  vertical-tabs col-xs-12">
						<ul class="nav nav-tabs col-lg-2 col-sm-3">
							<li class="active"><a data-toggle="tab" href="#tab-1">Description</a></li>
							<li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Reviews ({{product.rating.count}})</a></li>
							<!-- <li class="item_nonactive"><a data-toggle="tab" href="#tab-4">Tags</a></li>
							<li class="item_nonactive"><a data-toggle="tab" href="#tab-5">Custom Tab</a></li> -->
						</ul>
						<div class="tab-content col-lg-10 col-sm-9 col-xs-12">
							<div id="tab-1" class="tab-pane fade active in">
								<p>{{product.details}}</p>
								
								
							</div>
							<div id="tab-review" class="tab-pane fade">
								<reviewList :product_id="product._id"/>  <!--import -->
							</div>
							<div id="tab-4" class="tab-pane fade">
								<a href="#">Monitor</a>,
								<a href="#">Apple</a>				
							</div>
							<div id="tab-5" class="tab-pane fade">
								<h3 class="custom-color">Take a trivial example which of us ever undertakes</h3>
								<p>Lorem ipsum dolor sit amet, consetetur
									sadipscing elitr, sed diam nonumy eirmod
									tempor invidunt ut labore et dolore
									magna aliquyam erat, sed diam voluptua.
									At vero eos et accusam et justo duo
									dolores et ea rebum. Stet clita kasd
									gubergren, no sea takimata sanctus est
									Lorem ipsum dolor sit amet. Lorem ipsum
									dolor sit amet, consetetur sadipscing
									elitr, sed diam nonumy eirmod tempor
									invidunt ut labore et dolore magna aliquyam
									erat, sed diam voluptua. </p>
								<p>At vero eos et accusam et justo duo dolores
									et ea rebum. Stet clita kasd gubergren,
									no sea takimata sanctus est Lorem ipsum
									dolor sit amet. Lorem ipsum dolor sit
									amet, consetetur sadipscing elitr.</p>
									<ul class="marker-simple-list two-columns">
						<li>Nam liberempore</li>
						<li>Cumsoluta nobisest</li>
						<li>Eligendptio cumque</li>
						<li>Nam liberempore</li>
						<li>Cumsoluta nobisest</li>
						<li>Eligendptio cumque</li>
						</ul>
								<p>Sed diam nonumy eirmod tempor invidunt
									ut labore et dolore magna aliquyam erat,
									sed diam voluptua. At vero eos et accusam
									et justo duo dolores et ea rebum. Stet
									clita kasd gubergren, no sea takimata
									sanctus est Lorem ipsum dolor sit amet.</p>
							</div>
						</div>
					</div>
				</div>
				<!-- //Product Tabs -->
            </div>
			<div>
			<biddingModel :product="product"/>
			</div>
			<div>
			<loginModel :product="product"/>
			</div>
    </div>


</template>
<script>
import reviewList from "./reviewList.vue"
import biddingModel from '../shortPage/biddingModel.vue'
import loginModel from "../shortPage/loginModel.vue"
export default {
    name:'single producct',
    props:['productdetail'],
	components:
	{
		reviewList,
		biddingModel,
		loginModel
	},
    mounted() {

        this.setProductImages()
		this.selectAddribute(this.product.productAttributes)
		

        // $.jGrowl("Action Success world!");
    },
    data() {
        return {
			filter:[],
            product:JSON.parse(this.productdetail),
			newUrlID:null,
			productqty:1
        }
    },
    methods: {
        setProductImages()//set slider
        {
            let imagesList=[]
        imagesList.push({src:this.showImage(this.product.feature_image)})
        if(this.product.gallery){

            this.product.gallery.forEach(element => {
                
                imagesList.push({src:this.showImage(element.image)})
    
                });
        }
        window.productImages=imagesList
        },
        
		addFilter(filterName,filterValue) //filter
		{	
			$('.filter'+filterName.replace(/\s/g, '')).removeClass('active')
			$('.active'+filterValue.replace(/\s/g, '')).addClass('active')

			
			this.filter=this.filter.filter((res)=>res.name!=filterName)//filter check if exit 
			
			this.filter.push({name:filterName,value:filterValue})
			this.nextProductUrl()
			
			window.location.href=this.baseUrl('product/'+this.product.slug+'/'+this.newUrlID)
		},
		
		selectAddribute(currentProductAttribute) //set attribute
		{
			for (const iterator in currentProductAttribute) {
				$('.active'+currentProductAttribute[iterator].replace(/\s/g, '')).addClass('active')
				this.filter.push({name:iterator,value:currentProductAttribute[iterator]})
			}
			
		},
		nextProductUrl() //filtering
		{	
			let filter=this.filter
			let allFilter=[]
				let count=0;
			$.each(this.product.attributeGroup,function(index,item){
				$.each(item,function(subindex,it) {
					allFilter.push({id:index,name:subindex,value:it})
				})
			});
			let id=null
				allFilter.forEach(groupItem => {
					filter.forEach(element => {
						if(groupItem.name==element.name && groupItem.value==element.value)
						{	
							if (id && id==groupItem.id) {
								count++
								if(filter.length==count){
									id=groupItem.id
									this.newUrlID=id
								}
							}else{
								id=groupItem.id;
								count=1;

							}
						}
					});
				});

			
				
		},

		max()
		{	
			
			(this.productqty<5)?this.productqty++:''

		},
		min()
		{
			(this.productqty>1)?this.productqty--:''
		},
		
		
		
    },
}
</script>
<style scoped>
    body{font-family:'Roboto', sans-serif}
    /* Style the buttons */
.filter_btn {
      padding: 6px 15px;
    display: inline-block;
    color: #555;
    background: #f1f1f1;
    text-transform: capitalize;
    border-radius: 3px;
    border: none;
}

.filter_btn:hover {
  background-color: #efc803;
  color: white;

}

.filter_btn.active {
  background-color: #efc803;
  color: white;
}
</style>
