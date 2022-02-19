<template lang="">
    		<div class="row">
            <customer-aside activeTab="order/details"/>
			<!--Middle Part Start-->
			<div id="content" class="col-sm-9">
				<h2 class="title">Order Information</h2>

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td colspan="2" class="text-left">Order Details</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="width: 50%;" class="text-left"> <b>Order ID:</b> #{{order.orderNumber}}
								<br>
								<b>Date Added:</b> {{vpDate(order.created_at,'MMMM Do YYYY, h:mm:ss a')}}</td>
							<td style="width: 50%;" class="text-left"> <b>Payment Method:</b> Cash On Delivery
								<br>
								<b>Shipping Method:</b> Flat Shipping Rate </td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td style="width: 50%; vertical-align: top;" class="text-left">Payment Address</td>
							<td style="width: 50%; vertical-align: top;" class="text-left">Shipping Address</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left">Jhone Cary
								<br>Central Square
								<br>22 Hoi Wing Road
								<br>New Delhi
								<br>India</td>
							<td class="text-left">Jhone Cary
								<br>Central Square
								<br>22 Hoi Wing Road
								<br>New Delhi
								<br>India
								</td>
						</tr>
					</tbody>
				</table>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-left">Product Name</td>
								<td class="text-left">Model</td>
								<td class="text-right">Quantity</td>
								<td class="text-right">Price</td>
								<td class="text-right">Total</td>
								<td style="width: 20px;"></td>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item, index) in order.order_items" :key="index">
								<td class="text-left">{{item.name}} </td>
								<td class="text-left"> <img :src="showImage(item.thumbnail)"/></td>
								<td class="text-right">{{item.quantity}}</td>
								<td class="text-right">{{currency(item.unitPrice)}}</td>
								<td class="text-right">{{currency(item.price)}}</td>
								<td style="white-space: nowrap;" class="text-right">
									 <!-- <a class="btn btn-primary" title="" data-toggle="tooltip" href="#" data-original-title="Reorder"><i class="fa fa-shopping-cart"></i></a>
									<a class="btn btn-danger" title="" data-toggle="tooltip" href="return.html" data-original-title="Return"><i class="fa fa-reply"></i></a> -->
								</td>
							</tr>

						</tbody>
						<tfoot>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Sub-Total</b>
								</td>
								<td class="text-right">{{currency(order.orderSubTotal)}}</td>
								<td></td>
							</tr>
							<!-- <tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Flat Shipping Rate</b>
								</td>
								<td class="text-right">$5.00</td>
								<td></td>
							</tr> -->
							<!-- <tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Eco Tax </b>
								</td>
								<td class="text-right">{{currency(order.orderTotalTax)}}</td>
								<td></td>
							</tr> -->
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>VAT </b>
								</td>
								<td class="text-right">{{currency(order.orderTotalTax)}}</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Total</b>
								</td>
								<td class="text-right">{{currency(order.orderTotal)}}</td>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
				<h3>Order History</h3>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-left">Date Added</td>
							<td class="text-left">Status</td>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item, index) in order.order_status" :key="index">
							<td class="text-left">{{vpDate(item.updated_at,'MMMM Do YYYY, h:mm:ss a')}}</td>
							<td class="text-left">{{item.status}}</td>
						</tr>
						
					</tbody>
				</table>
				<div class="buttons clearfix">
					<div class="pull-right"><a class="btn btn-primary" :href="baseUrl('customer/order/list')">Back</a>
					</div>
				</div>



			</div>
			<!--Middle Part End-->
</div>

</template>
<script>
export default {
    props:['id'],
	data() {
		return {
			order:[]
		}
	},
	mounted() {

		this.getOrderDetails(this.id)
	},
	methods: {
		getOrderDetails(id)
        {     
            let url='customer/order/list/'+id;
            this.$store.dispatch('getData',{url}).then((res)=>{
                    this.order=res.data;
                
            })
        }
	},
}
</script>
