
import BreadCrumb from "../views/generalcomponents/BreadCrumb.vue";
import Toast from"../views/generalcomponents/Toast.vue"


export const registerComponents = (app) => 
{   
   
  
    app.component('BreadCrumb', BreadCrumb);
    app.component('Toast', Toast);
};