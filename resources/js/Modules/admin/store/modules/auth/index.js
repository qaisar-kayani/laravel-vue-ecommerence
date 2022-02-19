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
            isLogin:true?(localStorage.getItem('admin_auth') && localStorage.getItem('admin_auth')!=''):false,
            auth:localStorage.getItem('admin_auth')?JSON.parse(localStorage.getItem('admin_auth')):{}
        }
    },
    getters: getters,
    mutations: mutations,
    actions: actions,
};