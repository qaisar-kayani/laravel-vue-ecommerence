export default 
{
    setCart(state, payload)
    {       

            state.cart.cartItem=payload.cart_items,
            state.cart.totalItems=payload.totalItems,
            state.cart.cartSubtotal=payload.cartSubTotal,
            state.cart.totalTax=payload.totalTax,
            state.cart.cartTotal=payload.cartTotal,
            state.cart.cartID=payload._id
    },
    
};