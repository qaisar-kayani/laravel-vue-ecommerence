<template lang="">
    		<div class="row">
            <customer-aside/>
			<!--Middle Part Start-->
				<div id="content" class="col-sm-9">
				<h2 class="title">Order History</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
							
								<td class="text-left"  width="10%">Order ID</td>
								<td class="text-left">Image</td>
								<td class="text-left">Qty</td>
								<td class="text-left">Subtotal</td>
								<td class="text-left">Total</td>
								<td class="text-left">Order Date</td>
								<td class="text-left">Status</td>
								 <td class="text-left">Details</td>
							</tr>
						</thead>
						<tbody>
							
							<tr v-for="order in orders">
						<td class="text-left">{{order.orderNumber}}</td>
						<td class="text-left"><img :src="showImage(order?.order_items[0].thumbnail)"></td>
						<td class="text-left">{{order.totalItems}}</td>
						<td class="text-left">{{currency(order.orderSubTotal)}}</td>
						<td class="text-left">{{currency(order.orderTotal)}}</td>
						<td class="text-left">{{order.created_at}}</td>
						<td class="text-left">{{order.status}}</td>
						
						<td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" :href="baseUrl('customer/order/details/'+order._id)" data-original-title="View"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>

			</div>
			</div>


</template>
<script>
export default {
  data() {
    return {
      orders: [],
      
    }
  },
  mounted() {
      this.getOrderList();
  },
  methods:{
	   getOrderList()
        {     
            let url='customer/order/list';
            this.$store.dispatch('getData',{url}).then((res)=>{
                    this.orders=res.data;
                
            })
        }
  },
};
</script>
