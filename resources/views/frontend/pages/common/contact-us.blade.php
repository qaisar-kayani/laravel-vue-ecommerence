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
        <li><a href="{{route('contact-us')}}">Contact us</a></li>
    </ul>
    
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="page-title">
                <h2>Contact Us</h2>
            </div>
            
            
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3612.424510182436!2d55.39635501541025!3d25.121335083931505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f647418555555%3A0xffee5ff8a1d50106!2sOnlinist!5e0!3m2!1sen!2sae!4v1642747019775!5m2!1sen!2sae" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <div class="info-contact clearfix">
                <div class="col-lg-4 col-sm-4 col-xs-12 info-store">
                    <div class="row">
                        <div class="name-store">
                            <h3>Your Store</h3>
                        </div>
                        <address>
                            <div class="address clearfix form-group">
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="text">Suite 1004, IT Plaza, Silicon Oasis, Dubai, United Arab Emirates</div>
                            </div>
                            <div class="phone form-group">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="text">Phone : (+971) 4 1234567 - (+971) 55 1234567</div>
                            </div>
                            <div class="comment">             
                            Maecenas euismod felis et purus consectetur, quis fermentum velition. Aenean egestas quis turpis vehicula.Maecenas euismod felis et purus consectetur, quis fermentum velition. 
                            Aenean egestas quis turpis vehicula.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
                            The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
                            </div>
                        </address>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-8 col-xs-12 contact-form">
                    <form action="" method="get" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset>
                            <legend>Contact Form</legend>
                            <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name">Your Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="" id="input-name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" value="" id="input-email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-enquiry">Enquiry</label>
                                <div class="col-sm-10">
                                    <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons">
                            <div class="pull-right">
                                <button class="btn btn-default buttonGray" type="submit">
                                    <span>Submit</span>
                                </button>
                            </div>
                        </div>
                    </form>
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
