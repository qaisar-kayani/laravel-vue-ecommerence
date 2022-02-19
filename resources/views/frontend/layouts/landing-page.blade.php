<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic page needs
    ============================================ -->
    {!! Meta::toHtml() !!}

    <!-- Favicon
    ============================================ -->

    <link rel="shortcut icon" type="image/png" href="ico/favicon-16x16.png" />


    <!-- Libs CSS
    ============================================ -->

    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('public/frontend/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/js/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/js/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/themecss/lib.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/js/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/js/minicolors/miniColors.css') }}" rel="stylesheet">

    <!-- Theme CSS
    ============================================ -->
    <link href="{{ asset('public/frontend/css/themecss/so_searchpro.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/themecss/so_megamenu.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/themecss/so-categories.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/themecss/so-listing-tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/themecss/so-newletter-popup.css') }}" rel="stylesheet">

    <link href="{{ asset('public/frontend/css/footer/footer1.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/header/header2.css') }}" rel="stylesheet">

    <link id="color_scheme" href="{{ asset('public/frontend/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    @stack('extracss')

    <!-- Google web fonts
    ============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700' rel='stylesheet'
        type='text/css'>
    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif
        }
        
        </style>

</head>


<body class="common-home res layout-2">
 <div class="loading">
     <div class='uil-ring-css' style='transform:scale(0.79);'>
        <div></div>
    </div>
    </div>
    <div id="wrapper" class="wrapper-fluid banners-effect-7">
        <div id="frontend">
            @include('frontend.layouts.headers.container')
            @yield('content')
            @include('frontend.layouts.footer')
        </div>
    </div>
    
    
    <!-- End Color Scheme
        ============================================ -->
        
        
        
        @stack('vuejs');
    <!-- Include Libs & Plugins
============================================ -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{ asset('public/frontend/js/jquery-2.2.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/owl-carousel/owl.carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/themejs/libs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/unveil/jquery.unveil.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/countdown/jquery.countdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/datetimepicker/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/datetimepicker/bootstrap-datetimepicker.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/modernizr/modernizr-2.6.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/minicolors/jquery.miniColors.min.js') }}"></script>

    <!-- Theme files
============================================ -->

    <script type="text/javascript" src="{{ asset('public/frontend/js/themejs/homepage.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('public/frontend/js/themejs/toppanel.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('public/frontend/js/themejs/so_megamenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/themejs/addtocart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/themejs/application.js') }}"></script>
    @stack('custom_js')
    <script type="text/javascript">
        // Check if Cookie exists
        if ($.cookie('display')) {
            view = $.cookie('display');
        } else {
            view = 'grid';
        }
        if (view) display(view);
        //-->
        </script>

</body>

</html>
