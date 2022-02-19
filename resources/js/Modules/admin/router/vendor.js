// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import venderList from '../views/pages/vendor/List.vue';
import venderAdd from '../views/pages/vendor/Add.vue';
import venderEdit from '../views/pages/vendor/Edit.vue';


export default [
  {
      name: "vendor-list",
      path: "/admin/vendor-list",
      component: venderList,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "vendor-add",
        path: "/admin/vendor/add",
        component: venderAdd,
        meta:{
        middleware:AuthMiddleware
        }
},
{
        name: "vendor-edit",
        path: "/admin/vendor/edit/:shop_id/:vendor_id",
        component: venderEdit,
        meta:{
        middleware:AuthMiddleware
        }
}

];
