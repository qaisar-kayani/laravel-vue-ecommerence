<template lang="">
    <div>
        <form @submit.prevent='reviewForm'>
									<div id="review">
                                        <!-- {{reviewList}} -->
										<table class="table table-striped table-bordered" v-for="(item, index) in reviewList" :key="index">
											<tbody  >
												<tr>
													<td style="width: 50%;"><strong>{{toUpperCase(item.name,'full')}}</strong></td>
													<td class="text-right">{{vpDate(item.created_at,'MMMM Do YYYY, h:mm:ss a')}}</td>
												</tr>
												<tr>
													<td colspan="2">
														<p>{{item.review}}</p>
														<div class="ratings">
															<div class="rating-box">
										<span class="fa fa-stack" v-for="index in 5" :key="index"><i :class='ratingClass(index,item.rate)' class="fa  fa-stack-1x"></i></span>
																
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
										<div class="text-right"></div>
									</div>
									<h2 id="review-title">Write a review</h2>
									<div class="contacts-form">
										<div class="form-group"> <span class="icon icon-user"></span>
											<input type="text" name="name" class="form-control" v-model="form.name"   :class="_vClass(vue_validator.form,'name')"> 
										</div>
										<div class="form-group"> <span class="icon icon-bubbles-2"></span>
											<textarea class="form-control" name="text" v-model="form.review"   :class="_vClass(vue_validator.form,'review')">Your Review</textarea>
										</div> 
										<!-- <span style="font-size: 11px;"><span class="text-danger">Note:</span>HTML is not translated!</span> -->
									
										<div class="form-group">
										 <b>Rating</b> <span>Bad</span>&nbsp;
										<input type="radio" v-model="form.rate" name="rating" value="1"> &nbsp;
										<input type="radio" v-model="form.rate" name="rating"
										value="2"> &nbsp;
										<input type="radio" v-model="form.rate" name="rating"
										value="3"> &nbsp;
										<input type="radio" v-model="form.rate" name="rating"
										value="4"> &nbsp;
										<input type="radio" v-model="form.rate" name="rating"
										value="5"> &nbsp;<span>Good</span>
										
										</div>
										<div class="buttons clearfix">
                                        <input type="submit"  id="button-review" class="btn buttonGray" value="Continue"></div>
									</div>
								</form>
    </div>
</template>
<script>
import useVuelidate from "@vuelidate/core";
import { required,helpers } from "@vuelidate/validators";
export default {

      // mixins:[helper],
      props:['product_id'],
    setup() {
            return {
                vue_validator: useVuelidate(),
            };
        },
        validations() {
            return {
                form: {
                    name: { required:helpers.withMessage('Name required', required) },
                    review: { required:helpers.withMessage('Review Details required', required) },
                },
                
            };
        },
        data() {
            return {
                form:{
                    name:'',
                    review:'',
                    rate:1,
                    product_id:'',
                    url:'frontend/product/reviews/add'
                },
                reviewList:''
            }
        },
        mounted() {
            this.getReviewList()
        },
        methods: {
            getReviewList()
            {   
               
                let url='/frontend/product/reviews/list/?perPage=10&product_id='+this.product_id
                this.$store.dispatch('getData',{url,test:'da'}).then((res)=>{
                    this.reviewList=res.data.data
                })
            },
            reviewForm() {
                    this.form.product_id=this.product_id
                    this.vue_validator.$validate();
                    if(this.vue_validator.$error)return false
                
                    this.$store.dispatch("saveData", this.form).then((res) => {
                        if (res.status == 200) {
                            this.notification('Success','Thank you for your feedback','','success')
                            this.getReviewList()
                           
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