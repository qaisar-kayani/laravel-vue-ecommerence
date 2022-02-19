<template lang="">
    		<div class="row ">
            <customer-aside activeTab="bidding"/>
			<!--Middle Part Start-->
			<div id="content" class="col-sm-9 ">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td colspan="2" class="text-left">Bidding Information</td>
                            </tr>
                        </thead>
                       
                    </table>
                    <div class="alert alert-warning"  v-if="biddingList.length<1">
                    <strong>Warning!</strong> No result found.
                    </div>
                    <div class="row clearfix card chat-app" v-if="biddingList.length>0">
                        <div class="col-sm-3 chat-border-left">
                            <div id="plist" class="people-list">

                                    <ul class="list-unstyled chat-list mt-2 mb-0">
                                        <li class="clearfix " v-for="(item, index) in biddingList" :key="index" :class="(item._id==activeclass)?'active':''" @click="bidDetails(item)">
                                            <!-- <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar"> -->
                                            <div class="about">
                                                <div class="name">{{textLimit(item.name,30)}}</div>
                                                <div class="status"> <i class="fa fa-circle offline"></i> {{timeAgo(new Date(item.created_at))}} <span class="badge badge-light">{{item.responseCount}}</span> </div>                                            
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="col-sm-8 ">
                                        <div class="chat">
                                        <div class="chat-header clearfix">
                                            <div class="row">
                                                <div class="col-lg-12 ">
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                                    </a>
                                                    <div class=" row">
                                                        <div class="col-sm-4">
                                                            <h4 class="m-b-0">{{currentBid.name}}</h4>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <span class=" badge badge-secondary">Bid Price:{{currentBid.bidPrice}}</span>
                                                            
                                                        </div>
                                                       
                                                        
                                                        <div class="col-sm-2">
                                                            <small class="m-b-0">status: {{currentBid.status}}</small>
                                                            
                                                        </div>
                                                        <div class="col-sm-12">
                                                        <small>{{timeAgo(new Date(currentBid.created_at))}}</small>
                                                          
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="chat-history">
                                            <ul class="m-b-0">
                                                <li class="clearfix" v-for="(item, index) in biddingDetails" :key="index">
                                                    <div class="message-data ">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                                        <span class="message-data-time">{{timeAgo(new Date(item.updated_at))}}</span>
                                                    </div>
                                                    <div class="message other-message "> Hi {{$store.getters.getAuth.last_name}}, This vendor is offering this Price <span class="badge">{{item.givenPrice}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <button class="btn button_grey button_submit" @click="bidBuy(item)" >Buy</button>
                                                    </div>
                                                </li>
                                                <li v-if="biddingDetails.length<1">
                                                    <div class="message-data message other-message bg-danger">
                                                    <strong>NO Result Found!</strong> Please Wait... .
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        </div>
                        </div>
                        </div>



                    </div>
                    </div>

</template>
<script>
export default {
    data() {
        return {
            biddingList:[],
            biddingDetails:[],
            activeclass:null,
            currentBid:{}
        }
    },
   async mounted() {
            
       await this.getBiddingList()
        setInterval(() => {
            this.bidDetails(this.currentBid)
        }, 3000);
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
                }
            })
        },
        bidBuy(item)
        {   
            console.log(item)
           let data={
				product_id:item.product_id,
				// parent_id:item.parent_id,
				// vendor_id:item.vendor_id,
				// sku:item.sku,
				// name:item.name,
				// price:(item.sale_price)?item.sale_price:item.regular_price,
				// unitPrice:(item.sale_price)?item.sale_price:item.regular_price,
				quantity:1,
				// thumbnail:item.thumbnail,
				// image:item.feature_image,
				// attributes:item.productAttributes,
                isBid:true,
                bidPrice:item.givenPrice,
				url:'customer/cart/addTocart',
				requesttype:'POST'
				
			}
			if(localStorage.getItem('cartID')&& localStorage.getItem('cartID')!=="undefined"){data.cartId=localStorage.getItem('cartID')}
			this.$store.dispatch('saveData',data).then((res)=>{
				
				if(res.status==200)
				{
          this.notification('Bid Product added to Cart',item.product.name,'','success')
					localStorage.setItem('cartID',res.data._id)
					this.$store.commit('setCart',res.data)
				}
			}) 
        }
        
    },
}
</script>












<style scoped>
        .chat{
            background-color: #f4f7f6;
            margin-top:20px;
        }
        .chat-border-left{
            /* border-top:    1px solid  #ff0; */
            /* border-right:  2px dashed #f0F; */
            /* border-bottom: 1px solid rgb(221, 212, 212); */
            border-right:  1px solid rgb(221, 212, 212);
        }
        .card {
            background: #f4f7f6;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }
        .chat-app .people-list {
            width: 100%;
            /* position: absolute; */
            left: 0;
            top: 0;
            padding: 20px;
            z-index: 7
        }
        
        .chat-app .chat {
            /* margin-left: 280px; */
            /* border-left: 1px solid #eaeaea */
        }
        
        .people-list {
            -moz-transition: .5s;
            -o-transition: .5s;
            -webkit-transition: .5s;
            transition: .5s
        }
        
        .people-list .chat-list li {
            padding: 10px 15px;
            list-style: none;
            border-radius: 3px
        }
        
        .people-list .chat-list li:hover {
            background: #efefef;
            cursor: pointer
        }
        
        .people-list .chat-list li.active {
            background: #efefef
        }
        
        .people-list .chat-list li .name {
            font-size: 14px
        }
        
        .people-list .chat-list img {
            width: 45px;
            border-radius: 50%
        }
        
        .people-list img {
            float: left;
            border-radius: 50%
        }
        
        .people-list .about {
            float: left;
            padding-left: 8px
        }
        
        .people-list .status {
            color: #999;
            font-size: 13px
        }
        
        .chat .chat-header {
            padding: 15px 20px;
            border-bottom: 2px solid #f4f7f6
        }
        
        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px
        }
        
        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }
        
        .chat .chat-history {
            padding: 20px;
            border-bottom: 2px solid #fff
        }
        
        .chat .chat-history ul {
            padding: 0
        }
        
        .chat .chat-history ul li {
            list-style: none;
            margin-bottom: 30px
        }
        
        .chat .chat-history ul li:last-child {
            margin-bottom: 0px
        }
        
        .chat .chat-history .message-data {
            margin-bottom: 15px
        }
        
        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }
        
        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px
        }
        
        .chat .chat-history .message {
            color: #444;
            padding: 18px 20px;
            line-height: 26px;
            border-radius: 7px;
            display: inline-block;
            position: relative
        }
        
        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px
        }
        
        .chat .chat-history .my-message {
            background: #efefef
        }
        
        .chat .chat-history .my-message:after {
            bottom: 100%;
            left: 30px;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #efefef;
            border-width: 10px;
            margin-left: -10px
        }
        
        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: right
        }
        
        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 93%
        }
        
        .chat .chat-message {
            padding-left: 5px

        }
        
        .online,
        .offline,
        .me {
            margin-right: 2px;
            font-size: 8px;
            vertical-align: middle
        }
        
        .online {
            color: #86c541
        }
        
        .offline {
            color: #e47297
        }
        
        .me {
            color: #1d8ecd
        }
        
        .float-right {
            float: right
        }
        
        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0
        }
      
        
      
    </style>