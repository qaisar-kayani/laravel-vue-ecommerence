
require('./bootstrap');
// APP Vue

import { createApp, popScopeId } from 'vue';


import App from './views/App.vue';
// helper functions
global.$ = global.jQuery = require('jquery');
global.$vm = global.jQuery = require('jquery');
import helper from './mixins/helper';
import { globalHelpers } from './mixins/globalHelpers';
import jshelper from './mixins/jsHelper';
import {request} from './mixins/request';
import cart from './mixins/cart';
// var BaseUrl=process.env.APP_URL;
//axious

import axios from 'axios';
//Toast
import Toast from 'vue-toastification';
import { useToast } from 'vue-toastification';
const toast = useToast();
// Import the CSS or use your own!
import 'vue-toastification/dist/index.css';
import store from './store';




const app = createApp({});
app.config.globalProperties.$axios = axios;
// app.use(MiddlewarePlugin, router);
// app.use(router);

app.use(store);
app.mixin(helper);
app.mixin(jshelper);
app.mixin(globalHelpers);
app.mixin(request);
app.mixin(cart);
app.use(Toast);
app.config.globalProperties.$toast = toast;


//pagination
import Pagination from 'v-pagination-3';
// home pagination 

app.component('pagination', Pagination);
//component
app.component('example-component', require('../../components/ExampleComponent.vue').default);
//cart
app.component('cart-list',require('./views/pages/layout/cart').default);
// filter 
app.component('categoty-filter',require('./views/pages/catalog/categoryFilter').default);

// catalog
app.component('category-product',require('./views/pages/catalog/CategoryProduct').default);
app.component('single-product',require('./views/pages/catalog/singleProduct').default);
app.component('aside-product',require('./views/pages/catalog/singleProductAside').default);

//order list
app.component('shoping-cart',require('./views/pages/order/shopingCart').default);
app.component('checkout-cart',require('./views/pages/order/checkout').default);

//customer route
app.component('customer-login',require('./views/pages/customer/login').default);
app.component('customer-register',require('./views/pages/customer/register').default);
//vendor register
app.component('vendor-register',require('./views/pages/customer/vendorRegister').default);

//small picess components
app.component('header-profile',require('./views/pages/shortPage/headerProfile').default);
//dashboard pages
app.component('customer-dashboard',require('./views/pages/dashboardPages/Dashboard').default);
app.component('customer-aside',require('./views/pages/dashboardPages/aside').default);
//bidding page
app.component('customer-bidding',require('./views/pages/dashboardPages/bidding').default);
app.component('customer-orderlist',require('./views/pages/dashboardPages/orderList').default);
app.component('customer-orderdetails',require('./views/pages/dashboardPages/orderDetails').default);
//profile
app.component('customer-profile',require('./views/pages/dashboardPages/profile').default);

//Home page
app.component('shop-by-category',require('./views/pages/home/shopByCategory').default);
app.component('shop-best-sale',require('./views/pages/home/bestSaleProduct').default);





app.mount('#frontend');