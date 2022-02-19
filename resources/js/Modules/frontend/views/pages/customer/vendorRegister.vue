<template lang="">
<div class="row">
			<div id="content" class="col-sm-12">
				<h2 class="title">Vendor Registration</h2>
				<p>If you already have an account with us, please login at the <a href="#">login page</a>.</p>
				<form @submit.prevent="register" class="form-horizontal account-register clearfix">
					<fieldset id="account">
						<legend>Vendor Personal Details</legend>
						<div class="form-group required" style="display: none;">
							<label class="col-sm-1 control-label">Customer Group</label>
							<div class="col-sm-3">
								<div class="radio">
									<label>
										<input type="radio" name="customer_group_id" value="1" checked="checked"> Default
									</label>
								</div>
							</div>
						</div>
                        <div class="form-group required">
							<label class="col-sm-1 control-label" for="input-firstname">First Name</label>
							<div class="col-sm-3">
								<input type="text" name="firstname" v-model="form.first_name" placeholder="First Name"  :class="_vClass(_validator.form,'first_name')"  id="input-firstname" class="form-control">
                                            <div class="text-danger bold">{{_vErrorMessage(_validator.form,'first_name')}}</div>

						    </div>
						
							<label class="col-sm-1 control-label" for="input-lastname">Last Name</label>
							<div class="col-sm-3">
								<input type="text" name="lastname" v-model="form.last_name" placeholder="Last Name" :class="_vClass(_validator.form,'last_name')" id="input-lastname" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'last_name')}}</div>
                                
						    </div>
                            <label class="col-sm-1 control-label" for="input-username">Username</label>
							<div class="col-sm-3">
								<input type="text" name="username"  placeholder="Username" v-model="form.user_name" id="input-username" class="form-control" :class="_vClass(_validator.form,'user_name')">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'last_name')}}</div>
							
                            </div>
							
                       </div>
						
                        <div class="form-group required">
							<label class="col-sm-1 control-label" for="input-email">E-Mail</label>

                            <div class="col-sm-3">
								<input type="email" name="email" v-model="form.email" placeholder="E-Mail" id="input-email" :class="_vClass(_validator.form,'email')" class="form-control">
                                    <div class="text-danger bold">{{_vErrorMessage(_validator.form,'email')}}</div>

							
					    	</div>
							<label class="col-sm-1 control-label" for="input-country">Country</label>
							
                            <div class="col-sm-3">
								<select name="country_id" v-model="form.country" id="input-country" class="form-control" :class="_vClass(_validator.form,'country')">
									<option value=""> --- Please Select --- </option>
									<option :value="item.name" v v-for="(item, index) in countryList" :key="index">{{item.name}}</option>
								
								</select>
							</div>
						
							<label class="col-sm-1 control-label" for="input-telephone">Telephone</label>
							<div class="col-sm-3">
								<input type="tel" name="telephone" v-model="form.mobile" placeholder="Telephone" id="input-telephone" :class="_vClass(_validator.form,'mobile')" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'mobile')}}</div>

							</div>
                            <label class="col-sm-1 control-label" for="input-mobile">Mobile</label>
							<div class="col-sm-3">
								<input type="tel" name="mobile"  v-model="form.phone" placeholder="Mobile" id="input-mobile"  :class="_vClass(_validator.form,'phone')" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'phone')}}</div>
							</div>
							<label class="col-sm-1 control-label" for="input-password">Password</label>
							<div class="col-sm-3">
								<input type="password" name="password" v-model="form.password" placeholder="Password" :class="_vClass(_validator.form,'password')" id="input-password" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'password')}}</div>

							</div>
							<label class="col-sm-1 control-label" for="input-confirm">Password Confirm</label>
							<div class="col-sm-3">
								<input type="password" name="confirm" v-model="form.password_confirmation" placeholder="Password Confirm"  id="input-confirm" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'password_confirmation')}}</div>

							</div>

                            <label class="col-sm-1 control-label" for="input-mobile">Profile Photo</label>
							<div class="col-sm-3">
                                <input type="file" @change="handleFileUpload( $event )"  style="padding-left: 1%;" class="form-control-file" id="profilephoto" :class="_vClass(_validator.form,'profile_photo')">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'profile_photo')}}</div>

							</div>
                             
						</div>
					</fieldset>
					<fieldset id="businessdetails">
                        <legend>Vendor Business Details</legend>
						<div class="form-group required">
							<label class="col-sm-1 control-label" for="input-shopname">Shop Name</label>
							<div class="col-sm-3">
								<input type="text" name="shopname"  placeholder="Shop Name" id="input-shopname"  :class="_vClass(_validator.form,'shop_name')" v-model="form.shop_name" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'shop_name')}}</div>
                                
                            </div>

							<label class="col-sm-1 control-label" for="input-businessemail">Business Email</label>
							<div class="col-sm-3">
								<input type="text" name="businessemail" placeholder="Business Email" v-model="form.business_email"  :class="_vClass(_validator.form,'business_email')" id="input-businessemail" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'business_email')}}</div>

                            </div>

                            <label class="col-sm-1 control-label" for="input-shopaddress">Shop Address</label>
							<div class="col-sm-3">
								<input type="text" name="shopaddress" placeholder="Shop Address" v-model="form.shop_address" :class="_vClass(_validator.form,'shop_address')" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'shop_address')}}</div>
							
                            </div>
						</div>

						<div class="form-group required">
							<label class="col-sm-1 control-label" for="input-businesstelephone">Telephone</label>
							<div class="col-sm-3">
								<input type="text" name="businesstelephone"  placeholder="Business Telephone" v-model="form.office_phone"  :class="_vClass(_validator.form,'office_phone')" id="input-businesstelephone" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'office_phone')}}</div>
							
                            </div>
						</div>
					</fieldset>
                    					<fieldset id="businessdetails">
                        <legend> Business Documents</legend>
						<div class="form-group required">
                            <label class="col-sm-1 control-label" for="input-shopaddress">license Number</label>
							<div class="col-sm-3">
								<input type="text" name="shopaddress" placeholder="license number" v-model="form.license_number" :class="_vClass(_validator.form,'license_number')" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'license_number')}}</div>
							
                            </div>
                            <label class="col-sm-1 control-label" for="input-shopaddress">license Expiry</label>
							<div class="col-sm-3">
								<input type="date" name="shopaddress" placeholder="license number" v-model="form.license_expiry" :class="_vClass(_validator.form,'license_expiry')" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'license_expiry')}}</div>
							
                            </div>
							<label class="col-sm-1 control-label" for="input-mobile">Trade license</label>
							<div class="col-sm-3">
                                <input type="file" @change="handleFileUpload_trade_license( $event )"  style="padding-left: 1%;" class="form-control-file" id="profilephoto" :class="_vClass(_validator.form,'trade_license')">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'trade_license')}}</div>

							</div>
                            </div>
                            <div class="form-group">
                             <label class="col-sm-1 control-label" for="input-shopaddress">Vat Number </label>
							<div class="col-sm-3">
								<input type="text" name="shopaddress" placeholder="Vat number" v-model="form.vat_number" :class="_vClass(_validator.form,'vat_number')" class="form-control">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'vat_number')}}</div>
							
                            </div>
                            <label class="col-sm-1 control-label" for="input-mobile">Vat certificate </label>
							<div class="col-sm-3">
                                <input type="file" @change="handleFileUpload_vat_certificate( $event )"  style="padding-left: 1%;" class="form-control-file" id="profilephoto" :class="_vClass(_validator.form,'vat_certificate')">
                                <div class="text-danger bold">{{_vErrorMessage(_validator.form,'vat_certificate')}}</div>

							</div>
                            
						</div>
					</fieldset>
					<div class="buttons">
						<div class="pull-right">
                            <!-- I have read and agree to the <a href="#" class="agree"><b>Pricing Tables</b></a>
							<input class="box-checkbox" type="checkbox" name="agree" value="1"> &nbsp; -->
							<input type="submit" value="Continue" class="btn btn-primary">
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
                user_name: { required:helpers.withMessage('User Name required', required) },
                country: { required:helpers.withMessage('Country required', required) },
                email: { required:helpers.withMessage('Email required', required),email },
                mobile: { required:helpers.withMessage('Contact number required', required) },
                phone: { required:helpers.withMessage('Mobile number required', required) },
                password: { required:helpers.withMessage('Password  required', required), minLength: minLength(6) },
                password_confirmation:{  sameAs:sameAs(this.form.password),required:helpers.withMessage('Must be same as password ', required) },
                shop_name: { required:helpers.withMessage('Business Name required', required) },
                business_email: { required:helpers.withMessage('Business Email required', required) },
                shop_name: { required:helpers.withMessage('Business Name required', required) },
                shop_address: { required:helpers.withMessage('Address Name required', required) },
                office_phone: { required:helpers.withMessage(' Office number required', required) },
                license_number: { required:helpers.withMessage(' license number required', required) },
                license_expiry: { required:helpers.withMessage('  license expiry required', required) },
                trade_license: { required:helpers.withMessage(' trade license required', required) },
                vat_number: { required:helpers.withMessage(' vat number required', required) },
                vat_certificate: { required:helpers.withMessage(' vat certificate required', required) },


                
            },
        };
    }, 
  mounted() {

            this.getCountryLIst()
            
  },

  data() {
    return {
      form: {
          first_name:null,
          last_name:null,
          user_name:null,
          country_code:'AE',
          country:"United Arab Emirates",
          email: null,
          mobile:null,
          phone:null,
          password: null,
          password_confirmation: null,

          
        profile_photo: null,
        //shop
        id:null,
        shop_name:null,
        shop_unique_name:null,
        business_email:null,
        shop_address:null,
        office_phone:null,
        license_number:null,
        license_expiry:null,
        trade_license:null,
        vat_number:null,
        vat_certificate:null
        
        
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
        this.form.requesttype='FilePOST'
        this.form.url='vendor/signup'
        this.$store.dispatch("saveData", this.form).then((res) => {
            if (res.status == 200) {
            this.$toast.success("Register Successfully");
            this.redirect('vendor/success')

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
    },
    handleFileUpload(event){
    this.form.profile_photo =  event.target.files[0];
  },
    handleFileUpload_trade_license(event){
    this.form.trade_license =  event.target.files[0];
  },
  handleFileUpload_vat_certificate(event)
  {
    this.form.vat_certificate =  event.target.files[0];

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