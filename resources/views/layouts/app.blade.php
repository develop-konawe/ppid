
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
    @stack('scripts')
</body>
</html>
