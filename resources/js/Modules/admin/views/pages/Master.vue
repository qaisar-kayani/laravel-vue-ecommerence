<template lang="">
  <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
              <Toasts/>
           <Sidebar/>
         <div class="sa-app__content">
             <Header/>
         
         
              <router-view></router-view>
            <Footer/>
          </div>
   <div class="sa-app__toasts toast-container bottom-0 end-0"></div><!-- sa-app__toasts / end -->
</div>

</template>
<script>
import Header from "./layout/TheHeader.vue";
import Footer from "./layout/TheFooter.vue";
import Sidebar from "./layout/TheSidebar";
import Toasts from "../generalcomponents/Toast.vue";


export default {
  components: {
    Header,
    Footer,
    Sidebar,
    Toasts,
    
  },
  created() {
  // document.onreadystatechange = () => { 
    this.del_script('assets/js/stroyka.js')
    this.head_link('assets/css/style.css')
    this.body_script("assets/vendor/jquery/jquery.min.js");
    // this.body_script("assets/js/stroyka.js");
    this.body_script("js/theme.js");

    // }
   
  },
};
</script>