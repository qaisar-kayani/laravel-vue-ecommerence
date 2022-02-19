// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import biddingLIst from '../views/pages/bidding/List.vue';


export default [
  {
      name: "bidding-list",
      path: "/vendor/bidding-list",
      component: biddingLIst,
      meta:{
        middleware:AuthMiddleware
        }
  },

];
