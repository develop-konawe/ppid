
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ asset('style/css/bootstrap.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('style/fonts/css/fontawesome.min.css') }}" rel="stylesheet" >
    <link href="{{ asset('style/fonts/css/brands.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('style/fonts/css/solid.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('style/css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('style/css/index.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    @stack('style')
</head>
<body>
{{--    @include('layouts.part.top')--}}
    @include('layouts.part.header-top')
    @include('layouts.part.header')

    @yield('content')

    @include('layouts.part.footer')
    @include('layouts.part.footer-bottom')

    <script src="{{ asset('style/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('style/js/theme.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
