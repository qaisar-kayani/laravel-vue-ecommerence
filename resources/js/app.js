

import { createApp } from 'vue';


let app=createApp({})
app.component('example-component', require('./components/ExampleComponent.vue').default);
// catalog
app.component('category-product',require('./Modules/frontend/views/pages/catalog/categoryProduct').default);

app.mount("#frontend")
