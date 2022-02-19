<template lang="">
    
<!-- The modal -->
<div class="modal fade" id="biddingModel" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="panel panel-default">
<div class="panel-heading">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="panel-title"><i class="fa fa-ticket"></i> Start Your Bidding</h4>
</div>
<div class="panel-body">
        <form class="form-horizontal"  @submit.prevent="sendBid">
            <div class="form-group required" >
            <label class="col-sm-12"><span title="" data-toggle="tooltip" data-original-title="This is system generated price.">System Generated Price</span></label>
                <div v-show="bidsend" style="text-align: center;" class="alert alert-success"><i class="fa fa-check-circle"></i>
                Bid Place  Successful  please Wait for vendor response ... 
            </div>
            </div>
            <div class="form" v-if="bidsend==false">
            <div class="form-group required" >

<!--                     
                    <div class="col-sm-2"></div>

                    <div class="col-sm-8">
                        <div class="radio">
                            <label>
                                <input type="radio" value="8" name="voucher_theme_id"> 1800 AED
                            </label>
                            <label>
                                <input type="radio" value="8" name="voucher_theme_id"> 1900 AED
                            </label>
                            <label>
                                <input type="radio" value="8" name="voucher_theme_id"> 2000 AED
                            </label>
                        </div>
                    </div>   

                    <div class="col-sm-2" ></div> -->
                        
                </div>
            
            <div class="form-group" >
                <label for="input-amount" class="col-sm-2 control-label"><span title="" data-toggle="tooltip" data-original-title="Submit your custom price which you want to bid.">Amount</span>
                </label>
                <div class="col-sm-10">
                <input type="text" size="5" class="form-control" id="input-amount" v-model="form.bidPrice" :class="_vClass(vue_validator.form,'bidPrice')" name="amount">
                <div class="text-danger bold">{{_vErrorMessage(vue_validator.form,'bidPrice')}}</div>

                </div>
            </div>    

            <div class="form-group">
                <label for="input-message" class="col-sm-2 control-label"><span title="" data-toggle="tooltip" data-original-title="Optional">Message</span>
                </label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="input-message" rows="4" cols="40" v-model="form.message" :class="_vClass(vue_validator.form,'message')"  name="message"></textarea>
                    <div class="text-danger bold">{{_vErrorMessage(vue_validator.form,'message')}}</div>

                </div>
            </div>
            <div class="buttons clearfix">
                <div class="pull-right">I understand & accept the terms and conditions.
                    <input type="checkbox" value="1" name="agree"> &nbsp;
                    <input type="submit" class="btn btn-primary" value="Start Bidding">
                </div>
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

    props:['product'],
   setup() {
        return {
            vue_validator: useVuelidate(),
        };
    },
    validations() {
        return {
            form: {
                bidPrice: { required:helpers.withMessage('Bidding price  required', required) },
                message: { required:helpers.withMessage('Bidding message required', required) },
            },
        };
    }, 
    mounted() {
        this.productDetail=this.product
        this.form.bidPrice=(this.product.sale_price>0)?this.product.sale_price:this.product.regular_price
        this.form.group_id=this.product.group_id??0
        this.form.product_id=this.product._id
        this.form.name=this.product.name
        this.form.vendor_id= this.product.vendor_id,
        this.form.productPrice=(this.product.sale_price>0)?this.product.sale_price:this.product.regular_price
        this.form.image=this.product.feature_image,
        this.form.thumbnail=this.product.thumbnail

    },
    data() {
        return {
            productDetail:'',
            form:{
                message:'',
                bidPrice:'',
                product_id:'',
                group_id:'',
                user_id:this.$store.getters.getAuth.id,
                vendor_id:null,
                name:'',
                productPrice:'',
                image:'',
                thumbnail:'',
            },
            bidsend:false
        }
    },
    methods: {
        sendBid()
        {   
            this.vue_validator.$validate();
            if(this.vue_validator.$error)return false
            
            this.$store.dispatch('saveData',{...this.form,url:'customer/bidding/create'}).then((res)=>{
                this.bidsend=true
                // setInterval(() => {
                //     this.bidsend=false
                //     this.form.message=''
                //     this.form.bidPrice=''
                // }, 2000);
                
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