// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import venderList from '../views/pages/attribute/List.vue';
import venderAdd from '../views/pages/attribute/Add.vue';
import venderEdit from '../views/pages/attribute/Edit.vue';


export default [
  {
      name: "attribute-list",
      path: "/admin/attribute-list",
      component: venderList,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "attribute-add",
        path: "/admin/attribute/add",
        component: venderAdd,
        meta:{
        middleware:AuthMiddleware
        }
},
{
        name: "attribute-edit",
        path: "/admin/attribute/edit/:id",
        component: venderEdit,
        meta:{
        middleware:AuthMiddleware
        }
}

];
