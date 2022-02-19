<template lang="">
        	<aside class="col-sm-3 card well  hidden-xs" id="column-right">
				<h2 class="subtitle ">Account</h2>
<div class="list-group pr-4">
	<ul class="nav nav-pills nav-stacked">
	
		<li :class="(active=='dashboard')?'active':''"><a :href="baseUrl('customer/dashboard')">My Account</a></li>
		<li  :class="(active=='order/list'||active=='order/details')?'active':''"><a :href="baseUrl('customer/order/list')">Order History</a></li>
		<li  :class="(active=='bidding')?'active':''"><a :href="baseUrl('customer/bidding')">Bidding</a></li>
		<li  :class="(active=='address')?'active':''"><a href="#">Order Address</a></li>
		<li  :class="(active=='support')?'active':''"><a href="#')">Support</a></li>
		<li ><a @click="logout">Logout</a></li>
		
	</ul>
</div>			</aside>
</template>
<script>
export default {
	props:['activeTab'],
	data() {
		return {
			active:'null'
		}
	},
    mounted() {
        this.auth();//for auth
		this.active=this.activeTab
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
<style scoped>
	.nav-pills li.active a {
        color: #fff;
        background-color: #ffd333
    }
	
</style>
