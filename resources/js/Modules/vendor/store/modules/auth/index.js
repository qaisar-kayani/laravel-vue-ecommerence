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
            isLogin:true?(localStorage.getItem('vendor_auth') && localStorage.getItem('vendor_auth')!=''):false,
            auth:localStorage.getItem('vendor_auth')?JSON.parse(localStorage.getItem('vendor_auth')):{}
        }
    },
    getters: getters,
    mutations: mutations,
    actions: actions,
};