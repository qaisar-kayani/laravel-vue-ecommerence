<template>

<div v-if="this.$store.getters.auth">
<AppMaster/>
</div>
<div v-else>
<router-view></router-view>
</div>
 
</template>

<script>
import AppMaster from"./pages/Master.vue"
import AUthLogin from"./auth/Login.vue"

export default {
    components:
    {
      AppMaster,
      AUthLogin,
    },
   
    

    
}
</script>
