<template lang="">
    
<!-- The modal -->
<div class="modal fade mymodel"  id="loginModel" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="panel panel-default">
<div class="panel-heading">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="panel-title"><i class="fa fa-ticket"></i> Login</h4>
</div>
<div class="panel-body">
            <div class="form-group required">
                    <!-- <label class="col-sm-12"><span title="" data-toggle="tooltip" data-original-title="This is system generated price.">RETURNING CUSTOMER</span></label> -->

                        
                </div>
            
                            <form @submit.prevent="login">
								<div class="col-sm-12 customer-login">
									<div class="well">
										<h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Returning Customer</h2>
										<p><strong>I am a returning customer</strong></p>
										<div class="form-group">
											<label class="control-label " >E-Mail Address</label>
											<input type="text" id="email" name="email"  v-model="form.email" class="form-control"   :class="_vClass(vue_validator.form,'email')" />
                                            <div class="text-danger bold">{{_vErrorMessage(vue_validator.form,'email')}}</div>
										</div>
										<div class="form-group">
											<label class="control-label " for="input-password">Password</label>
											<input type="password" name="password"  v-model="form.password" id="input-password"  :class="_vClass(vue_validator.form,'password')" class="form-control" />
                                            <div class="text-danger bold">{{_vErrorMessage(vue_validator.form,'password')}}</div>
										</div>
									</div>
									<div class="bottom-form">
										<a @click="redirect('register')" class="forgot">Create a Account</a>
										<input type="submit" value="Login" class="btn btn-default pull-right" />
									</div>
								</div>
							</form>
       
</div>
</div>

</div>
</div>
</div>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required,helpers,email } from "@vuelidate/validators";
export default {

      // mixins:[helper],
   setup() {
        return {
            vue_validator: useVuelidate(),
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
        // alert()
        this.vue_validator.$validate();
        if(this.vue_validator.$error)return false
        this.$store.dispatch("fetchAuthLogin", this.form).then((res) => {
            
            if (res.status == 200) {
                // $("#loginModel").modal('hide')
                $("#loginModel").trigger("click");
                $("#biddingModel").trigger("click");
               
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