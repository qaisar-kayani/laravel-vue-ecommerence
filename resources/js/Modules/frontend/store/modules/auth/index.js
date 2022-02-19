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
            isLogin:true?(localStorage.getItem('user_auth') && localStorage.getItem('user_auth')!=''):false,
            auth:localStorage.getItem('user_auth')?JSON.parse(localStorage.getItem('user_auth')):{}
        }
    },
    getters: getters,
    mutations: mutations,
    actions: actions,
};