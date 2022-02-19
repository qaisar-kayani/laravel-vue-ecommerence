<template lang="">
    <!-- Main Container  -->
	
		<div class="row">
			<div id="content" class="col-sm-12">
				<div class="page-login">
				
					<div class="account-border">
						<div class="row">
						
							
							<form @submit.prevent="login">
								<div class="col-sm-offset-3 col-sm-6 customer-login">
									<div class="well">
										<h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Returning Customer</h2>
										<p><strong>I am a returning customer</strong></p>
										<div class="form-group">
											<label class="control-label " >E-Mail Address</label>
											<input type="text" name="email"  v-model="form.email" class="form-control"   :class="_vClass(_validator.form,'email')" />
                                            <div class="text-danger bold">{{_vErrorMessage(_validator.form,'email')}}</div>
										</div>
										<div class="form-group">
											<label class="control-label " for="input-password">Password</label>
											<input type="password" name="password"  v-model="form.password" id="input-password"  :class="_vClass(_validator.form,'password')" class="form-control" />
                                            <div class="text-danger bold">{{_vErrorMessage(_validator.form,'password')}}</div>
										</div>
									</div>
									<div class="bottom-form">
                    <a :href="baseUrl('register')" class="forget">Don't have an account? Sign up </a>
										<input type="submit" value="Login" class="btn btn-default pull-right" />
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	<!-- //Main Container -->
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required,helpers,email } from "@vuelidate/validators";
export default {

      // mixins:[helper],
   setup() {
        return {
            _validator: useVuelidate(),
        };
    },
    validations() {
        return {
            form: {
                email: { required:helpers.withMessage('user Email required', required) },
                password: { required:helpers.withMessage('user Password required', required) },
            },
        };
    }, 
  mounted() {
   
  },

  data() {
    return {
      form: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    login() {

        this._validator.$validate();
        if(this._validator.$error)return false
    
        this.$store.dispatch("fetchAuthLogin", this.form).then((res) => {
            if (res.status == 200) {
            // this.$router.push({ name: "dashboard" });
            this.redirect('home')
           this.$toast.success("Login Successfully");
            }
        });
    },
  },

    
}
</script>
<style scoped>
.form-control.is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    /* background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e); */
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}
</style>