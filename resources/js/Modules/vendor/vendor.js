require('./bootstrap');
// APP Vue

import { createApp, popScopeId } from 'vue';
// APP Middleware Library
import MiddlewarePlugin from 'vue-router-middleware-plugin';
// Window.Vue=require('vue')
// Main App entry point
import App from './views/App.vue';
// App routes
import router from './router/index.js';
// App Store
import store from './store/index.js';
// helper functions
import helper from './mixins/helper';
import { globalHelpers } from './mixins/globalHelpers';
import jshelper from './mixins/jsHelper';

//axious
import axios from 'axios';
//Toast
import Toast from 'vue-toastification';
import { useToast } from 'vue-toastification';
const toast = useToast();
// Import the CSS or use your own!
import 'vue-toastification/dist/index.css';
// global component
import { registerComponents } from "./config/globalComponents";
// jquery
import * as jqueryExports from "jquery";
window.$ = jqueryExports.default;

//image preview
import vue3PhotoPreview from 'vue3-photo-preview';
import 'vue3-photo-preview/dist/index.css';






const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(MiddlewarePlugin, router);
app.use(store);
app.use(router);
app.mixin(helper);
app.mixin(jshelper);
app.mixin(globalHelpers);
app.use(Toast);
app.config.globalProperties.$toast = toast;

// Register Gloabal Components
registerComponents(app);
//loader
import loader from "vue-ui-preloader";
app.use(loader)
//pagination
import Pagination from 'v-pagination-3';
//image library use

app.component('pagination', Pagination);
// app.use(VueMeta);
//image views
app.use(vue3PhotoPreview)
app.mount('#vendor');
