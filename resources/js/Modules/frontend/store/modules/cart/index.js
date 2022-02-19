import mutations from "./mutations.js";
import getters from "./getters.js";
import actions from "./actions.js";

export default 
{
    // Important consideration
    namespace: true,

    state()
    {
        return {
            cart:{
                cartItem:[],
                totalItems: 0,
                cartSubtotal: 0,
                totalTax: 0,
                cartTotal: 0,
                cartID:(localStorage.getItem('cartID') && !!localStorage.getItem('cartID'))?localStorage.getItem('cartID'):null
            }
        }
    },
    getters: getters,
    mutations: mutations,
    actions: actions,
};