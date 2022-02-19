<template lang="">
    		<div class="row ">
            <customer-aside activeTab="bidding"/>
			<!--Middle Part Start-->
			<div id="content" class="col-sm-9  ">

                <div class="row "> <!--top bar -->
                    <div class="col-xs-6 col-sm-6 col-md-1">
                        <img class=" img-thumbnail" :src="showImage(currentBid.thumbnail)" alt="no image"/>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-5">
                        <h3>
                          {{currentBid.name}}
                          
                        </h3>
                    </div>
                    
                     <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="row">
                            
                            <div class="col-xs-6 col-sm-4  text-center">
                               
                                <h2 > <span class="label label-danger  b-heading"><i class="fa fa-tags"></i> Product Price</span></h2>
                                <h3> <span class="badge badge-white">{{currency(currentBid.price)}}  </span></h3>

                                
                            </div>
                            <div class="col-xs-4 col-sm-4 text-center">
                                <h2> <span class="label label-primary b-heading"><i class="fa fa-gavel"></i> Bidding Price</span></h2>
                                <h3><span class="badge badge-white">{{currency(currentBid.bidPrice)}} </span></h3>
                              
                            </div>
                            <div class="col-xs-4 col-sm-4  text-center">
                                <h2 > <span class="label label-success  b-heading"><i class="fa fa-clock-o"></i>  Time Left</span></h2>
                                <h3><span class="badge badge-white">  
                                    <vue-countdown v-if="bidExpireTime" :time="bidExpireTime" v-slot="{ days, hours, minutes, seconds }">
                                            {{ hours }}  : {{ minutes }} : {{ seconds }}
                                            </vue-countdown>
                                            </span>
                                     </h3>
                            </div>
                        </div>
                    </div>
                </div><!--top bar end -->
                <hr>
                <div class="row "> <!--bid boddy -->
                    <div class="sidebar  col-sm-12 col-md-4 chatborder ">
                      <div class="row  well bid-item " v-for="(item, index) in biddingList" :key="index" :class="(item._id==activeclass)?'active':''" @click="bidDetails(item)">
                          <div class="col-xs-4 col-sm-3 ">
                            <img class="bid-image img-thumbnail pull-rigt" :src="showImage(item.image)"/>
                            
                          </div>
                          <div class="col-sm-9">
                              <div class="row">
                                  <div class="col-sx-12">
                                      <p>
                                      {{item.name}}
                                      </p>
                                      <!-- {{item}} -->
                                  </div>
                                  <div class="col-sx-12  d-flex">
                                     <span class=" bid-color  badge"><i class="fa fa-gavel text-warning"></i>Bid Replies ({{item.responseCount}})</span>
                                     <span class=" bid-color  badge"><i class="fa fa-clock-o text-warning"></i> {{timeAgo(new Date(item.created_at))}} </span>
                                     <span class=" bid-color  badge"><i class="fa fa-circle text-warning"></i>status {{item.status}} </span>
                                  </div>
                              </div>
                          </div>
                        </div>
                        
                       
                    </div>
                    <div class="mainbody col-sm-12 col-md-7 message">
                        <div v-if="biddingDetails.length<1">
                        <div class="alert alert-danger">
                        <strong>NO Result Found!</strong> Please Wait... .
                        </div>
                    </div>
                        <div v-for="(item, index) in biddingDetails" :key="index">
                        <div class="row" >
                            <div class="col-xs-12">
                            <img class=" pull-left message-image img-thumbnail" src="http://192.168.1.121/kayani/ecommerce/public/images/catalog/product/images/thumbnail/164317849561f0e9ff533a9.jpg"/>
                                <div class=" message-datetime"> {{timeAgo(new Date(item.updated_at))}}</div>
                            </div>
                            <!-- <div class="col-xs-8 message-datetime"> Yesterday 04:06 PM</div> -->
                     
                            <!-- {{item}} -->
                        </div>
                        <div class=" message-chat well">
                            <div class="row">
                            <div class="col-xs-12"><h4><strong> Hi {{$store.getters.getAuth.last_name}}, This vendor is offering you </strong></h4></div>
                            <div class="row message-bid" > 
                                <div class="col-xs-12 col-sm-12 col-md-6" >
                                 <img class=" pull-left  message-chat-image img-thumbnail" :src="showImage(item.product.thumbnail)"/>
                                    <p> {{item.product.name}}</p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="row">
                                        <div class="col-xs-12 bage-lable">
                                            <span class="badge badge-offer bage-text"><i class="fa fa-tags"></i> Offered Price: {{currency(item.givenPrice)}}</span>
                                            <span class="badge badge-savemoney bage-text" style="margin-left:2px"><i class="fa fa-money"></i> You will Save: {{currency(item.savedAmount)}}</span>


                                        </div>
                                         <div class="col-xs-12 bage-lable">
                                           <span class="badge badge-productdescription bage-text"><i class="fa fa-info-circle"></i> See Product Description</span>
                                            <span @click="addToCart(item.product,true)" class="btn badge badge-addtocart bage-text" style="margin-left:2px"><i class="fa fa-cart-plus"></i> Add Product to Cart
</span>


                                        </div>
                                        </div>
                                </div>
                            </div>

                            </div>
                            
                        </div>
                            
                        </div>
                    </div>
                </div>
              


            </div>
            </div>

</template>
<script>
import VueCountdown from '@chenfengyuan/vue-countdown';
export default {
    components:
    {
        VueCountdown
    },
    data() {
        return {
            biddingList:[],
            biddingDetails:[],
            activeclass:null,
            currentBid:{},
            bidExpireTime:null
        }
    },
   async mounted() {
            
       await this.getBiddingList()
        setInterval(() => {
            this.bidDetails(this.currentBid)
        }, 5000);
    },
    methods: {
        getBiddingList()
        {   
            let url='customer/bidding/'+this.$store.getters.getAuth.id
            this.$store.dispatch('getData',{url}).then((res)=>{
                this.biddingList=res.data
                if(res.status==200)
                {

                    if (res.data.length>0) {
                        this.bidDetails(res.data[0])
                        this.activeclass=res.data[0]._id
                        this.currentBid=res.data[0]
                    }
                }
            })
        },
        bidDetails(item)
        {   
            let url='customer/bidding/details/'+item._id
            this.$store.dispatch('getData',{url}).then((res)=>{
                if (res.status==200) {
                    this.biddingDetails=res.data
                    this.activeclass=item._id
                    this.currentBid=item
                    var expirDate = new Date(item.end_time);
                    var startDate = new Date();
                    this.bidExpireTime=(expirDate.getTime()-startDate.getTime())
                }
            })
        },
        // bidBuy(item)
        // {   
        //    let data={
		// 		product_id:item.product_id,
		// 		// parent_id:item.parent_id,
		// 		// vendor_id:item.vendor_id,
		// 		// sku:item.sku,
		// 		// name:item.name,
		// 		// price:(item.sale_price)?item.sale_price:item.regular_price,
		// 		// unitPrice:(item.sale_price)?item.sale_price:item.regular_price,
		// 		quantity:1,
		// 		// thumbnail:item.thumbnail,
		// 		// image:item.feature_image,
		// 		// attributes:item.productAttributes,
        //         isBid:true,
        //         bidPrice:item.givenPrice,
		// 		url:'customer/cart/addTocart',
		// 		requesttype:'POST'
				
		// 	}
		// 	if(localStorage.getItem('cartID')&& localStorage.getItem('cartID')!=="undefined"){data.cartId=localStorage.getItem('cartID')}
		// 	this.$store.dispatch('saveData',data).then((res)=>{
				
		// 		if(res.status==200)
		// 		{
        //   this.notification('Bid Product added to Cart',item.product.name,'','success')
		// 			localStorage.setItem('cartID',res.data._id)
		// 			this.$store.commit('setCart',res.data)
		// 		}
		// 	}) 
        // }
        
    },
}
</script>












<style scoped>
.bid-image{
    /* height: 5rem;
    width: 5rem; */
}
.sidebar
{
    margin-left: 2rem;
}
.bid-item{
     border-radius: 13px;
     margin-right: 1rem;
}
 .active
{
    background: #ffd333;
    color: #fff;
    
}
.active  .bid-color{
    background: white;
    font-size: 10px;
    margin-left:2px;
    border: 1px solid;
    border-color: rgb(168, 164, 164);

}
.chatborder
{
      border-right: 1px solid rgb(194, 188, 188);
      /* height: 100rem; */

}
.bid-color
{
    background: #e6e6e6;
    color: #4d4d4d;
     font-size: 10px;
    margin-left:2px;
    border: 1px solid;
    border-color: rgb(168, 164, 164);
}
.bid-color i{
    color: #f7931e;
    padding-right: 3px;
}
/* //message  */
.message{
    margin-top: 2rem;
}
.message-image 
{
    height: 5rem;
    width: 5rem;
}
.message-datetime{
    margin-top: 3rem;
}
.message-chat{
    /* margin-left: 1rem; */
    margin-top: 2rem;
    border-radius: 13px;
}
.message-chat-image
{
      height: 5rem;
    width: 5rem;
}
.message-bid
{
    margin-left: 2rem;
}
.bage-text
{
    /* font-size: 1vh; */
    /* color:rgb(241, 232, 228); */
    font-family: Arial, Helvetica, sans-serif;
    padding: 8px;
    
}
.bage-lable{
    padding: 1rem;
}
.badge-offer
{
    background-color: #90be6d;
}
.badge-savemoney{
    background-color: #4ecdc4;
}
.badge-productdescription{
    background-color: #808080;
}
.badge-addtocart{
    background-color: #efc803;
    cursor: pointer;
}
.badge-white{
    background-color: rgb(255, 255, 255);
    color: black;
    padding: 1rem;
    border:1px solid rgb(192, 190, 190);
    /* width: 100%; */
}
.bage-lable{
    padding: 2px;
}
</style>