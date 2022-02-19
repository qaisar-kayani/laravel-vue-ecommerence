import  {createStore}  from "vuex";

// Import store modules
import authModule from "./modules/auth/index.js";
import Toast from "./modules/Toast/index.js";
import common from "./modules/common/index.js";
import cart from "./modules/cart/index.js"
import filter from "./modules/filter/index.js";
import product from "./modules/product/index.js";

const store = createStore({
    modules: {
        auth: authModule,
        Toast,
        common,
        cart,
        filter,
        product,
    },
    lastFetch: new Date().getTime(),
});

export default store;