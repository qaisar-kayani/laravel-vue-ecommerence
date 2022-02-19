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
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{route('faq')}}">Faq</a></li>
    </ul>
    
    
    <div class="row">			
        <div id="content" class="col-sm-12 item-article">
            <div class="row box-1-about">
                <div class="col-md-9 welcome-about-us">
                    <div class="title-about-us">
                        <h2>Welcome To Price Driller</h2>
                    </div>
                    <div class="content-about-us">
                        <div class="image-about-us">
                            <img src="{{asset('public/frontend/image/catalog/about/about-us.jpg')}}" alt="Image Client">
                        </div>
                        <div class="des-about-us">Nulla auctor mauris ut dui luctus semper. In hac habitasse platea dictumst. Duis pellentesque ligula a risus suscipit dignissim. Nunc non nisl lacus. Integer pharetra lacinia dapibus. Donec eu dolor dui, vel posuere mauris.
                            <br>
                            <br>Pellentesque semper congue sodales. In consequat, metus eget con sequat ornare, augue dolor blandit purus, vitae lacinia nisi tellus in erat. Nulla ac justo eget massa aliquet sodales. Maecenas mattis male suada sem, in fringilla massa dapibus quis. Suspendisse aliquam leo id neque auctor molestie. Etiam at nulla tellus.
                            <br>
                            <br>Nulla auctor mauris ut dui luctus semper. In hac habitasse platea dictumst. Duis pellentesque ligula a risus suscipit dignissim.</div>
                    </div>
                </div>
                <div class="col-md-3 why-choose-us">
                    <div class="title-about-us">
                        <h2>Why Choose Us</h2>
                    </div>
                    <div class="content-why">
                        <ul class="why-list">
                            <li><a title="Shipping &amp; Returns" href="#">Shipping &amp; Returns</a>
                            </li>
                            <li><a title="Secure Shopping" href="#">Secure Shopping</a>
                            </li>
                            <li><a title="International Shipping" href="#">International Shipping</a>
                            </li>
                            <li><a title="Affiliates" href="#">Affiliates</a>
                            </li>
                            <li><a title="Group Sales" href="#">Group Sales</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 our-member">
                    <div class="title-about-us">
                        <h2>Our Member</h2>
                    </div>
                    <div class="short-des">Consectetur adipiscing elit. Donec pellentesque venenatis elit, quis aliquet mauris malesuada vel. Donec vitae libero dolor, eget dapibus justo.
                        <br>Aenean facilisis aliquet feugiat. Suspendisse lacinia congue est ac semper. Nulla ut elit magna, vitae volutpat magna.</div>
                    <div class="overflow-owl-slider1">
                        <div class="wrapper-owl-slider1">
                            <div class="row slider-ourmember">
                                <div class="item-about col-lg-6 col-md-6 col-sm-6">
                                    <div class="item respl-item">
                                        <div class="item-inner">
                                            <div class="w-image-box">
                                                <div class="item-image">
                                                    <a title="Jennifer lawrence" href="#">
                                                        <img src="{{asset('public/frontend/image/catalog/about/cl-image-1.jpg')}}" alt="Image Client">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="info-member">
                                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a></h2>
                                                <p class="cl-job">Art Director</p>
                                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed facilisis arcu placerat consequat</p>
                                                <ul>
                                                    <li>
                                                        <a class="fa fa-f" title="Facebook" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-t" title="Twitter" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-g" title="google" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-s" title="skyper" href="#"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-about col-lg-6 col-md-6 col-sm-6">
                                    <div class="item respl-item">
                                        <div class="item-inner">
                                            <div class="w-image-box">
                                                <div class="item-image">
                                                    <a title="Jennifer lawrence" href="#">
                                                        <img src="{{asset('public/frontend/image/catalog/about/cl-image-2.jpg')}}" alt="Image Client">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="info-member">
                                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a></h2>
                                                <p class="cl-job">Design Leader</p>
                                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed facilisis arcu placerat consequat</p>
                                                <ul>
                                                    <li>
                                                        <a class="fa fa-f" title="Facebook" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-t" title="Twitter" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-g" title="google" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-s" title="skyper" href="#"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-about col-lg-6 col-md-6 col-sm-6">
                                    <div class="item respl-item">
                                        <div class="item-inner">
                                            <div class="w-image-box">
                                                <div class="item-image">
                                                    <a title="Jennifer lawrence" href="#">
                                                        <img src="{{asset('public/frontend/image/catalog/about/cl-image-3.jpg')}}" alt="Image Client">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="info-member">
                                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a></h2>
                                                <p class="cl-job">Tech Leader</p>
                                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed facilisis arcu placerat consequat</p>
                                                <ul>
                                                    <li>
                                                        <a class="fa fa-f" title="Facebook" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-t" title="Twitter" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-g" title="google" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-s" title="skyper" href="#"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-about col-lg-6 col-md-6 col-sm-6">
                                    <div class="item respl-item">
                                        <div class="item-inner">
                                            <div class="w-image-box">
                                                <div class="item-image">
                                                    <a title="Jennifer lawrence" href="#">
                                                        <img src="{{asset('public/frontend/image/catalog/about/cl-image-4.jpg')}}" alt="Image Client">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="info-member">
                                                <h2 class="cl-name"><a title="Jennifer lawrence" href="#">Jennifer lawrence</a></h2>
                                                <p class="cl-job">Manager</p>
                                                <p class="cl-des">Donec dignissim, enim ac semper tempus, ligula neque pulvinar mi, sed facilisis arcu placerat consequat</p>
                                                <ul>
                                                    <li>
                                                        <a class="fa fa-f" title="Facebook" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-t" title="Twitter" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-g" title="google" href="#"></a>
                                                    </li>
                                                    <li>
                                                        <a class="fa fa-s" title="skyper" href="#"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 happy-about-us">
                    <div id="slider-happy-about-us" class="happy-ab">
                        <div class="title-happy-about">
                            <h2>Happy customer says</h2>
                        </div>
                  
                        <div class="yt-content-slider sm_imageslider slider-happy-client" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                            <div class="item">
                                <div class="ct-why">
                                    <div class="client-say">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla. Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis.</div>
                                    <p class="client-info-about"><span class="name">- Mama Duo - </span>Social Media Strategist</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ct-why">
                                    <div class="client-say">In congue, justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis.</div>
                                    <p class="client-info-about"><span class="name">- Join Doe - </span>Social Media Strategist</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ct-why">
                                    <div class="client-say">Dui nibh scelerisque justo, in congue, justo non cursus adipiscing, quis pretium turpis neque eget nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis.</div>
                                    <p class="client-info-about"><span class="name">- Join Doe - </span>Social Media Strategist</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="ct-why">
                                    <div class="client-say">In congue, justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis neque eget nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum consectetur metus nec dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In congue, justo non cursus adipiscing, dui nibh scelerisque justo non cursus adipiscing, dui nibh scelerisque justo, quis pretium turpis.</div>
                                    <p class="client-info-about"><span class="name">- Join Doe - </span>Social Media Strategist</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                
            </div>
        </div>
    </div>
</div>
<!-- //Main Container -->
@push('vuejs')
@include('frontend.plugins.vuejs')
@endpush
@endsection
