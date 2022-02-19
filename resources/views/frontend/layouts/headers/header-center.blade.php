@push('header-center')
        <!-- Header center -->
        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                    <div class="navbar-logo col-lg-2 col-md-3 col-sm-12 col-xs-12">
                        <div class="logo"><a href="{{route('home')}}"><img src="{{asset('public/frontend/image/catalog/logo.svg')}}"  title="Your Store" alt="Your Store" style="width: 55%; height:55%" /></a></div>
                    </div>
                    <!-- //end Logo -->
                    <!-- Search -->
                    <div class="middle2 col-lg-7 col-md-6">
                        <div class="search-header-w">
                            <div class="icon-search hidden-lg hidden-md hidden-sm"><i class="fa fa-search"></i></div> 
                            <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                                <form method="GET" action="index.html">
                                    <div id="search0" class="search input-group form-group">
                                        <div class="select_category filter_type  icon-select hidden-sm hidden-xs">
                                            <select class="no-border" name="category_id">
                                                <option value="all">All Categories</option>
                                                @foreach(App\Models\catalog\category::where('parent_id',null)->orWhere('parent_id','')->orWhere('parent_id',[])->get() as $cat)
                                               
                                                   
                                                <option value="{{$cat->_id}}">{{$cat->name}}</option>
                                               
                                               
                                                @endforeach
                                            </select>
                                        </div>
    
                                        <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Keyword here..." name="search">
                                        <span class="input-group-btn">
                                        <button type="submit" class="button-search btn btn-primary" name="submit_search"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                    <input type="hidden" name="route" value="product/search" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- //end Search -->
                    
                    <div class="middle3 col-lg-3 col-md-3">                    
                        <!--cart --> 
                            <cart-list></cart-list>
                        <!--//cart-->
    
                        <ul class="wishlist-comp hidden-md hidden-sm hidden-xs">
                            <li class="compare hidden-xs"><a href="#" class="top-link-compare" title="Compare "><i class="fa fa-refresh"></i></a>
                            </li>
                            <li class="wishlist hidden-xs"><a href="#" id="wishlist-total" class="top-link-wishlist" title="Wish List (0) "><i class="fa fa-heart"></i></a>
                            </li>
                        </ul>
                    </div>
                    
                    
                </div>
    
            </div>
        </div>
        <!-- //Header center -->
@endpush