import { request } from "../../../mixins/request";

export default 
{
    getCart(context, payload)
    {
        // context.commit("setAuth", payload);
        if( context.state.cart.cartID===null || context.state.cart.cartID ==="undefined"){ return true}
        let url='/customer/cart/list/'+context.state.cart.cartID
        return  request.methods.makeRequest("GET",url,payload,false)
            .then((data) => {
                if(data.status==200){
                    
                    context.commit("setCart", data.data);
                }
                return data
                
            })
    }
};