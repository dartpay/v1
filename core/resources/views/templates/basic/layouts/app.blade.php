<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($page_title ?? '') }}</title>
    <!-- site favicon -->
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
</head>
<body>

@yield('content')



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


</body>
</html>
