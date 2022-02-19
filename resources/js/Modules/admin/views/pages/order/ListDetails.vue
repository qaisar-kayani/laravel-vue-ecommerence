<template lang="">
    <div id="top" class="sa-app__body" v-if="order">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container container--max--xl">
                <BreadCrumb 
                    :pageHeader="{
                        pageHeading: 'Order#'+orderNumber,
                        currentRouteName: 'order-list',
                        nextRouteName: 'order-list',
                        nextRouteHeading: 'Back',
                    }"
                />
                 <div class="sa-page-meta mb-5">
                                <div class="sa-page-meta__body">
                                    <div class="sa-page-meta__list">
                                        <div class="sa-page-meta__item">{{vpDate(order.created_at,'MMMM Do YYYY, h:mm:ss a')}}</div>
                                        <div class="sa-page-meta__item">{{order.totalItems}}</div>
                                        <div class="sa-page-meta__item">Total {{currency(order.orderTotal)}}</div>
                                        <div class="sa-page-meta__item d-flex align-items-center fs-6">
                                            <span class="me-2" :class="orderstatusClass(order.status)"> {{toUpperCase(order.status)}}</span>
                                            <!-- <span class="badge badge-sa-warning me-2">Partially Fulfilled</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sa-entity-layout" data-sa-container-query='{"920":"sa-entity-layout--size--md"}'>
                                <div class="sa-entity-layout__body">
                                    <div class="sa-entity-layout__main">
                                        <div class="sa-card-area">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Update Order Status </label>
                                                    <select class="form-select" aria-label="Default select example" @change="updateOrderStatus($event.target.value)" v-model="activeStatus"  v-html="orderStatusDropdown()">
                                                       
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                          
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                                <h2 class="mb-0 fs-exact-18 me-4">Items</h2>
                                                <!-- <div class="text-muted fs-exact-14"><a href="#">Edit items</a></div> -->
                                            </div>
                                            <div class="table-responsive">
                                                <table class="sa-table">
                                                    <tbody>
                                                        <tr v-for="(item, index) in order.order_items" :key="index">
                                                            <td class="min-w-20x">
                                                                <div class="d-flex align-items-center">
                                                                    <img :src="showImage(item.thumbnail)" class="me-4" width="40" height="40" alt="" />
                                                                    <a  class="text-reset">{{item.name}}</a>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">{{currency(item.unitPrice)}}</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">{{item.quantity}}</td>
                                                            <td class="text-end">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">{{currency(item.price)}}</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                      
                                                    </tbody>
                                                    <tbody class="sa-table__group">
                                                        <tr>
                                                            <td colspan="3">Subtotal</td>
                                                            <td class="text-end">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">{{currency(order.orderSubTotal)}}</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                       
                                                      
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="3">Total</td>
                                                            <td class="text-end">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">{{currency(order.orderSubTotal)}}</span>
                                                                    
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- <div class="card mt-5">
                                            <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                                <h2 class="mb-0 fs-exact-18 me-4">Transactions</h2>
                                                <div class="text-muted fs-exact-14"><a href="#">Add transaction</a></div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="sa-table text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Payment
                                                                <div class="text-muted fs-exact-13">via PayPal</div>
                                                            </td>
                                                            <td>October 7, 2020</td>
                                                            <td class="text-end">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">$</span>
                                                                    <span class="sa-price__integer">2,000</span>
                                                                    <span class="sa-price__decimal">.00</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Payment
                                                                <div class="text-muted fs-exact-13">from account balance</div>
                                                            </td>
                                                            <td>November 2, 2020</td>
                                                            <td class="text-end">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">$</span>
                                                                    <span class="sa-price__integer">50</span>
                                                                    <span class="sa-price__decimal">.00</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Refund
                                                                <div class="text-muted fs-exact-13">to PayPal</div>
                                                            </td>
                                                            <td>December 10, 2020</td>
                                                            <td class="text-end text-danger">
                                                                <div class="sa-price">
                                                                    <span class="sa-price__symbol">$</span>
                                                                    <span class="sa-price__integer">-325</span>
                                                                    <span class="sa-price__decimal">.00</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> -->
                                        <!-- <div class="card mt-5">
                                            <div class="card-body px-5 py-4 d-flex align-items-center justify-content-between">
                                                <h2 class="mb-0 fs-exact-18 me-4">Balance</h2>
                                            </div>
                                            <table class="sa-table">
                                                <tbody class="sa-table__group">
                                                    <tr>
                                                        <td>Order Total</td>
                                                        <td class="text-end">
                                                            <div class="sa-price">
                                                                <span class="sa-price__symbol">$</span>
                                                                <span class="sa-price__integer">5,882</span>
                                                                <span class="sa-price__decimal">.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Return Total</td>
                                                        <td class="text-end">
                                                            <div class="sa-price">
                                                                <span class="sa-price__symbol">$</span>
                                                                <span class="sa-price__integer">0</span>
                                                                <span class="sa-price__decimal">.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tbody class="sa-table__group">
                                                    <tr>
                                                        <td>Paid by customer</td>
                                                        <td class="text-end">
                                                            <div class="sa-price">
                                                                <span class="sa-price__symbol">$</span>
                                                                <span class="sa-price__integer">-80</span>
                                                                <span class="sa-price__decimal">.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Refunded</td>
                                                        <td class="text-end">
                                                            <div class="sa-price">
                                                                <span class="sa-price__symbol">$</span>
                                                                <span class="sa-price__integer">0</span>
                                                                <span class="sa-price__decimal">.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Balance
                                                            <span class="text-muted">(customer owes you)</span>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="sa-price">
                                                                <span class="sa-price__symbol">$</span>
                                                                <span class="sa-price__integer">5,802</span>
                                                                <span class="sa-price__decimal">.00</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> -->
                                    </div>
                                    <div class="sa-entity-layout__sidebar">
                                        <div class="card">
                                            <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                                <h2 class="fs-exact-16 mb-0">Customer</h2>
                                                <!-- <a href="#" class="fs-exact-14">Edit</a> -->
                                            </div>
                                            <div class="card-body d-flex align-items-center pt-4">
                                                <div class="sa-symbol sa-symbol--shape--circle sa-symbol--size--lg">
                                                    <!-- <img src="images/customers/customer-1-40x40.jpg" width="40" height="40" alt="" /> -->
                                                </div>
                                                <div class="ms-3 ps-2">
                                                    <div class="fs-exact-14 fw-medium">{{order.customer.first_name}} {{order.customer.last_name}}</div>
                                                    <div class="fs-exact-13 text-muted">This is a first order</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                                <h2 class="fs-exact-16 mb-0">Contact person</h2>
                                                <!-- <a href="#" class="fs-exact-14">Edit</a> -->
                                            </div>
                                            <div class="card-body pt-4 fs-exact-14">
                                                <div>{{order.customer.first_name}} {{order.customer.last_name}}</div>
                                                <div class="mt-1"><a href="#">{{order.customer.email}}</a></div>
                                                <div class="text-muted mt-1">{{order.customer.phone}}</div>
                                            </div>
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                                <h2 class="fs-exact-16 mb-0">Shipping Address</h2>
                                                <!-- <a href="#" class="fs-exact-14">Edit</a> -->
                                            </div>
                                            <div class="card-body pt-4 fs-exact-14">
                                               {{order.customer.address.country}} 
                                                <br />
                                               {{order.customer.address.city}} 

                                                <br />
                                               {{order.customer.address.state}} 

                                                <br />
                                               {{order.customer.address.address1}} 

                                            </div>
                                        </div>
                                        <!-- <div class="card mt-5">
                                            <div class="card-body d-flex align-items-center justify-content-between pb-0 pt-4">
                                                <h2 class="fs-exact-16 mb-0">Billing Address</h2>
                                                <a href="#" class="fs-exact-14">Edit</a>
                                            </div>
                                            <div class="card-body pt-4 fs-exact-14">
                                                Jessica Moore
                                                <br />
                                                Random Federation
                                                <br />
                                                115302, Moscow
                                                <br />
                                                ul. Varshavskaya, 15-2-178
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

            </div>
        </div>
    </div>
</template>
<script>

export default {
    
    data() {
        return {
             order:'',
             orderNumber:0,
             activeStatus:''
             };
    },
    mounted() {
        this.getOrderDetails();
        
    },
    methods: {
        getOrderDetails() {
            this.$store.commit('setToast',true)
            let url='admin/order/list/'+this.$route.params.id;
            this.$store.dispatch("getData",{url}).then((res)=>{
               if(res.status==200)
               {   
                  
                   this.order=res.data
                   this.orderNumber=res.data.orderNumber
                   this.activeStatus=this.order.status
                   
               }
            })
        },
        updateOrderStatus(value)
        {
            if(confirm('Are your Sure'))
            {   
                this.$store.commit('setToast',true)
                let url='admin/order/update/'+this.$route.params.id;
                this.$store.dispatch('saveData',{url,status:value}).then((res)=>{
                    if (res.status==200) {
                        this.$toast.success('Status Updated')
                        this.getOrderDetails()
                    }
                })
            }
        }
        
    },
};
</script>
<style lang=""></style>
