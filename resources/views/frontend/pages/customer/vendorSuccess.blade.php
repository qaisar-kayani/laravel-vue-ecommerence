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

        {{ Breadcrumbs::render('home') }}

        <div class="row">

            <div class="col-sm-3"></div>

			<div id="content" class="col-sm-6">
				<h2 class="title" style="text-align: center;">Vendor Registration Confirmation</h2>
			</div>

            <div class="col-sm-3"></div>

		</div>

        <div class="col-sm-3"></div>

        <div class="col-sm-6">
            <div style="text-align: center;" class="alert alert-success"><i class="fa fa-check-circle"></i>
                Registration Successful - If you want to login please login to <a href="{{url('vendor/login')}}">Vendor Login</a>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection
