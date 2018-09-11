<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap-reboot.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnifier.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/css/bootstrap-slider.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body>
    @yield('content')

    @if (Request::is('v2') || Request::is('v2/shop'))
        @include('users.layouts.footer-v2')
    @else
        @include('users.layouts.footer')
    @endif

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/bootstrap-slider.min.js"></script>
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script src="{{ asset('js/event.js') }}"></script>
    <script src="{{ asset('js/magnifier.js') }}"></script>

   {{--  <script type="text/javascript">
        var evt = new Event(),
        m = new Magnifier(evt);
    </script>
    <script type="text/javascript">
        m.attach({
            thumb: '.img',
            largeWrapper: 'preview',
            zoomable: true,
            zoom: 2
        });
    </script> --}}
    <script type="text/javascript">
        $('#order-successful').delay(500).fadeIn(250).delay(5000).fadeOut(500);
    </script>
    @yield('scripts')
</body>
</html>
