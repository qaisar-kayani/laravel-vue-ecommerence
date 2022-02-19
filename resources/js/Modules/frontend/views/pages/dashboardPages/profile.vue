<template lang="">
<div class="row">
            <customer-aside/>
			<div id="content" class="col-sm-9">
				<form @submit.prevent="register" class="form-horizontal account-register clearfix">
					<fieldset id="account">
						<legend>Your Personal Details</legend>
						<div class="form-group required" style="display: none;">
							<label class="col-sm-2 control-label">Customer Group</label>
							<div class="col-sm-10">
								<div class="radio">
									<label>
										<input type="radio" name="customer_group_id" value="1" checked="checked"> Default
									</label>
								</div>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-firstname">First Name</label>
							<div class="col-sm-10">
								<input type="text" name="firstname" v-model="form.first_name" placeholder="First Name"  :class="_vClass(_validator.form,'first_name')"  id="input-firstname" class="form-control">
                                            <div class="text-danger bold">{{_vErrorMessage(_validator.form,'first_name')}}</div>

							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
							<div class="col-sm-10">
								<input type="text" name="lastname" v-model="form.last_name" placeholder="Last Name" :class="_vClass(_validator.form,'last_name')" id="input-lastname" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'last_name')}}</div>
                                
                            </div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-email">E-Mail</label>
							<div class="col-sm-10">
								<input type="email" name="email" v-model="form.email" placeholder="E-Mail" id="input-email" :class="_vClass(_validator.form,'email')" class="form-control">
                                    <div class="text-danger bold">{{_vErrorMessage(_validator.form,'email')}}</div>

							</div>
						</div>
						
                        <div class="form-group required">
							<label class="col-sm-2 control-label" for="input-country">Country</label>
							
                            <div class="col-sm-10">
								<select name="country_id" v-model="form.country" id="input-country" class="form-control" :class="_vClass(_validator.form,'country')">
									<option value=""> --- Please Select --- </option>
									<option :value="item.name" v v-for="(item, index) in countryList" :key="index">{{item.name}}</option>
								
								</select>
							</div>
						</div>
                        <div class="form-group required">
							<label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
							<div class="col-sm-10">
								<input type="tel" name="telephone" v-model="form.mobile" placeholder="Telephone" id="input-telephone" :class="_vClass(_validator.form,'mobile')" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'mobile')}}</div>

							</div>
						</div>
						
					</fieldset>
					<!-- <fieldset>
						<legend>Your Password</legend>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-password">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" v-model="form.password" placeholder="Password" :class="_vClass(_validator.form,'password')" id="input-password" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'password')}}</div>

							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
							<div class="col-sm-10">
								<input type="password" name="confirm" v-model="form.password_confirmation" placeholder="Password Confirm"  id="input-confirm" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'password_confirmation')}}</div>

							</div>
						</div>
					</fieldset> -->
					<div class="buttons">
						<div class="pull-right">
                            <!-- I have read and agree to the <a href="#" class="agree"><b>Pricing Tables</b></a>
							<input class="box-checkbox" type="checkbox" name="agree" value="1"> &nbsp; -->
							<input type="submit" value="Update" class="btn btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required,helpers,email,minLength, sameAs} from "@vuelidate/validators";

export default {

   setup() {
        return {
            _validator: useVuelidate(),
        };
    },
    validations() {
        return {
            form: {
                first_name: { required:helpers.withMessage('First Name required', required) },
                last_name: { required:helpers.withMessage('Last Name required', required) },
                country: { required:helpers.withMessage('Country required', required) },
                email: { required:helpers.withMessage('Email required', required),email },
                mobile: { required:helpers.withMessage('Contact number required', required) },
                password: { required:helpers.withMessage('Password  required', required), minLength: minLength(6) },
                password_confirmation:{  sameAs:sameAs(this.form.password),required:helpers.withMessage('Must be same as password ', required) }
            },
        };
    }, 
  mounted() {

            // if(this.isLogin()){this.redirect('customer/dashboard')}
            this.getCountryLIst()
            
  },

  data() {
    return {
      form: {
          first_name:null,
          last_name:null,
          country_code:'AE',
          country:"United Arab Emirates",
          email: null,
          mobile:null,
          password: null,
          password_confirmation: null,
        
      },
      countryList:[]
    };
  },
  methods: {
    register() {
        this._validator.$validate();
        if(this._validator.$error)return false
        let city=this.countryList.find((item)=>item.name==this.form.country)
        this.form.country_code=city.code
        this.form.url='customer/signup'
        this.$store.dispatch("saveData", this.form).then((res) => {
            if (res.status == 200) {
            this.$toast.success("Register Successfully");
            history.back()

            }
        });
    },
    
    getCountryLIst() //get country list
    {
        this.$store.dispatch('getData',{url:'country/list',requesttype:'GET'}).then((res)=>{
            if(res.status==200)
            {
                this.countryList=res.data
            }
        })
    }

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