// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import dashboard from '../views/pages/Dashboard.vue';

export default [
  {
      name: "dashboard",
      path: "/admin/dashboard",
      component: dashboard,
      meta:{
        middleware:AuthMiddleware
        }
  }
  ,
  
];
