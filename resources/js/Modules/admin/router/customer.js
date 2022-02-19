// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import venderList from '../views/pages/customer/List.vue';
import venderAdd from '../views/pages/customer/Add.vue';
import venderEdit from '../views/pages/customer/Edit.vue';


export default [
  {
      name: "customer-list",
      path: "/admin/customer-list",
      component: venderList,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "customer-add",
        path: "/admin/customer/add",
        component: venderAdd,
        meta:{
        middleware:AuthMiddleware
        }
},
{
        name: "customer-edit",
        path: "/admin/customer/edit/:id",
        component: venderEdit,
        meta:{
        middleware:AuthMiddleware
        }
}

];
