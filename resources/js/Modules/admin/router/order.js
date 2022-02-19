// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import orderLIst from '../views/pages/order/List.vue';
import orderDetail from '../views/pages/order/ListDetails.vue';
// import venderEdit from '../views/pages/order/Edit.vue';


export default [
  {
      name: "order-list",
      path: "/admin/order-list",
      component: orderLIst,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "order-detail",
        path: "/admin/order-detail/:id",
        component: orderDetail,
        meta:{
        middleware:AuthMiddleware
        }
},
// {
//         name: "order-edit",
//         path: "/admin/order/edit/:id",
//         component: venderEdit,
//         meta:{
//         middleware:AuthMiddleware
//         }
// }

];
