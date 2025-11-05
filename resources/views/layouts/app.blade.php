
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon dan App Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/icon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon/favicon-16x16.png') }}">
    <link rel="icon" href="{{ asset('image/icon/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('image/icon/site.webmanifest') }}">
    <meta name="theme-color" content="#ffffff">

    {{-- Meta Tags --}}
    <title>@yield('title')</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    @stack('style')
</head>
<body>
    @php
        $socialMediaHeadMenu = \App\Models\SocialMedia::take(3)->get();
        $socialMediaFooter = \App\Models\SocialMedia::all();
        $textStatement = [
            'facebook' => 'Like Our Facebook Page',
            'x' => 'Follow Us On X',
            'instagram' => 'Follow Us On Instagram',
            'tiktok' => 'Follow Us On TikTok',
            'youtube' => 'Subscribe To Our YouTube Channel',
            'threads' => 'Follow Us On Threads',
        ];
    @endphp

    {{--@include('layouts.part.top')--}}
    {{--@include('layouts.part.header-top')--}}
    @include('layouts.part.header')

    @yield('content')

    @include('layouts.part.footer')
    @include('layouts.part.footer-bottom')

    @vite('resources/js/app.js')
    <script src="{{ asset('style/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('style/js/theme.min.js') }}"></script>
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sienna-accessibility@latest/dist/sienna-accessibility.umd.js" defer></script>
</body>
</html>
