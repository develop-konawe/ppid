@extends('layouts.app')

@section('title', $page->title)

@push('style')
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($page->content), 150) }}">
    <meta property="og:url" content="{{ route('page.show', $page->slug) }}">
    <meta property="og:type" content="article">

    <style>
        /* Batasi ukuran semua gambar di dalam konten editor */
        .content-ppid img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto; /* opsional: agar gambar terpusat */
        }

        /* Jika ada iframe (misal embed video Google Drive atau YouTube), buat responsive */
        .content-ppid iframe {
            max-width: 100%;
            width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
            display: block;
            margin: 1em auto;
        }

        /* Pastikan tabel, video, dll juga tidak melewati container */
        .content-ppid * {
            box-sizing: border-box;
            max-width: 100%;
            word-wrap: break-word;
        }
    </style>
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
                        <span class="mb-0 font_11 light_gray"><a class="fw-bold" href="{{ route('home') }}">Beranda</a> <span class="mx-2">/</span> {{ $page->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="news" class="pt-5 pb-5 bg-light">
        <div class="container-xl">
            <div class="row news_1">
                <div class="col-md-12">
                    <div class="news_dt">
                        <div class="news_dt2 p-4 bg-white">
                            <b class="d-block fs-2 text-uppercase mt-2 mb-1"><a href="#">{{ $page->title }}</a></b>
                            <ul class="mb-0 font_11 fw-bold text-uppercase justify-content-between d-flex">
                                <li>
                                    <a href="#"><i class="fa fa-user"></i></a>
                                    <span class="light_gray ms-1">Admin</span>
                                    <i class="fa fa-clock me-1 text-warning align-middle ms-3"></i>
                                    <span class="light_gray">{{ $page->created_at->format('M d, Y') }}</span>
                                </li>
                                <li class="my-auto">
                                    <a class="light_gray" href="#"><i class="fa fa-eye me-1"></i> {{ $page->views }}</a>
                                    {{--                                    <a class="light_gray mx-3" href="#"><i class="fa fa-heart me-1 text-danger"></i> 545</a>--}}
                                    {{--                                    <a class="light_gray" href="#"><i class="fa fa-comment me-1"></i> 16</a>--}}
                                </li>
                            </ul>
                            <div class="mt-4 content-ppid">{!! str($page->content)->sanitizeHtml() !!}</div>
                        </div>
                        <div class="news_dt3 mt-3">
                            <ul class="mb-0 text-uppercase fw-bold justify-content-between d-flex">
                                <li class="d-inline-block"><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('page.show', $page->slug)) }}" class="d-inline-block bg-primary text-white rounded-1 font_11 p-3 px-5"><i class="fa-brands fa-facebook-f me-2 align-middle"></i> Share on facebook</a></li>
                                {{--                                <li class="d-inline-block"><a href="#" class="d-inline-block bg-info text-white rounded-1 font_11 p-3 px-5"><i class="fa-brands fa-twitter me-2 align-middle"></i> Share on twitter</a></li>--}}
                                {{--                                <li class="d-inline-block"><a href="#" class="d-inline-block bg-danger text-white rounded-1 font_11 p-3 px-5"><i class="fa-brands fa-instagram me-2 align-middle"></i> Share on instagram</a></li>--}}
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
