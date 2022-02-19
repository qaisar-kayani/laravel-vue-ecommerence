<template lang="">
                 <div class="bottom2 col-lg-4 hidden-md col-sm-6 col-xs-8">  
                     <div class="signin-w font-title hidden-sm hidden-xs">
                        <ul class="signin-link blank" v-if="$store.getters.auth">
                            <li class="log login"><i class="fa fa-lock"></i> <a class="link-lg" @click="logout()">logout</a> </li>                                
                        </ul> 
                    </div>                
                    <div class="telephone hidden-xs hidden-sm hidden-md">
                        <ul class="signin-link blank" v-if="!$store.getters.auth">                            
                            <li class="log login"><i class="fa fa-lock"></i> <a class="link-lg" :href="baseUrl('login')">Login </a> or <a :href="baseUrl('register')">Register</a></li>                                
                        </ul>
                        <ul class="signin-link blank" v-if="$store.getters.auth">                            
                            <li class="log login"><i class="fa fa-user"></i> <a class="link-lg" :href="baseUrl('customer/dashboard')">{{$store.getters.getAuth.first_name}} </a> </li>                                
                        </ul> 
                                              
                    </div>
                    
                    <div class="telephone hidden-xs hidden-sm hidden-md">
                        <ul class="blank"> <li><a href="#"><i class="fa fa-truck"></i>track your order</a></li> </ul>
                    </div>
                                        
                    
                </div>
</template>
<script>
export default {
    
    data() {
        return {
            
        }
    },
    mounted() {
        
    },
    methods: {
        logout()
        {
            this.$store.commit('logout')
            this.redirect('login')
        }
    },

}
</script>
<style lang="">
    
</style>