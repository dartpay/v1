<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('partials.seo')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . '/css/bootstrap-fileinput.css') }}">

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://envato.appdevs.net/xremitpro/public/frontend/css/aos.css">
    <link rel="stylesheet" href="https://www.eg4cash.com/assets/templates/orange_oasis/css/slick.css">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/style.css') }}">
    <link href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{$general->base_color}}" rel="stylesheet" />

    @stack('style-lib')

    @stack('style')
    <style>
    .mean-menu .nice-select {
        background: transparent;
        border: 0;
        margin-top: 5px;
    }
    .langSel .current{
        background: transparent;
        border: 0;
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
    .exchange-nav .navbar .navbar-nav .nav-item .nav-link{
        color: #fff
    }
    .langSel:after{
        border-bottom: 2px solid #fff;
        border-right: 2px solid #fff;
        width: 8px;
        height: 8px;
    }
    .langSel .list{
        min-width: 10rem;
    }
    .langSel .list{
        margin-top:10px;
    }
    .langSel .option.focus, .nice-select .option.selected.focus {
        background-color: transparent;
    }
    .langSel .option{
        font-weight: 500;
    }
    .langSel .option.selected {
        font-size: 15.5px;
        font-weight: 700;
    }
    .navbar-area.is-sticky .exchange-nav .navbar .navbar-nav .nav-item a{
        color: #000 !important;
    }
    .navbar-area.is-sticky .langSel .current{
        color: #000 !important;
    }
    .navbar-area.is-sticky .langSel:after{
        border-bottom: 2px solid #000 !important;
        border-right: 2px solid #000 !important;
    }
    .black-logo{
        display: none;
    }
    .navbar-area.is-sticky .black-logo{
        display: block;
    }
    .navbar-area.is-sticky .white-logo{
        display: none;
    }
    </style>
</head>

<body>

    <!--========== Preloader ==========-->
    
    <div class="preloader" hidden id="preloader">
        <div class="logo">
        </div>
        <div class="loader-frame">
            <div class="loader1" id="loader1">
            </div>
            <div class="circle"></div>
            <h6 class="wellcome">
                <span class="d-block w-100 text-white">@lang('Wellcome to')</span>
                <span class="d-block w-100">{{$general->sitename}}</span>
            </h6>
        </div>
    </div>
    <!-- <a class="nav-link" href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a> -->
    <!--========== Preloader ==========-->
    
    <div class="wrap">
        <div class="navbar-area home-section">
            <div class="exchange-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="nav-link" class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ siteLogo('dark') }}" class="white-logo" alt="logo">
                            <img src="{{ siteLogo() }}" class="black-logo" alt="logo">
                        </a>
                        <div class="header-bar-area d-lg-none">
                            <div class="header-bar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="collapse navbar-collapse mean-menu">
                            <ul class="navbar-nav">
                            
                            @guest
                           

                            @foreach ($pages as $k => $data)

                            @auth
                                @if($data->name == 'Contact')
                                
                                    @continue
                                
                                @endif
                            @endauth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pages', [$data->slug]) }}">{{ trans($data->name) }}</a>
                                </li>
                            @endforeach
                               
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.login') }}">@lang('Login')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.register') }}">@lang('Registration')</a>
                                </li>
                            @endguest    
                            
                            @auth

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                                </li>

                            <li class="nav-item dropdown items">
                                <a href="#" class="nav-link dropdown-toggle" id="transaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('Transaction History')</a>
                                <div class="dropdown-menu transaction-dropdown-menu" aria-labelledby="transaction">
                                    <a class="dropdown-item" href="{{ route('user.exchange.approved') }}">@lang('Approved Transaction')</a>
                                    <a class="dropdown-item" href="{{ route('user.exchange.pending') }}">@lang('Pending Transaction')</a>
                                    <a class="dropdown-item" href="{{ route('user.exchange.proccessing') }}">@lang('Proccessing Transaction')</a>
                                    <a class="dropdown-item" href="{{ route('user.exchange.refunded') }}">@lang('Refunded Transaction')</a>
                                    <a class="dropdown-item" href="{{ route('user.exchange.cancled') }}">@lang('Cancled Transaction')</a>
                                    <a class="dropdown-item" href="{{ route('user.exchange.all') }}">@lang('All Transaction')</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown items">
                                <a href="#" class="nav-link dropdown-toggle" id="transaction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('Ticket')</a>
                                <div class="dropdown-menu transaction-dropdown-menu" >
                                    <a class="dropdown-item" href="{{ route('ticket.open') }}">@lang('Create New')</a>
                                    <a class="dropdown-item" href="{{ route('ticket') }}">@lang('My Ticket')</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown items">
                                <a href="#" class="nav-link dropdown-toggle" id="transaction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('Withdraw')</a>
                                <div class="dropdown-menu transaction-dropdown-menu" >
                                    <a class="dropdown-item" href="{{ route('user.withdraw') }}">@lang('Withdraw Money')</a>
                                    <a class="dropdown-item" href="{{ route('user.withdraw.history') }}">@lang('Withdraw Log')</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown items">
                                <a href="#" class="nav-link dropdown-toggle" id="transaction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('Account')</a>
                                <div class="dropdown-menu transaction-dropdown-menu" aria-labelledby="transaction" >
                                    <a class="dropdown-item" href="{{ route('user.change-password') }}">@lang('Change Password')</a>
                                    <a class="dropdown-item" href="{{ route('user.profile-setting') }}">@lang('Profile Setting')</a>
                                    <a class="dropdown-item" href="{{ route('user.affiliate') }}">@lang('Affiliation')</a>
                                    <a class="dropdown-item" href="{{ route('user.reffer.log') }}">@lang('Commission Logs')</a>
                                    <a class="dropdown-item" href="{{ route('user.twofactor') }}">@lang('2FA Security')</a>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}">{{ __('Logout') }}</a>
                                </div>
                            </li>
                       
                            @endauth

                        </ul>
                        </div>                      
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--=======Header-Section Ends Here=======-->

    @if (!request()->is('/'))
        @include($activeTemplate.'partials.bread_container')
    @endif
    @yield('content')

    @include($activeTemplate . 'partials.footer')
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="{{ asset($activeTemplateTrue . 'js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/plugins.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/bootstrap.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/swiper.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/wow.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/nice-select.js') }}"></script>
    <script src="https://envato.appdevs.net/xremitpro/public/frontend/js/aos.js"></script>
        <script src="https://www.eg4cash.com/assets/templates/orange_oasis/js/slick.min.js"></script>
    <script src="https://envato.appdevs.net/xremitpro/public/frontend/js/swiper.js"></script>
    <script src="https://www.eg4cash.com/assets/global/js/select2.min.js"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>

    @stack('script-lib')
    @include('admin.partials.notify')
    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

    <script>
        "use strict";
        (function($) {
            $(document).on("change", ".langSel", function() {
                window.location.href = "{{ url('/') }}/change/" + $(this).val();
            });
        })(jQuery);

    </script>

</body>

</html>
