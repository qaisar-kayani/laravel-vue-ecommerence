import  {createStore}  from "vuex";

// Import store modules
import authModule from "./modules/auth/index.js";
import Toast from "./modules/Toast/index.js";
import profile from "./modules/profile/index";
import product from "./modules/product/index";
import common from "./modules/common/index.js";

const store = createStore({
    modules: {
        auth: authModule,
        Toast,
        profile,
        product,
        common,
    },
    lastFetch: new Date().getTime(),
});

export default store;