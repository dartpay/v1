<!doctype html>
<html lang="en">

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
    <link rel="stylesheet" href="https://envato.appdevs.net/xremitpro/public/frontend/css/aos.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://www.eg4cash.com/assets/templates/orange_oasis/css/slick.css">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/style.css') }}">
    <link href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{$general->base_color}}" rel="stylesheet" />
    @stack('style-lib')

    @stack('style')
    <style>



        
        
        .mean-menu .nice-select {
            background: transparent;
            border: 0;
        }
        .langSel .current{
            background: transparent;
            border: 0;
            color: #000;
            font-size: 15px;
            font-weight: 600;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
        .nav-link{
            color: #000;
        }
        .langSel:after{
            border-bottom: 2px solid #000;
            border-right: 2px solid #000;
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

    </style>
</head>

<body>
    @stack('fb-comment')
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
    <!-- <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a> -->
    <!--========== Preloader ==========-->

    <div class="wrap">
        <div class="navbar-area home-section">
            <div class="exchange-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ siteLogo() }}" class=" black-logo" alt="logo">
                            <img src="{{ siteLogo('dark') }}" class="white-logo" alt="logo">
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
                                <li class="nav-item">
                                    <a href="{{ route('home') }}" class="nav-link">@lang('Home')</a>
                                </li>
                                @foreach ($pages as $k => $data)
                               
                                    @if(strtolower($data->name) == 'blog' )
                                        
                                            @continue
                                        
                                    @endif
                                    @if(strtolower($data->name) == 'contact' )
                                    
                                        @continue
                                    
                                    @endif

                                    @if($data->name == 'policy')
                                        
                                        @continue
                                        
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{ route('pages', [$data->slug]) }}"  class="nav-link">{{ __($data->name) }}</a>
                                    </li>
                                @endforeach

                                <li class="nav-item">
                                    <a href="{{ route('pages','blog') }}" class="nav-link">@lang('Blog')</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}" class="nav-link">@lang('Contact')</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav"  hidden="">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Transaction History</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Ticket</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Withdraw</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Account</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav" hidden="">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">About</a>
                                </li>
                                @guest
                                    <li class="nav-item">
                                        <a href="#" class="nav-link"> Contact</a>
                                    </li>
                                @endguest
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Affiliation</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> Dashboard</a>
                                </li>
                            </ul>
                            @if ($general->multi_language)
                                <select class="select-bar language langSel" hidden>
                                    @foreach ($language as $lang)
                                        <option value="{{$lang->code}}" {{session('lang') == $lang->code ? 'selected':''}}>
                                            {{ $lang->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            @auth
                                @if(request()->is('user/authorization'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.logout') }}">@lang('Logout')</a>
                                </li>

                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                                </li>
                                @endif
                                
                            @endauth
                            @guest
                                <div class="other-option" >
                                    <a href="{{ route('user.register') }}" class="default-btn nav-btn-1">
                                        Sign Up
                                    </a>
                                </div>
                                <div class="other-option pb-xs-3" >
                                    <a href="{{ route('user.login') }}" class="default-btn nav-btn-1">
                                        Login
                                    </a>
                                </div>
                            @endguest
                        </div>                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--=======Header-Section Ends Here=======-->

    @yield('content')

    @include($activeTemplate . 'partials.footer')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="{{ asset($activeTemplateTrue . 'js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/plugins.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/bootstrap.min.js') }}"></script>
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
    @stack('script') 

    @include('partials.plugins')

    @include('partials.notify')

    <script>
        "use strict";
        (function($) {

            $(document).on("change", ".langSel", function() {
                window.location.href = "{{ url('/') }}/change/" + $(this).val();
            });
            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });
            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

        })(jQuery);

    </script>

</body>

</html>
