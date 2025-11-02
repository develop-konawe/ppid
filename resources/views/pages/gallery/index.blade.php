@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
    <section id="contact" class="bg-light">
        <div class="container-fluid p-0">
            <div class="row mx-0">
                <div class="col-md-2 p-0">
                    <div class="footer_bottom_left contact_left text-xl-end p-3 position-relative">
                        <span class="text-white fs-6 fw-bold ms-5">Galeri</span>
                    </div>
                </div>
                <div class="col-md-10 p-0">
                    <div class="contact_righto  p-3 bg-white">
                        <span class="mb-0 font_11 light_gray"><a class="fw-bold" href="{{ route('home') }}">Beranda</a> <span class="mx-2">/</span> Galeri</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="vidoes" class="bg-light pt-5 pb-5">
        <div class="container-xl">
            <div class="row video_1">
                @if($gallery && $gallery->isNotEmpty())

                    <div class="col-md-12">

                    <div class="content_main">
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    @foreach($gallery as $item)
                                        <div class="col">
                                            <div class="video_2 position-relative">
                                                <div class="video_2_inner">
                                                    <a href="{{ asset('storage/' . $item->media_path) }}" data-toggle="lightbox" data-gallery="example-gallery" ><img src="{{asset('storage')}}/{{ $item->media_path }}" alt="abc" class="w-100 rounded_10"></a>
                                                </div>
                                                <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                    <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="{{ asset('storage/' . $item->media_path) }}" data-toggle="lightbox" data-gallery="example-gallery"><i class="fa fa-eye"></i></a></span>
                                                    <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="{{ asset('storage/' . $item->media_path) }}" data-toggle="lightbox" data-gallery="example-gallery" >Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                    <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                </div>

                @else
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 mx-0">
                                <div class="col p-0">
                                    <p class="mt-3 px-3 fs-3 mb-0 mb-3">Belum ada data gallery.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="mt-4 text-center">
                        {{ $gallery->links('layouts.pagination.index') }}
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection


