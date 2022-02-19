<template lang="">
                             <div class="shopping_cart">
                            <div id="cart" class="btn-shopping-cart">
    
                                <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <div class="shopcart">
                                        <span class="icon-c">
                                        <i class="fa fa-shopping-bag"></i>
                                      </span>
                                        <div class="shopcart-inner">
                                            <p class="text-shopping-cart">
                                                My cart
                                            </p>
    
                                            <span class="total-shopping-cart cart-total-full">
                                                <span class="items_cart">{{$store.getters.getCart.totalItems}}</span><span class="items_cart2"> item(s)</span><span class="items_carts"> {{currency($store.getters.getCart.cartTotal)}} </span>
                                            </span>
                                        </div>
                                    </div>
                                </a>
    
                                <ul class="dropdown-menu pull-right shoppingcart-box" role="menu" v-if="$store.getters.getCart.cartItem.length>0">
                                    <li>
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr v-for="(item, index) in $store.getters.getCart.cartItem" :key="index">
                                                    <td class="text-center" style="width:70px">
                                                       
                                                            <img :src="showImage(item.thumbnail)" style="width:70px" alt="Yutculpa ullamcon" title="Yutculpa ullamco" class="preview">
                                                       
                                                    </td>
                                                    <td class="text-left"> {{item.name}} 
                                                    </td>
                                                    <td class="text-center">x{{item.quantity}}</td>
                                                    <td class="text-center">{{currency(item.price)}}</td>
                                                    <td class="text-right">
                                                        <a href="product.html" class="fa fa-edit"></a>
                                                    </td>
                                                    <td class="text-right">
                                                        <a @click="removeCart(item.cart_id,item.product_id)" class="fa fa-times fa-delete"></a>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </li>
                                    <li>
                                        <div>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left"><strong>Sub-Total</strong>
                                                        </td>
                                                        <td class="text-right">{{currency($store.getters.getCart.cartSubtotal)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><strong>VAT {{currency($store.getters.getCart.totalTax)}}</strong>
                                                        </td>
                                                        <td class="text-right">{{currency($store.getters.getCart.totalTax)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><strong>Total</strong>
                                                        </td>
                                                        <td class="text-right">{{currency($store.getters.getCart.cartTotal)}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="text-right"> <a class="btn view-cart" :href="baseUrl('cart')"><i class="fa fa-shopping-cart"></i>View Cart</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-mega checkout-cart" :href="($store.getters.auth)?baseUrl('checkout'):baseUrl('login')"><i class="fa fa-share"></i>Checkout</a> 
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="dropdown-menu pull-right shoppingcart-box" v-if="$store.getters.getCart.cartItem.length==0">
                                    <li>
                                        <p class="text-center empty">Your shopping cart is empty!</p>
                                    </li>
                                </ul>
                            </div>
    
                        </div>
</template>
<script>
export default {
    mounted() {
        this.$store.dispatch('getCart')
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
       
    },
}
</script>
<style lang="">
    
</style>