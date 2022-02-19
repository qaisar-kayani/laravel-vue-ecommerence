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
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{route('blogs')}}">Faq</a></li>
    </ul>
    
    <div class="row">
        
        <!--Middle Part Start-->
        <div id="content" class="col-md-12 col-sm-8">
            <div class="blog-header">
                <h3>Our Blog</h3>
                
            </div>
            <div class="blog-category clearfix">
          
                <div class="product-filter product-filter-top filters-panel hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-sm-4 view-mode">
                            <div class="list-view ">
                                <button type="button" id="grid-view" class="btn btn-view hidden-sm hidden-xs">1</button>
                                <button type="button" id="grid-view-2" class="btn btn-view ">2</button>
                                <button type="button" id="grid-view-3" class="btn btn-view hidden-sm hidden-xs ">3</button>
                                <button type="button" id="grid-view-4" class="btn btn-view hidden-sm hidden-xs">4</button>
                                <button type="button" id="list-view" class="btn btn-view list "><i class="fa fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-listitem row">
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/4.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/4.jpg')}}" alt="Duis autem vel eum irure sed diam nonumy" />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                            <b>04</b> Dec
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Duis autem vel eum irure sed diam nonumy</a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>
                                    </div>
                                    <p class="article-description">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/2.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/2.jpg')}}" alt="Biten demons lector in henderit in vulp" />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                                                                                                                           <b>04</b> Dec
                                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Biten demons lector in henderit in vulp</a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>
                                    </div>
                                    <p class="article-description">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, c...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/7.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/7.jpg')}}" alt="Duis autem vel eum tempor invidunt ut labore et " />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                                                                                                                           <b>15</b> Nov
                                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Duis autem vel eum tempor invidunt ut labore et </a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>   <span class="comment_count"><i class="fa fa-comment-o"></i><a href="#">0 Comments</a></span>
                                    </div>
                                    <p class="article-description">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/6.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/6.jpg')}}" alt="enim ad minim veniam  justo duo dolores et ea" />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                                                                                                                           <b>15</b> Nov
                                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Enim ad minim veniam  justo duo dolores et ea</a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>   <span class="comment_count"><i class="fa fa-comment-o"></i><a href="#">1 Comment</a></span>
                                    </div>
                                    <p class="article-description">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/5.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/5.jpg')}}" alt="Kire tuma feugiat " />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                                                                                                                           <b>15</b> Nov
                                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Kire tuma feugiat </a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>
                                    </div>
                                    <p class="article-description">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/3.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/3.jpg')}}" alt="Lorem ipsum dolor sit amet" />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                                                                                                                           <b>15</b> Nov
                                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Lorem ipsum dolor sit amet</a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>   <span class="comment_count"><i class="fa fa-comment-o"></i><a href="#">0 Comments</a></span>
                                    </div>
                                    <p class="article-description">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/10.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/10.jpg')}}" alt="Commodo laoreet semper tincidun   sit" />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                                                                                                                           <b>15</b> Nov
                                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Commodo laoreet semper tincidun   sit</a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>
                                    </div>
                                    <p class="article-description">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="blog-item-inner clearfix">
                            <div class="itemBlogImg clearfix">
                                <div class="article-image">
                                    <div>
                                        <a class="popup-gallery" href="image/catalog/blog/1.jpg">
                                            <img src="{{asset('public/frontend/image/catalog/blog/1.jpg')}}" alt="Kire tuma demons vel eum iriure dolor" />
                                        </a>
                                    </div>
                                    <div class="article-date">
                                        <div class="date">  <span class="article-date">
                                                                                                                                           <b>15</b> Nov
                                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="itemBlogContent clearfix ">
                                <div class="blog-content">
                                    <div class="article-title font-title">
                                        <h4><a href="blog-detail.html">Kire tuma demons vel eum iriure dolor</a></h4>
                                    </div>
                                    <div class="blog-meta"> <span class="author"><i class="fa fa-user"></i><span>Post by </span>Wash upito</span>
                                    </div>
                                    <p class="article-description">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, c...</p>
                                    <div class="readmore">  <a class="btn-readmore font-title" href="blog-detail.html"><i class="fa fa-caret-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-filter product-filter-bottom filters-panel clearfix">
                    <div class="row">
                        <div class="col-md-12">
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Middle Part End-->
</div>
@push('vuejs')
@include('frontend.plugins.vuejs')
@endpush
@endsection
