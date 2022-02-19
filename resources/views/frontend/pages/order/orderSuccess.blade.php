@extends('frontend.layouts.landing-page')
@section('content')
    @push('header-top')
        @include('frontend.layouts.headers.header-top')
    @endpush
    @push('header-center')
        @include('frontend.layouts.headers.header-center')
    @endpush
    @push('header-bottom')
        @include('frontend.layouts.headers.header-bottom')
    @endpush
    @push('vuejs')
        @include('frontend.plugins.vuejs')
    @endpush
    <div class="main-container container">

        {{ Breadcrumbs::render('cart') }}
    
        <!--Middle Part End-->
        <div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-sm-12">
                    <h2 class="title">Order Confirmation</h2>
                <div
                class="alert alert-success">
                    <i class="fa fa-check-circle"></i>
                    Thank you! - Your order has been placed successfully.
                </div>
               
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td colspan="2" class="text-left">Order Details</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="width: 50%;" class="text-left"> <b>Order ID:</b> #{{$order->orderNumber}}
								<br>
								<b>Date Added:</b> {{$order->created_at}}</td>
							<td style="width: 50%;" class="text-left"> <b>Payment Method:</b> Cash On Delivery
								<br>
								<b>Shipping Method:</b> Flat Shipping Rate </td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td style="width: 50%; vertical-align: top;" class="text-left">Payment Address</td>
							<td style="width: 50%; vertical-align: top;" class="text-left">Shipping Address</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left">Jhone Cary
								<br>Central Square
								<br>22 Hoi Wing Road
								<br>New Delhi
								<br>India</td>
							<td class="text-left">Jhone Cary
								<br>Central Square
								<br>22 Hoi Wing Road
								<br>New Delhi
								<br>India</td>
						</tr>
					</tbody>
				</table>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
                            
                            <tr>
                                <td class="text-left">Product Name</td>
								<td class="text-left">Attribute</td>
								<td class="text-right">Quantity</td>
								<td class="text-right">Price</td>
								<td class="text-right">Total</td>
							</tr>
						</thead>
						<tbody>
                            @foreach ($order->orderItems as $item)
                            <tr>
                                <td class="text-left">{{$item->name}} </td>
								<td class="text-left">{{$item->name}}</td>
								<td class="text-right">{{$item->quantity}}</td>
								<td class="text-right">{{$item->unitPrice}}</td>
								<td class="text-right">{{$item->price}}</td>
                                
							</tr>
                            
                            @endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Sub-Total</b>
								</td>
								<td class="text-right">AED {{$order->orderSubTotal}}</td>

							</tr>
							{{-- <tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Flat Shipping Rate</b>
								</td>
								<td class="text-right">$5.00</td>

							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Eco Tax (-2.00)</b>
								</td>
								<td class="text-right">$6.00</td>

							</tr> --}}
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>VAT </b>
								</td>
								<td class="text-right">AED {{$order->orderTotalTax}}</td>

							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Total</b>
								</td>
								<td class="text-right">AED {{$order->orderTotal}}</td>

							</tr>
						</tfoot>
					</table>
				</div>


			</div>
			<!--Middle Part End-->
			<!--Right Part Start -->


			<!--Right Part End -->
		</div>
    </div>
@endsection
