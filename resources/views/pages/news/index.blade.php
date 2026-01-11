@extends('layouts.app')

@section('title', 'Berita')

@push('style')
@endpush

@section('content')

    <section id="contact" class="bg-light">
        <div class="container-fluid p-0">
            <div class="row mx-0">
                <div class="col-md-2 p-0">
                    <div class="footer_bottom_left contact_left text-xl-end p-3 position-relative">
                        <span class="text-white fs-6 fw-bold ms-5">Berita</span>
                    </div>
                </div>
                <div class="col-md-10 p-0">
                    <div class="contact_righto  p-3 bg-white">
                        <span class="mb-0 font_11 light_gray"><a class="fw-bold" href="{{ route('home') }}">Beranda</a> <span class="mx-2">/</span> Berita</span>
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

                        <div class="news_1_left3">
                            @if($beritas && $beritas->isNotEmpty())
                                <div class="row row-cols-1 row-cols-lg-3 row-cols-md-1">
                                @foreach($beritas as $berita)
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-body p-0">
                                                <div class="blog_1 position-relative">
                                                    <div class="blog_1_inner_top">
                                                        {{-- Begin Gambar  --}}
                                                        @if(is_file(public_path('storage/'.$berita->image)))
                                                            <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{  asset('storage/'.$berita->image) }}" class="img-fluid" alt="..."></a>
                                                        @elseif(is_file(public_path($berita->image)))
                                                            <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{  asset($berita->image)  }}" class="img-fluid" alt="..."></a>
                                                        @else
                                                            <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{ asset('image/28.jpg') }}" class="img-fluid" alt="..."></a>
                                                        @endif
                                                        {{-- End Gambar  --}}
                                                    </div>
                                                    <div class="blog_1_inner position-absolute top-0 p-3">
                                                        @if($berita->category_id)
                                                            <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1">{{ $berita->category->name }}</b>
                                                        @endif

                                                    </div>
                                                    <div class="blog_1_inner_1 position-absolute text-end w-100 p-3">
                                                        <ul class="mb-0">

                                                            <li class="d-block fs-6 mt-2"><a class="d-block bg-info text-white  rounded-circle text-center icon_1 icon_2" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.detail', $berita->slug)) }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="blog_2 pt-3 pb-3">
                                                    <span class="light_gray font_12 fw-bold px-3 text-uppercase">{{ $berita->created_at->format('M d, Y') }}</span>
                                                    <b class="d-block fs-5 text-uppercase mt-2 px-3"><a href="{{ route('news.detail', $berita->slug) }}">{{ $berita->title }}</a></b>
                                                    <p class="gray_dark mt-3 px-3  mb-0">{{ Str::limit(strip_tags($berita->content), 150) }}</p>
                                                    <hr>
                                                    <ul class="mb-0 px-3 font_11 fw-bold text-uppercase justify-content-between d-flex">
                                                        <li>
                                                            <a href="{{ route('news.detail', $berita->slug) }}"><i class="fa fa-user"></i></a>
                                                            <span class="light_gray ms-2">Admin</span>
                                                        </li>
                                                        <li class="my-auto">
                                                            <a class="light_gray" href="{{ route('news.detail', $berita->slug) }}"><i
                                                                    class="fa fa-eye me-1"></i> {{ $berita->views }}</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 mx-0">
                                            <div class="col p-0">
                                                <p class="mt-3 px-3 fs-3 mb-0 mb-3">Belum ada data berita.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 text-center">
                            {{ $beritas->links('layouts.pagination.index') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush

