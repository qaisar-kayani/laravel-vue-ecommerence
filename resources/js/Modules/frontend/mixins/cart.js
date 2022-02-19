import store from "../store"

export default {
   
    methods: {
        // add to cart 
        addToCart(item,isBid=false)// add to cart
		{	console.log(item)
			let data={
				product_id:item._id,
				parent_id:item.parent_id,
				vendor_id:item.vendor_id??0,
				sku:item.sku,
				name:item.name,
				// price:(item.sale_price)?item.sale_price:item.regular_price,
				// unitPrice:(item.sale_price)?item.sale_price:item.regular_price,
				quantity:item.quantity??1,
				// thumbnail:item.thumbnail,
				// image:item.feature_image,
				attributes:item.productAttributes??'',
				url:'customer/cart/addTocart',
				requesttype:'POST',
                 isBid:isBid,

			}
			if(localStorage.getItem('cartID')&& localStorage.getItem('cartID')!=="undefined"){data.cartId=localStorage.getItem('cartID')}
			    store.dispatch('saveData',data).then((res)=>{
				
				if(res.status==200)
				{
                    this.notification('Product added to Cart',item.name,'','success')
					localStorage.setItem('cartID',res.data._id)
					store.commit('setCart',res.data)
				}
			})   
		},  
        isLogin()
        {
            if(store.getters.auth)
            return true
            else
            return false
        },
        auth()
        {
            if(!store.getters.auth){this.redirect('login')}
        },
       
        
        
        
    },
}