// middleware 
import AuthMiddleware from '../middleware/AuthMiddleware';
// Components
import Profile from '../views/pages/profile/Profile.vue';

export default [
  {
      name: "profile",
      path: "/vendor/profile",
      component: Profile,
      meta:{
        middleware:AuthMiddleware
        }
  }
];
