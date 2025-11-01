
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


    @stack('style')
</head>
<body>
{{--    @include('layouts.part.top')--}}
    {{--@include('layouts.part.header-top')--}}
    @include('layouts.part.header')

    @yield('content')

    @include('layouts.part.footer')
    @include('layouts.part.footer-bottom')

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
