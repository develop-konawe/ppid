@php use Illuminate\Support\Str; @endphp

@push('styles')

@endpush
@php

$bgStyle = [
    'facebook' => 'background: #4c66a4; background: linear-gradient(45deg, #4c66a4, #3b5998, #192f6a);',
    'x' => 'background: #000000; background: linear-gradient(45deg, #000000, #010101, #010101);',
    'instagram' => 'background: #d6249f; background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);',
    'tiktok' => 'background: #000000; background: linear-gradient(45deg, #000000, #010101, #010101);',
    'youtube' => 'background: #FF0000; background: linear-gradient(45deg, #FF0000, #cc0000, #990000);',
    'threads' => 'background: #000000; background: linear-gradient(45deg, #000000, #010101, #010101);',
];

$textStatement = [
    'facebook' => 'Like Our Facebook Page',
    'x' => 'Follow Us On X',
    'instagram' => 'Follow Us On Instagram',
    'tiktok' => 'Follow Us On TikTok',
    'youtube' => 'Subscribe To Our YouTube Channel',
    'threads' => 'Follow Us On Threads',
];

@endphp
<div class="news_1_right1">
    @if($socialMedias)
        @foreach($socialMedias as $socialMedia)
            @php($bgIconColorClass = $bgIconColor[$socialMedia->platform] ?? 'bg_black')
            @php($bgStyleClass = $bgStyle[$socialMedia->platform] ?? 'background: #000000; background: linear-gradient(45deg, #000000, #010101, #010101);')

            <ul class="mb-0 bg-primary d-flex justify-content-between mb-3">
                <li>
                    <a style="{{ $bgStyleClass }}" class="social_icon d-inline-block text-center text-white" href="{{ $socialMedia->url }}" target="_blank">
                        <i class="fa-brands {{ $socialMedia->icon }}"></i>
                    </a>
                </li>
                <li class="lh-1 pt-3 text-uppercase">
                    <a class="text-white" href="{{ $socialMedia->url }}" target="_blank">
                      <span class="font_13">
                      <b>{{ $textStatement[$socialMedia->platform] }} </b><br>
                      {{--<span class="font_11">86500 Likes</span>--}}
                      </span>
                    </a></li>
                <li class="pt-3 pe-3">
                    {{--<a class="rounded-circle plus_icon rounded-circle text-white d-inline-block font_14 text-center" href="news_detail.html"><i class="fa-brands fa-plus"></i></a>--}}
                </li>
            </ul>
        @endforeach
    @endif
</div>
