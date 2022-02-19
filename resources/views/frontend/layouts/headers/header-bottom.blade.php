@push('header-bottom')
    <!-- Header Bottom -->
    <div class="header-bottom hidden-compact">
        <div class="container">
            <div class="row">
                
                <div class="bottom1 menu-vertical col-lg-2 col-md-3">
                    <!-- Secondary menu -->
                    <div class="responsive so-megamenu megamenu-style-dev">
                        <div class="so-vertical-menu ">
                            <nav class="navbar-default">    
                                
                                <div class="container-megamenu vertical">
                                    <div id="menuHeading">
                                        <div class="megamenuToogle-wrapper">
                                            <div class="megamenuToogle-pattern">
                                                <div class="container">
                                                    <div>
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                    All Categories                          
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="navbar-header">
                                        <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">      
                                            <i class="fa fa-bars"></i>
                                            <span>  All Categories     </span>
                                        </button>
                                    </div>
                                    <div class="vertical-wrapper" >
                                        <span id="remove-verticalmenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                            <div class="container-mega">
                                                <ul class="megamenu">

                                                    @foreach(App\Models\catalog\category::where('parent_id',null)->orWhere('parent_id','')->orWhere('parent_id',[])->get() as $cat)
                                                        <li class="item-vertical  @if(count($cat->child)) with-sub-menu hover @endif">
                                                            <p class="close-menu"></p>
                                                            <a href="{{route('category.products',$cat->slug)}}" class="clearfix">
                                                                <img src="{{asset($cat->icon)}}" alt="icon" />
                                                                <span>{{$cat->name}}</span>
                                                                <b class="caret"></b>
                                                            </a>
                                                            @if($cat->child)
                                                            <div class="sub-menu" data-subwidth="60">
                                                                <div class="content" >
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="row">
                                                                                <div class="col-md-4 static-menu">
                                                                                    <div class="menu">
                                                                                        <ul>
                                                                                            @foreach($cat->child as $leveltwo)
                                                                                            <li>
                                                                                                <a href="{{route('category.products',$leveltwo->slug)}}"  class="main-menu">{{$leveltwo->name}}</a>
                                                                                                @if($leveltwo->child)
                                                                                                <ul>
                                                                                                @foreach($leveltwo->child as $levelthree)
                                                                                                    
                                                                                                    <li><a href="{{route('category.products',$levelthree->slug)}}" >{{$levelthree->name}}</a></li>
                                                                                                    
                                                                                                  @endforeach
                                                                                                </ul>
                                                                                                @endif
                                                                                            </li>
                                                                                            @endforeach
                                                                                           
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>

                                                                                @endif

                                                                               
                                                                               
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

@endforeach

                                                  
                                                      
                                            
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                        </div>
                    </div>
                    <!-- // end Secondary menu -->
                </div>
                <!-- Main menu -->
                <div class="main-menu col-lg-6 col-md-9">
                    <div class="responsive so-megamenu megamenu-style-dev">
                        <nav class="navbar-default">
                            <div class=" container-megamenu  horizontal open ">
                                <div class="navbar-header">
                                    <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                
                                <div class="megamenu-wrapper">
                                    <span id="remove-megamenu" class="fa fa-times"></span>
                                    <div class="megamenu-pattern">
                                        <div class="container-mega">
                                            <ul class="megamenu" data-transition="slide" data-animationtime="250">
                                                <li class="home hover">
                                                    <a href="{{route('home')}}">Home <b class="caret"></b></a>
                                                    {{-- <div class="sub-menu" style="width:100%;" >
                                                        <div class="content" >
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <a href="index.html" class="image-link"> 
                                                                        <span class="thumbnail">
                                                                
                                                                            <img class="img-responsive img-border" src="{{asset('public/frontend/image/catalog/menu/home-1.jpg')}}" alt="">
                                                                            
                                                                        </span> 
                                                                        <h3 class="figcaption">Home page - (Default)</h3> 
                                                                    </a> 
                                                                    
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a href="home2.html" class="image-link"> 
                                                                        <span class="thumbnail">
                                                                            <img class="img-responsive img-border" src="{{asset('public/frontend/image/catalog/menu/home-2.jpg')}}" alt="">
                                                                           
                                                                        </span> 
                                                                        <h3 class="figcaption">Home page - Layout 2</h3> 
                                                                    </a> 
                                                                    
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a href="home3.html" class="image-link"> 
                                                                        <span class="thumbnail">
                                                                            <img class="img-responsive img-border" src="{{asset('public/frontend/image/catalog/menu/home-3.jpg')}}" alt="">
                                                                           
                                                                        </span> 
                                                                        <h3 class="figcaption">Home page - Layout 3</h3> 
                                                                    </a> 
                                                                    
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a href="home4.html" class="image-link"> 
                                                                        <span class="thumbnail">
                                                                            <img class="img-responsive img-border" src="{{asset('public/frontend/image/catalog/menu/home-4.jpg')}}" alt="">
                                                                            
                                                                        </span> 
                                                                        <h3 class="figcaption">Home page - Layout 4</h3> 
                                                                    </a> 
                                                                    
                                                                </div>
                                                                
                                                                <!-- <div class="col-md-15">
                                                                    <a href="#" class="image-link"> 
                                                                        <span class="thumbnail">
                                                                            <img class="img-responsive img-border" src="{{asset('public/frontend/image/demo/feature/comming-soon.png')}}" alt="">
                                                                            
                                                                        </span> 
                                                                        <h3 class="figcaption">Comming soon</h3> 
                                                                    </a> 
                                                                    
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </li>
                                                <li class="with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="#" class="clearfix">
                                                        <strong>Features</strong>
                                                        <img class="label-hot" src="{{asset('public/frontend/image/catalog/menu/new-icon.png')}}" alt="icon items">
                                                        <b class="caret"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 100%; right: auto;">
                                                        <div class="content" >
                                                            <div class="row">
                                                              
                                                                <div class="col-md-3">
                                                                    <div class="column">
                                                                        <a href="#" class="title-submenu">Feature Category</a>
                                                                        <div>
                                                                            <ul class="row-list">
                                                                                @foreach (App\Models\catalog\category::all() as $shopcat )
                                                                                <li><a href="{{route('category.products',$shopcat->slug)}}">{{$shopcat->name}}</a></li>
                                                                                 @endforeach
                                                                            </ul>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                {{-- <li class="with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="#" class="clearfix">
                                                        <strong>Pages</strong>
                                                        <b class="caret"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 40%; ">
                                                        <div class="content" >
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <ul class="row-list">
                                                                        <li><a href="{{route('about-us')}}">About Us</a></li>
                                                                        <li><a href="{{route('faq')}}">FAQ</a></li>
                                                                        <li><a href="{{route('termsnCondition')}}">Terms & Condidition</a></li>
                                                                    </ul>
                                                                </div>
                                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li> --}}
                                                <li class="with-sub-menu hover">
                                                    <p class="close-menu"></p>
                                                    <a href="#" class="clearfix">
                                                        <strong>Categories</strong>
                                                        <img class="label-hot" src="{{asset('public/frontend/image/catalog/menu/hot-icon.png')}}" alt="icon items">
                                              
                                                        <b class="caret"></b>
                                                    </a>
                                                    <div class="sub-menu" style="width: 100%; display: none;">
                                                        <div class="content">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        @foreach (App\Models\catalog\category::all() as $shopcat )
                                                                        <div class="col-md-3 img img1">
                                                                            <a  href="{{route('category.products',$shopcat->slug)}}"><img src="{{asset($shopcat->image)}}" alt="banner1"></a>
                                                                        </div>
                                                                         @endforeach
                                                                     
                                                                      
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                @foreach (App\Models\catalog\category::all() as $shopcat )
                                                                <div class="col-md-3">
                                                                    <a  href="{{route('category.products',$shopcat->slug)}}" class="title-submenu">{{$shopcat->name}}</a>
                                                                    <div class="row">
                                                                        <div class="col-md-12 hover-menu">
                                                                            <div class="menu">
                                                                                {{-- <ul>
                                                                                    <li><a href="#"  class="main-menu">Car Alarms and Security</a></li>
                                                                                    <li><a href="#"  class="main-menu">Car Audio &amp; Speakers</a></li>
                                                                                    <li><a href="#"  class="main-menu">Gadgets &amp; Auto Parts</a></li>
                                                                                    <li><a href="#"  class="main-menu">More Car Accessories</a></li>
                                                                                </ul> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                {{-- <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="#" class="clearfix">
                                                        <strong>Accessories</strong>
                                     
                                                    </a>
                                        
                                                </li> --}}
                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="{{route('about-us')}}" class="clearfix">
                                                        <strong>About Us</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                                
                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="{{route('termsnCondition')}}" class="clearfix">
                                                        <strong>Term & Condition</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                                
                                               
                                                
                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="{{route('blogs')}}" class="clearfix">
                                                        <strong>Blog</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>

                                                
                                                <li class="">
                                                    <p class="close-menu"></p>
                                                    <a href="{{route('contact-us')}}" class="clearfix">
                                                        <strong>Contact Us</strong>
                                                        <span class="label"></span>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- //end Main menu -->
                
                
                <header-profile></header-profile> <!--its just for shwing user name and check user auth -->
                
                
            </div>
        </div>

    </div>
@endpush