// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import orderLIst from '../views/pages/order/List.vue';
import orderDetail from '../views/pages/order/ListDetails.vue';
// import venderEdit from '../views/pages/order/Edit.vue';
// const orderLIst = () => import('../views/pages/order/List.vue')

export default [
  {
      name: "order-list",
      path: "/vendor/order-list",
      component: orderLIst,
      meta:{
        middleware:AuthMiddleware
        }
  },

  {
        name: "order-detail",
        path: "/vendor/order-detail/:id",
        component: orderDetail,
        meta:{
        middleware:AuthMiddleware
        }
},
// {
//         name: "order-edit",
//         path: "/vendor/order/edit/:id",
//         component: venderEdit,
//         meta:{
//         middleware:AuthMiddleware
//         }
// }

];
