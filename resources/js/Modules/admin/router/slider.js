// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import venderList from '../views/pages/slider/List.vue';
import venderAdd from '../views/pages/slider/Add.vue';
import venderEdit from '../views/pages/slider/Edit.vue';


export default [
  {
      name: "slider-list",
      path: "/admin/slider-list",
      component: venderList,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "slider-add",
        path: "/admin/slider/add",
        component: venderAdd,
        meta:{
        middleware:AuthMiddleware
        }
},
{
        name: "slider-edit",
        path: "/admin/slider/edit/:id",
        component: venderEdit,
        meta:{
        middleware:AuthMiddleware
        }
}

];
