<template lang="">
   <div class="row">
			<!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h2 class="title">Shopping Cart</h2>
            <div class="table-responsive form-group" v-if="$store.getters.getCart.cartItem.length>0">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td class="text-center">Image</td>
                    <td class="text-left">Product Name</td>
                    <td class="text-left">Quantity</td>
                    <td class="text-right">Unit Price</td>
                    <td class="text-right">Total</td>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in $store.getters.getCart.cartItem" :key="index">
                    <td class="text-center"><img  :src="showImage(item.thumbnail)" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-thumbnail" /></td>
                    <td class="text-left">{{item.name}}<br />
                     </td>
                    <td class="text-left" width="200px">
                      <div class="input-group btn-block quantity">
                        <input type="text" name="quantity" :readonly="item.isBid" v-model="quantityList[index].quantity" size="1" class="form-control" />
                        <span class="input-group-btn">
                        <button type="submit" data-toggle="tooltip" title="Update" class="btn btn-primary"  v-if="!item.isBid" @click="updateCart(item.cart_id,item.product_id,quantityList[index].quantity)"><i class="fa fa-clone"></i></button>
                        <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" @click="removeCart(item.cart_id,item.product_id)"><i class="fa fa-times-circle"></i></button>
                        </span>
                        </div>
                        
                      </td>
                    <td class="text-right">{{currency(item.unitPrice)}}</td>
                    <td class="text-right">{{currency(item.price)}}</td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
        
		
		<div class="row"  v-if="$store.getters.getCart.cartItem.length>0">
			<div class="col-sm-4 col-sm-offset-8">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td class="text-right">
								<strong>Sub-Total:</strong>
							</td>
							<td class="text-right">{{currency($store.getters.getCart.cartSubtotal)}}</td>
						</tr>
						<!-- <tr>
							<td class="text-right">
								<strong>Flat Shipping Rate:</strong>
							</td>
							<td class="text-right">$4.69</td>
						</tr> -->
						<!-- <tr>
							<td class="text-right">
								<strong>Eco Tax (-2.00):</strong>
							</td>
							<td class="text-right">$5.62</td>
						</tr> -->
						<tr>
							<td class="text-right">
								<strong>VAT {{currency($store.getters.getCart.totalTax)}}:</strong>
							</td>
							<td class="text-right">{{currency($store.getters.getCart.totalTax)}}</td>
						</tr>
						<tr>
							<td class="text-right">
								<strong>Total:</strong>
							</td>
							<td class="text-right">{{currency($store.getters.getCart.cartTotal)}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		 <div class="buttons"  v-if="$store.getters.getCart.cartItem.length>0">
            <div class="pull-left"><a onclick="history.back()" class="btn btn-primary">Continue Shopping</a></div>
            <div class="pull-right"><a :href="($store.getters.auth)?baseUrl('checkout'):baseUrl('login')" class="btn btn-primary">Checkout</a></div>
          </div>
        </div>
        <!--Middle Part End -->
			
		</div>
</template>
<script>
export default {
    data() {
        return {
            quantityList:[]
        }
    },
    mounted() {
        

    },
    watch:{
       "$store.getters.getCart.cartItem":{
           immediate:true,
           handler()
           {
               this.quantityList=this.$store.getters.getCart.cartItem
           }
       }
    },
    methods: {

        removeCart(cartId,product_id)
        {   
            this.$store.dispatch('saveData',{url:'customer/cart/removeItem',product_id,cartId}).then((res)=>{
                
                if (res.status==200) {
                    this.$store.commit('setCart',res.data)
                    this.notification('Remove','Item Remove','','error')
                }

            })
        },
        updateCart(cartId,product_id,quantity)
         {   
            if(quantity=='' || quantity<1){
                this.notification('Warning','Quantity should be at least 1','','error')
                return false}
            this.$store.dispatch('saveData',{url:'customer/cart/updateCart',product_id,cartId,quantity}).then((res)=>{
                
                if (res.status==200) {
                    this.$store.commit('setCart',res.data)
                    this.notification('Update','Cart Updated','','success')
                }

            })
         }
    },
}
</script>
