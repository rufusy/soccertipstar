<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'soccertipstar') }}</title>

    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="{{ asset('frontend/img/favicon_2.png') }}" rel="icon">
    {{-- <link href="{{ asset('frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/lib/bootstrap/css/bootstrap.min.css') }}">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('frontend/lib/nivo-slider/css/nivo-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/jquery-steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/toastr/toastr.min599c.css?v4.0.2') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/country-picker-flags/css/countrySelect.min.css') }}" rel="stylesheet">
    
    {{-- <link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />
    --}}

    
    <!-- Nivo Slider Theme -->
    <link href="{{ asset('frontend/css/nivo-slider-theme.css') }}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- Responsive Stylesheet File -->
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    
    <!-- Custom Stylesheet File.  Not part of the template -->
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">

</head>

<body data-spy="scroll" data-target="#navbar-example">
    <div class="main-container">
        <div id="preloader"></div>

        @include('layouts.frontend.navbar')

        @yield('content')

        @include('layouts.frontend.footer')

    </div>
</body>

<!-- JavaScript Libraries -->
<script src="{{ asset('frontend/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/lib/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('frontend/lib/knob/jquery.knob.js') }}"></script>
<script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('frontend/lib/parallax/parallax.js') }}"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/nivo-slider/js/jquery.nivo.slider.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/lib/appear/jquery.appear.js') }}"></script>
<script src="{{ asset('frontend/lib/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('frontend/lib/jquery.pwstrength/jquery.pwstrength.js') }}"></script>
<script src="{{ asset('frontend/lib/card/dist/card.js') }}"></script>
<script src="{{ asset('frontend/lib/toastr/toastr.min599c.js?v4.0.2') }}"></script>
<script src="{{ asset('frontend/lib/country-picker-flags/js/countrySelect.min.js') }}"></script>

<!-- template js file -->
<script src="{{ asset('frontend/js/main.js') }}"></script>
<!-- stick footer to bottom of page when page content is short-->
<script src="{{ asset('frontend/js/footerBottom.js') }}"></script>
<!-- 2Checkout JavaScript library -->
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    $(document).ready(function(){
        /* Toastr messages */
        toastr.options.closeButton = true;
        toastr.options.timeOut = 5000;
        @if (session()->has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session()->has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (session()->has('info'))
            toastr.info("{{ session('info') }}");
        @endif
    });
</script>

<!-- Contact Form JavaScript File -->
<script src="{{ asset('frontend/contactform/contactform.js') }}"></script>

{{-- <script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script> 
<script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>  --}}

@yield('javascript');

</html>
