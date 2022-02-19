<template lang="">
   <div class="row" >
	   <form @submit.prevent="orderPlace()">
			<!--Middle Part Start-->
			<div id="content" class="col-sm-12">
			  <h2 class="title">Checkout</h2>
			  <div class="so-onepagecheckout row">
				<div class="col-left col-sm-3">
				  
				  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title"><i class="fa fa-user"></i> Your Personal Details</h4>
					</div>
					  <div class="panel-body">
							<fieldset id="account">
							  <div class="form-group required">
								<label for="input-payment-firstname" class="control-label">First Name</label>
								<input type="text" name="firstname" v-model="form.customer.first_name" placeholder="First Name"  :class="_vClass(_validator.form.customer,'first_name')"  id="input-firstname" class="form-control">
                               
							  </div>
							  <div class="form-group required">
								<label for="input-payment-lastname" class="control-label">Last Name</label>
								<input type="text" name="lastname" v-model="form.customer.last_name" placeholder="Last Name" :class="_vClass(_validator.form.customer,'last_name')" id="input-lastname" class="form-control">
                               
							  </div>
							  <div class="form-group required">
								<label for="input-payment-email" class="control-label">E-Mail</label>
									<input type="email" name="email" v-model="form.customer.email" placeholder="E-Mail" id="input-email" :class="_vClass(_validator.form.customer,'email')" class="form-control">
                                   
							  </div>
							  <div class="form-group required">
								<label for="input-payment-telephone" class="control-label">Telephone</label>
								<input type="tel" name="telephone" v-model="form.customer.mobile" placeholder="Telephone" id="input-telephone" :class="_vClass(_validator.form.customer,'mobile')" class="form-control">
                             
							  </div>
							  
							</fieldset>
						  </div>
				  </div>
				  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title"><i class="fa fa-book"></i> Your Address</h4>
					</div>
					  <div class="panel-body">
							<fieldset id="address" class="required">
							  <div class="form-group">
								<label for="input-payment-company" class="control-label">Country</label>
								<select name="country_id" v-model="form.address.country" id="input-country" class="form-control" :class="_vClass(_validator.form.address,'country')">
									<option value=""> --- Please Select --- </option>
									<option :value="item.name" v v-for="(item, index) in countryList" :key="index">{{item.name}}</option>
								
								</select>
							  </div>
							  <div class="form-group required">
								<label for="input-payment-address-1" class="control-label">State </label>
								<input type="text" class="form-control" id="" placeholder="state /region" v-model="form.address.state" :class="_vClass(_validator.form.address,'state')">
							  </div>
							  <div class="form-group">
								<label for="input-payment-address-2" class="control-label">City </label>
								<input type="text" class="form-control" id="" placeholder="city" v-model="form.address.city" :class="_vClass(_validator.form.address,'city')">
							  </div>
							  <div class="form-group required">
								<label for="input-payment-city" class="control-label">Address 1</label>
								<input type="text" class="form-control" id="" placeholder="Address 1" v-model="form.address.address1"  :class="_vClass(_validator.form.address,'address1')">
							  </div>
							  <div class="form-group ">
								<label for="input-payment-city" class="control-label">Address 2</label>
								<input type="text" class="form-control" id="" placeholder="Address 2" v-model="form.address.address2"  :class="_vClass(_validator.form.address,'address2')">
							  </div>
							  <div class="form-group required">
								<label for="input-payment-postcode" class="control-label">Zip Code</label>
								<input type="text" class="form-control" id="" placeholder="Zip Code" v-model="form.address.zip" :class="_vClass(_validator.form.address,'zip')">
							  </div>
							  
							  <div class="checkbox">
								<label>
								  <input type="checkbox" checked="checked" value="1" name="shipping_address">
								  My delivery and billing addresses are the same.</label>
							  </div>
							</fieldset>
						  </div>
				  </div>
				</div>
				<div class="col-right col-sm-9">
				  <div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default no-padding">
							<div class="col-sm-6 checkout-shipping-methods">
								<div class="panel-heading">
								  <h4 class="panel-title"><i class="fa fa-truck"></i> Delivery Method</h4>
								</div>
								<div class="panel-body ">
									<p>Please select the preferred shipping method to use on this order.</p>
									<div class="radio">
									  <label>
										<input type="radio"  value="free" name="shipping" v-model="form.shipping.shippingMethod">
										Free Shipping - $0.00</label>
									</div>

									<div class="radio">
									  <label>
										<input type="radio" value="paid" name="shipping" v-model="form.shipping.shippingMethod">
										Flat Shipping Rate - $7.50</label>
									</div>
									
								</div>
							</div>
							<div class="col-sm-6  checkout-payment-methods">
								<div class="panel-heading">
								  <h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
								</div>
								<div class="panel-body">
									<p>Please select the preferred payment method to use on this order.</p>
									<div class="radio">
									  <label>
										<input type="radio" checked="checked" name="payment"  value="cash"  v-model="form.payment.paymentMethod">Cash On Delivery</label>
									</div>
									
									<div class="radio">
									  <label>
										<input type="radio" name="payment" value="paypal"  v-model="form.payment.paymentMethod">Paypal</label>
									</div>
								</div>
							</div>
						</div>
						
						
							
						</div>
					
					
					
					<div class="col-sm-12">
					  <div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title"><i class="fa fa-ticket"></i> Do you Have a Coupon or Voucher?</h4>
						</div>
						  <div class="panel-body row">
							<div class="col-sm-6 ">
							<div class="input-group">
							  <input type="text" class="form-control" id="input-coupon" placeholder="Enter your coupon here" value="" name="coupon">
							  <span class="input-group-btn">
							  <input type="button" class="btn btn-primary" data-loading-text="Loading..." id="button-coupon" value="Apply Coupon">
							  </span></div>
							</div>
							
							<div class="col-sm-6">
							<div class="input-group">
							  <input type="text" class="form-control" id="input-voucher" placeholder="Enter your gift voucher code here" value="" name="voucher">
							  <span class="input-group-btn">
							  <input type="submit" class="btn btn-primary" data-loading-text="Loading..." id="button-voucher" value="Apply Voucher">
							  </span> </div>
							</div>
						  </div>
					  </div>
					</div>
					
					<div class="col-sm-12">
					  <div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
						</div>
						  <div class="panel-body">
							<div class="table-responsive">
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
                                    <td class="text-left" width="200px"><div class="input-group btn-block quantity" >
                                        <input type="text" name="quantity" :readonly="item.isBid"  v-model="quantityList[index].quantity" size="1" class="form-control" />
                                        <span class="input-group-btn">
                                        <button type="button"  data-toggle="tooltip" title="Update" class="btn btn-primary" v-if="!item.isBid"  @click="updateCart(item.cart_id,item.product_id,quantityList[index].quantity)"><i class="fa  fa-refresh"></i></button>
                                        <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" @click="removeCart(item.cart_id,item.product_id)"><i class="fa fa-times-circle"></i></button>
                                        </span>
										</div>
										
										</td>
                                    <td class="text-right">{{currency(item.unitPrice)}}</td>
                                    <td class="text-right">{{currency(item.price)}}</td>
                                     </tr>
								</tbody>
								<tfoot>
								 						<tr>
							<td class="text-right"  colspan="4">
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
							<td class="text-right"  colspan="4">
								<strong>VAT {{currency($store.getters.getCart.totalTax)}}:</strong>
							</td>
							<td class="text-right">{{currency($store.getters.getCart.totalTax)}}</td>
						</tr>
						<tr>
							<td class="text-right"  colspan="4">
								<strong>Total:</strong>
							</td>
							<td class="text-right">{{currency($store.getters.getCart.cartTotal)}}</td>
						</tr>
								</tfoot>
							  </table>
							</div>
						  </div>
					  </div>
					</div>
					<div class="col-sm-12">
					  <div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About Your Order</h4>
						</div>
						  <div class="panel-body">
							<textarea rows="4" class="form-control" id="confirm_comment" name="comments" v-model="form.comment"></textarea>
							<br>
							<label class="control-label" for="confirm_agree">
							  <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
							  <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label>
							<div class="buttons">
							  <div class="pull-right">
								<input type="submit" class="btn btn-primary" id="button-confirm" value="Confirm Order">
							  </div>
							</div>
						  </div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<!--Middle Part End -->
			</form>
		</div>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required,helpers,email,minLength, sameAs} from "@vuelidate/validators";
export default {
	setup() {
        return {
            _validator: useVuelidate(),
        };
		},

	 validations() {
        return {
            form: {
				customer:
				{
					first_name: { required:helpers.withMessage('First Name required', required) },
					last_name: { required:helpers.withMessage('Last Name required', required) },
					email: { required:helpers.withMessage('Email required', required),email },
					mobile: { required:helpers.withMessage('Contact number required', required) },
				},
                
				//address area
                address:
				{
					country: { required:helpers.withMessage('country required', required) },
					city: { required:helpers.withMessage('city required', required) },
					state: { required:helpers.withMessage('state required', required) },
					address1: { required:helpers.withMessage('address required', required) },
					zip: { required:helpers.withMessage('zip required', required) },
				}
				
            },
        };
    },

    data() {
        return {
             quantityList:[],
             countryList:[],
			 form: {
				 	cartId:this.$store.getters.getCart.cartID,
					customer:{

						first_name:this.$store.getters.getAuth.first_name,
						last_name:this.$store.getters.getAuth.last_name,
						email: this.$store.getters.getAuth.email,
						mobile:this.$store.getters.getAuth.mobile,
					},
					address:{

						//second tab
							country_code:'AE',
							country:"United Arab Emirates",
							state:null,
							city:null,
							address1:null,
							address2:null,
							zip:null,
							street:"2",
                    		building:"Feaam towers",
                    		flat:"12",
                    		instruction:"hello sun",
							isDefault:true,
                 			type:"HOme"
					},
					shipping:{
						shippingMethod:'free'
					},
					payment:
					{
						paymentMethod:'cash'
					},
					comment:null
					
        	},
        }
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
    mounted() {
               
		this.auth()
		this.getCountryLIst() //get currenty list
    },
    methods: {
        
        orderPlace() //place order
		{	
			
			this._validator.$validate();
			console.log(this._validator)
      		if(this._validator.$error)return false
			let city=this.countryList.find((item)=>item.name==this.form.address.country)
       		this.form.customer.country_code=city.code
			this.form.url='customer/order/create'
			this.form.requesttype='POST'
			this.$store.dispatch('saveData',this.form).then((res)=>{
				if (res.status==200) {
					localStorage.removeItem('cartID')
					this.redirect('order-success/'+res.data.data._id)
					// console.log(res.data.data)
				}
			})
		},
        
        
        
        getCountryLIst()//country list
            {
                this.$store.dispatch('getData',{url:'country/list',requesttype:'GET'}).then((res)=>{
                    if(res.status==200)
                    {
                        this.countryList=res.data
                    }
                })
            },



        //carts
        removeCart(cartId,product_id)
        {   
            this.$store.dispatch('saveData',{url:'customer/cart/removeItem',product_id,cartId}).then((res)=>{
                
                if (res.status==200) {
                    this.$store.commit('setCart',res.data)
                    this.notification('Remove','Item Remove','','error')
                     if(this.$store.getters.getCart.cartItem.length==0){this.redirect('home')}
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
<style scoped>
.form-control.is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    /* background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e); */
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
</style>