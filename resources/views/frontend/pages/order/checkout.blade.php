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
        <checkout-cart ></checkout-cart>
        <!--Middle Part End-->
    </div>
@endsection
