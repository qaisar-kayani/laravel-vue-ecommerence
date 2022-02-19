<template lang="">
    		<div class="row">
            <customer-aside activeTab="dashboard"/>
			<!--Middle Part Start-->
				<div id="content" class="col-sm-9 mt--3">
				<h2 class="title ">Wellcome to  <strong>DashBoard</strong>!</h2>

				<div class="row">
						<div class="col-6 col-md-4 col-lg-4 ">
							<div class="card text-center feature-box well" >
							<a :href="baseUrl('customer/dashboard')" class="text-reset p-5 text-decoration-none sa-hover-area">
								<div class="fs-4 mb-4 text-muted opacity-50">
									<i class="fa-col fa fa-user fa-3x"></i>
								</div>
								<h2 class="fs-6 fw-medium mb-3">Your Account</h2>
								</a>
							</div>
						</div>
						<div class="col-6 col-md-4 col-lg-4 ">
							<div class="card text-center feature-box well" >
							<a :href="baseUrl('customer/order/list')" class="text-reset p-5 text-decoration-none sa-hover-area">
								<div class="fs-4 mb-4 text-muted opacity-50">
									<i class="fa-col fa fa-shopping-cart fa-3x"></i>
								</div>
								<h2 class="fs-6 fw-medium mb-3">Your Orders</h2>
								</a>
							</div>
						</div>
						<div class="col-6 col-md-4 col-lg-4 ">
							<div class="card text-center feature-box well" >
							<a :href="baseUrl('customer/bidding')" class="text-reset p-5 text-decoration-none sa-hover-area">
								<div class="fs-4 mb-4 text-muted opacity-50">
									<i class=" fa-col fa fa-gavel fa-3x"></i>
								</div>
								<h2 class="fs-6 fw-medium mb-3">Live Bidding</h2>
								</a>
							</div>
						</div>
						<div class="col-6 col-md-4 col-lg-4 ">
							<div class="card text-center feature-box well" >
							<a href="#" class="text-reset p-5 text-decoration-none sa-hover-area">
								<div class="fs-4 mb-4 text-muted opacity-50">
									<i class=" fa-col fa fa-address-card fa-3x"></i>
								</div>
								<h2 class="fs-6 fw-medium mb-3">Your Addresses</h2>
								</a>
							</div>
						</div>	
						<div class="col-6 col-md-4 col-lg-4 ">
							<div class="card text-center feature-box well" >
							<a href="#" class="text-reset p-5 text-decoration-none sa-hover-area">
								<div class="fs-4 mb-4 text-muted opacity-50">
									<i class=" fa-col fa fa-undo fa-3x"></i>
								</div>
								<h2 class="fs-6 fw-medium mb-3">Returns</h2>
								</a>
							</div>
						</div>
						<div class="col-6 col-md-4 col-lg-4 ">
							<div class="card text-center feature-box well" >
							<a href="#" class="text-reset p-5 text-decoration-none sa-hover-area">
								<div class="fs-4 mb-4 text-muted opacity-50">
									<i class=" fa-col fa fa-credit-card fa-3x"></i>
								</div>
								<h2 class="fs-6 fw-medium mb-3">Payment Options</h2>
								</a>
							</div>
						</div>		
				</div>			


			</div>
			</div>


</template>
<script>
export default {
    
}
</script>
<style scoped>
.fa-col
{
	color:#efc803;
}
</style>