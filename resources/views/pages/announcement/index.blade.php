@extends('layouts.app')

@section('title', 'Pengumuman')

@push('style')
@endpush

@section('content')
    <section id="contact" class="bg-light">
        <div class="container-fluid p-0">
            <div class="row mx-0">
                <div class="col-md-2 p-0">
                    <div class="footer_bottom_left contact_left text-xl-end p-3 position-relative">
                        <span class="text-white fs-6 fw-bold ms-5">Pengumuman</span>
                    </div>
                </div>
                <div class="col-md-10 p-0">
                    <div class="contact_righto  p-3 bg-white">
                        <span class="mb-0 font_11 light_gray"><a class="fw-bold" href="{{ route("home") }}">Beranda</a> <span class="mx-2">/</span> Pengumuman</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="news" class="pt-5 pb-5 bg-light">
        <div class="container-xl">
            <div class="row news_1">
                <div class="col-md-12">
                    <div class="news_1_left">
                        <div class="news_1_left2">
                            @if($pengumumans && $pengumumans->count() > 0)
                                <div class="card">
                                    <div class="card-body p-0">
                                        @foreach($pengumumans as $pengumuman)
                                            <div class="row mx-0">
                                                @if($pengumuman->image)
                                                <div class="col-4 p-0">
                                                    <div class="blog_inner_left position-relative">
                                                        <div class="blog_inner_left1">
                                                            <a href="news_detail.html"><img src="image/16.jpg" class="img-fluid" alt="..."></a>
                                                        </div>
                                                        <div class="blog_inner_left2   position-absolute top-0 p-3">
                                                            <ul class="mb-0">
                                                                <li class="d-block fs-5"><a class="d-block bg_yellow text-white  rounded-circle text-center icon_1" href="news_detail.html"><i class="fa fa-plus"></i></a></li>
                                                                <li class="d-block fs-5 mt-2"><a class="d-block bg-info text-white  rounded-circle text-center icon_1 icon_2" href="news_detail.html"><i class="fa-brands fa-facebook-f"></i></a></li>
                                                                <li class="d-block fs-5 mt-2"><a class="d-block bg-danger text-white  rounded-circle text-center icon_1 icon_2" href="news_detail.html"><i class="fa-brands fa-twitter"></i></a></li>
                                                                <li class="d-block fs-5 mt-2"><a class="d-block bg-success text-white  rounded-circle text-center icon_1 icon_2" href="news_detail.html"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                                                <li class="d-block fs-5 mt-2"><a class="d-block bg_violet text-white  rounded-circle text-center icon_1 icon_2" href="news_detail.html"><i class="fa-brands fa-instagram"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-8 p-0">
                                                    <div class="blog_inner_right pt-4 d-flex flex-column align-items-start">
                                                        <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1 mx-3">{{ $pengumuman->category->name }}</b>
                                                        <b class="d-block fs-5 text-uppercase mt-2 mb-1 px-3"><a href="{{ route('announcement.detail', $pengumuman->slug) }}">{{ $pengumuman->title }}</a></b>
                                                        <span class="light_gray font_12 fw-bold px-3 text-uppercase">{{ $pengumuman->published_at->format('M d, Y') }}</span>

                                                        <p class="mt-3 px-3 mb-0 pb-4">{{ Str::limit(strip_tags($pengumuman->description), 150) }}</p>
                                                        <div class="mt-auto w-100">

                                                            <ul class="mb-0 px-3 py-3 font_11 fw-bold text-uppercase justify-content-between d-flex border-top" >
                                                                <li>
                                                                    <a href="news_detail.html"><i class="fa fa-user-alt"></i></a>
                                                                    <span class="light_gray ms-2">Admin</span>
                                                                </li>
                                                                <li class="my-auto">
                                                                    @if($pengumuman->file_path)
                                                                        <a class="light_gray m-3" href="{{ route('announcement.detail', $pengumuman->slug) }}"><i
                                                                                class="fa fa-eye me-1"></i> {{ $pengumuman->views }}</a>
                                                                        <a class="light_gray" href="{{ route('announcement.detail', $pengumuman->slug) }}"><i class="fa fa-file-alt me-1"></i></a>
                                                                    @else
                                                                        <a class="light_gray" href="{{ route('announcement.detail', $pengumuman->slug) }}"><i
                                                                                class="fa fa-eye me-1"></i> {{ $pengumuman->views }}</a>
                                                                    @endif
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                                <div class="col-12 p-0">
                                                    <div class="blog_inner_right pt-4 d-flex flex-column align-items-start">
                                                        <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1 mx-3">{{ $pengumuman->category->name }}</b>
                                                        <b class="d-block fs-5 text-uppercase mt-2 mb-1 px-3"><a href="{{ route('announcement.detail', $pengumuman->slug) }}">{{ $pengumuman->title }}</a></b>
                                                        <span class="light_gray font_12 fw-bold px-3 text-uppercase">{{ $pengumuman->published_at->format('M d, Y') }}</span>

                                                        <p class="mt-3 px-3 mb-0 pb-4">{{ Str::limit(strip_tags($pengumuman->description), 150) }}</p>
                                                        <div class="mt-auto w-100">

                                                            <ul class="mb-0 px-3 py-3 font_11 fw-bold text-uppercase justify-content-between d-flex border-top" >
                                                                <li>
                                                                    <a href="news_detail.html"><i class="fa fa-user-alt"></i></a>
                                                                    <span class="light_gray ms-2">Admin</span>
                                                                </li>
                                                                <li class="my-auto">
                                                                    @if($pengumuman->file_path)
                                                                        <a class="light_gray m-3" href="{{ route('announcement.detail', $pengumuman->slug) }}"><i
                                                                                class="fa fa-eye me-1"></i> {{ $pengumuman->views }}</a>
                                                                        <a class="light_gray" href="{{ route('announcement.detail', $pengumuman->slug) }}"><i class="fa fa-file-alt me-1"></i></a>
                                                                    @else
                                                                        <a class="light_gray" href="{{ route('announcement.detail', $pengumuman->slug) }}"><i
                                                                                class="fa fa-eye me-1"></i> {{ $pengumuman->views }}</a>
                                                                    @endif
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body p-0">
                                            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 mx-0">
                                                <div class="col p-0">
                                                    <p class="mt-3 px-3 fs-3 mb-0 mb-3">Belum ada data pengumuman.</p>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="mt-4 text-center">
                            {{ $pengumumans->links('layouts.pagination.index') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
