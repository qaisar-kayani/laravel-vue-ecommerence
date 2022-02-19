// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import groupList from '../views/pages/group/List.vue';
import groupAdd from '../views/pages/group/Add.vue';
import groupEdit from '../views/pages/group/Edit.vue';
import productGrouping from "../views/pages/group/productGrouping.vue"


export default [
  {
      name: "group-list",
      path: "/admin/group-list",
      component: groupList,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "group-add",
        path: "/admin/group/add",
        component: groupAdd,
        meta:{
        middleware:AuthMiddleware
        }
},
{
        name: "group-edit",
        path: "/admin/group/edit/:id",
        component: groupEdit,
        meta:{
        middleware:AuthMiddleware
        }
},
{
        name: "product-group",
        path: "/admin/product-group",
        component: productGrouping,
        meta:{
        middleware:AuthMiddleware
        }
}

];
