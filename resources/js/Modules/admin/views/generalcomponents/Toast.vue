<template lang="">
  <loader v-if="$store.getters.getToast" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>hi
</template>
<script>

export default 
{
   components: {
            //  loader
        },

    data() {
        return {
             isLoading: false,
             fullPage: true    
        }
    },

}
  
</script>
<style lang="">
    
</style>