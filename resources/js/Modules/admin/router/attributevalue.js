// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import venderList from '../views/pages/attributevalue/List.vue';
import venderAdd from '../views/pages/attributevalue/Add.vue';
import venderEdit from '../views/pages/attributevalue/Edit.vue';


export default [
  {
      name: "attributevalue-list",
      path: "/admin/attributevalue-list",
      component: venderList,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "attributevalue-add",
        path: "/admin/attributevalue/add",
        component: venderAdd,
        meta:{
        middleware:AuthMiddleware
        }
},
{
        name: "attributevalue-edit",
        path: "/admin/attributevalue/edit/:id",
        component: venderEdit,
        meta:{
        middleware:AuthMiddleware
        }
}

];
