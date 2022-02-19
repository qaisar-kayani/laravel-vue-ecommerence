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

@push('extracss')
<link id="color_scheme" href="{{ asset('public/frontend/css/home2.css') }}" rel="stylesheet">
@endpush
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="/index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="/terms-conditions.html">Terms & Conditions</a></li>
    </ul>
    

    <div class="col-sm-12" style="padding-bottom: 5%;">

        <h2 class="text-uppercase">Introduction</h2>
        <ul>
            <li>Terms of Sale set out the terms and conditions on which products are supplied to you as
                    a buyer on www.pricedriller.com or on our mobile application (together defined as the “Site”).
                    The owner and operator of the Site is Price Driller E Commerce Owned By Price Driller LLC, a limited liability company registered in the United Arab Emirates (“UAE”)
                    under license number 123456, with its office located at Silicon Oasis, It Plaza, Dubai in the UAE (“we”, “our” or “us”).
            </li>
        </ul>

        <h2 class="text-uppercase">ORDER ACCEPTANCE</h2>
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a lorem quam. Curabitur luctus turpis ipsum. Integer pellentesque felis tempus, venenatis risus eu, commodo felis. Etiam congue bibendum mi, at semper tellus cursus quis. Donec commodo tortor mi, nec ultricies nulla bibendum nec. Vestibulum ut nisi sapien. Pellentesque enim purus, efficitur vitae urna quis, sagittis pellentesque arcu. Vivamus posuere sapien aliquam, euismod lacus at, molestie orci. Maecenas ac eleifend magna. Nulla in dui metus. Aenean ut iaculis lorem.
            </li>
        </ul>

        <h2 class="text-uppercase">DELIVERY OF YOUR ORDER</h2>
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a lorem quam. Curabitur luctus turpis ipsum. Integer pellentesque felis tempus, venenatis risus eu, commodo felis. Etiam congue bibendum mi, at semper tellus cursus quis. Donec commodo tortor mi, nec ultricies nulla bibendum nec. Vestibulum ut nisi sapien. Pellentesque enim purus, efficitur vitae urna quis, sagittis pellentesque arcu. Vivamus posuere sapien aliquam, euismod lacus at, molestie orci. Maecenas ac eleifend magna. Nulla in dui metus. Aenean ut iaculis lorem.
            </li>
        </ul>

        <h2 class="text-uppercase">DEFECT OR DAMAGE TO YOUR PRODUCT</h2>
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a lorem quam. Curabitur luctus turpis ipsum. Integer pellentesque felis tempus, venenatis risus eu, commodo felis. Etiam congue bibendum mi, at semper tellus cursus quis. Donec commodo tortor mi, nec ultricies nulla bibendum nec. Vestibulum ut nisi sapien. Pellentesque enim purus, efficitur vitae urna quis, sagittis pellentesque arcu. Vivamus posuere sapien aliquam, euismod lacus at, molestie orci. Maecenas ac eleifend magna. Nulla in dui metus. Aenean ut iaculis lorem.
            </li>
        </ul>

        <h2 class="text-uppercase">WARRANTIES, REPRESENTATIONS & UNDERTAKINGS</h2>
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a lorem quam. Curabitur luctus turpis ipsum. Integer pellentesque felis tempus, venenatis risus eu, commodo felis. Etiam congue bibendum mi, at semper tellus cursus quis. Donec commodo tortor mi, nec ultricies nulla bibendum nec. Vestibulum ut nisi sapien. Pellentesque enim purus, efficitur vitae urna quis, sagittis pellentesque arcu. Vivamus posuere sapien aliquam, euismod lacus at, molestie orci. Maecenas ac eleifend magna. Nulla in dui metus. Aenean ut iaculis lorem.
            </li>
        </ul>

        <h2 class="text-uppercase">LIABILITY</h2>
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a lorem quam. Curabitur luctus turpis ipsum. Integer pellentesque felis tempus, venenatis risus eu, commodo felis. Etiam congue bibendum mi, at semper tellus cursus quis. Donec commodo tortor mi, nec ultricies nulla bibendum nec. Vestibulum ut nisi sapien. Pellentesque enim purus, efficitur vitae urna quis, sagittis pellentesque arcu. Vivamus posuere sapien aliquam, euismod lacus at, molestie orci. Maecenas ac eleifend magna. Nulla in dui metus. Aenean ut iaculis lorem.
            </li>
        </ul>

        <h2 class="text-uppercase">GENERAL</h2>
        <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a lorem quam. Curabitur luctus turpis ipsum. Integer pellentesque felis tempus, venenatis risus eu, commodo felis. Etiam congue bibendum mi, at semper tellus cursus quis. Donec commodo tortor mi, nec ultricies nulla bibendum nec. Vestibulum ut nisi sapien. Pellentesque enim purus, efficitur vitae urna quis, sagittis pellentesque arcu. Vivamus posuere sapien aliquam, euismod lacus at, molestie orci. Maecenas ac eleifend magna. Nulla in dui metus. Aenean ut iaculis lorem.
            </li>
        </ul>

    </div>





</div>
<!-- //Main Container -->
@push('vuejs')
@include('frontend.plugins.vuejs')
@endpush
@endsection
