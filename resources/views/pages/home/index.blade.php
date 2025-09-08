@extends('layouts.app')

@section('title', 'Beranda')

@push('style')
@endpush

@section('content')
    <!-- banner start -->
    @include('pages.home.partials.home_banner')

    <!-- news start -->
    <section id="news" class="pt-5 pb-5 bg-light">
        <div class="container-xl">
            <div class="row news_1">

                {{-- left side --}}
                <div class="col-md-8">
                    <div class="news_1_left">

                        @if($beritas->isNotEmpty() || $pengumumans->isNotEmpty())
                            {{-- featured news --}}
                            @include('pages.home.partials.home_featured_news')

                        @endif
                        {{--                        @include('pages.home_partials.home_left_image_news')--}}



                        {{-- latest news --}}
                        @include('pages.home.partials.home_latest_news')

                        {{-- latest announcements --}}
                        @include('pages.home.partials.home_latest_announcements')

                        {{-- gallery --}}
                        @include('pages.home.partials.home_gallery')
                    </div>
                </div>

                {{--  right side  --}}
                @include('pages.home.partials.home_sidebar')

            </div>
        </div>
    </section>
    <!-- news end -->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.5/dist/index.bundle.min.js"></script>
@endpush
