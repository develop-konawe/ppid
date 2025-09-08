@extends('layouts.app')

@section('title', $berita->title)

@push('style')
    <meta property="og:title" content="{{ $berita->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($berita->content), 150) }}">
    <meta property="og:image" content="{{ asset('storage/'.$berita->image) }}">
    <meta property="og:url" content="{{ route('news.detail', $berita->slug) }}">
    <meta property="og:type" content="article">
@endpush

@section('content')
    <section id="contact" class="bg-light">
        <div class="container-fluid p-0">
            <div class="row mx-0">
                <div class="col-md-2 p-0">
                    <div class="footer_bottom_left contact_left text-xl-end p-3 position-relative">
                        <span class="text-white fs-6 fw-bold ms-5">Detail Berita</span>
                    </div>
                </div>
                <div class="col-md-10 p-0">
                    <div class="contact_righto  p-3 bg-white">
                        <span class="mb-0 font_11 light_gray"><a class="fw-bold" href="{{ route('home') }}">Beranda</a> <span class="mx-2">/</span> <a href="{{ route('news') }}">Berita</a> <span class="mx-2">/</span> {{ $berita->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="news" class="pt-5 pb-5 bg-light">
        <div class="container-xl">
            <div class="row news_1">
                <div class="col-md-8">
                    <div class="news_dt">
                        <div class="news_dt1">
                            <a href="#">
                                {{-- Begin Gambar  --}}
                                @if(file_exists(public_path('storage/'.$berita->image)))
                                    <img  class="img-fluid" alt="abc" src="{{ asset('storage/' . $berita->image) }}">
                                @elseif(file_exists(public_path($berita->image)))
                                    <img  class="img-fluid" alt="abc" src="{{ asset($berita->image) }}">
                                @else
                                    <img  class="img-fluid" alt="abc" src="{{ asset('style/image/28.jpg') }}">
                                @endif
                                {{-- End Gambar  --}}
                            </a>
                        </div>
                        <div class="news_dt2 p-4 bg-white">
                            <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1">{{ $berita->category->name }}</b>
                            <b class="d-block fs-2 text-uppercase mt-2 mb-1"><a href="#">{{ $berita->title }}</a></b>
                            <ul class="mb-0 font_11 fw-bold text-uppercase justify-content-between d-flex">
                                <li>
                                    <a href="#"><img class="rounded-circle" alt="abc" src="image/9.jpg"></a>
                                    <span class="light_gray ms-2">Eget Nulla</span>
                                </li>
                                <li class="my-auto">
                                    <a class="light_gray" href="#"><i class="fa fa-eye me-1"></i> {{ $berita->views }}</a>
{{--                                    <a class="light_gray mx-3" href="#"><i class="fa fa-heart me-1 text-danger"></i> 545</a>--}}
{{--                                    <a class="light_gray" href="#"><i class="fa fa-comment me-1"></i> 16</a>--}}
                                </li>
                            </ul>
                            <p class="mt-4">{!! $berita->content !!} </p>
                            <ul class="mb-0 d-flex flex-wrap text-uppercase font_11 tags  mt-4">
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">lorem</a></li>
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">porta</a></li>
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">ipsum</a></li>
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">nulla</a></li>
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">semper</a></li>
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">quis</a></li>
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">popular</a></li>
                                <li class="mx-1 mt-1 mb-1"><a class="d-block border p-1 px-2" href="#">trending</a></li>
                            </ul>
                        </div>
                        <div class="news_dt3 mt-3">
                            <ul class="mb-0 text-uppercase fw-bold justify-content-between d-flex">
                                <li class="d-inline-block"><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.detail', $berita->slug)) }}" class="d-inline-block bg-primary text-white rounded-1 font_11 p-3 px-5"><i class="fa-brands fa-facebook-f me-2 align-middle"></i> Share on facebook</a></li>
{{--                                <li class="d-inline-block"><a href="#" class="d-inline-block bg-info text-white rounded-1 font_11 p-3 px-5"><i class="fa-brands fa-twitter me-2 align-middle"></i> Share on twitter</a></li>--}}
{{--                                <li class="d-inline-block"><a href="#" class="d-inline-block bg-danger text-white rounded-1 font_11 p-3 px-5"><i class="fa-brands fa-instagram me-2 align-middle"></i> Share on instagram</a></li>--}}
                            </ul>
                        </div>
                        <div class="news_dt5 mt-3">
                            <div class="row row-cols-1 row-cols-md-2">
                                @if($prev)
                                    <div class="col">
                                        <div class="news_dt5_left bg-white p-3">
                                            <ul class="mb-0">
                                                <li class="d-flex">
                                                    <span class="mt-4"><a class="d-inline-block bg-dark text-white rounded-1 p-2 px-3 font_13" href="{{ route('news.detail', $prev->slug) }}"><i class="fa fa-chevron-left"></i></a></span>
                                                    <span class="flex-column ms-1">
                                                        @if($prev->category_id)
                                                            <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1 mx-3">{{ $prev->category->name }}</b>
                                                        @endif
                                                        <b class="d-block font_13 text-uppercase mt-2  px-3"><a href="{{ route('news.detail', $prev->slug) }}">{{ $prev->title }}</a></b>
                                                        <span class="light_gray font_10 fw-bold  text-uppercase px-3"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 14, 2016</span>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if($next)
                                    <div class="col">
                                        <div class="news_dt5_left bg-white p-3">
                                            <ul class="mb-0">
                                                <li class="d-flex">
                                                    <span class="flex-column me-1">
                                                        @if($next->category_id)
                                                           <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1 mx-3">{{ $next->category->name }}</b>
                                                        @endif
                                                            <b class="d-block font_13 text-uppercase mt-2  px-3"><a href="{{ route('news.detail', $next->slug) }}">{{ $next->title }}</a></b>
                                                            <span class="light_gray font_10 fw-bold  text-uppercase px-3"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 14, 2016</span>
                                                    </span>
                                                    <span class="mt-4"><a class="d-inline-block bg-black text-white rounded-1 p-2 px-3 font_13" href="{{ route('news.detail', $next->slug) }}"><i class="fa fa-chevron-right"></i></a></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
