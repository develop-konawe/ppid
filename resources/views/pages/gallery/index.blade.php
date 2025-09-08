@extends('layouts.app')

@section('title', 'Galeri')

@push('style')
    <link href="{{ asset('style') }}/css/news.css" rel="stylesheet">
@endpush

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
                <div class="col-md-12">
                    <ul class="mb-0 d-block nav nav-tabs border-0 font_14 justify-content-center d-flex">
                        <li class="d-inline-block me-1 mt-1 mb-1"><a class="border_orange d-block p-3 px-5 pill active" data-bs-toggle="tab" aria-expanded="true" href="#profile1">Business</a></li>
                        <li class="me-1 d-inline-block mt-1 mb-1"><a class="border_orange d-block p-3 px-5" data-bs-toggle="tab" aria-expanded="true" href="#profile2">Entertainment</a></li>

                        <li class="d-inline-block me-1 mt-1 mb-1"><a class="border_orange d-block p-3 px-5" data-bs-toggle="tab" aria-expanded="true" href="#profile3">Travel</a></li>

                        <li class="d-inline-block me-1 mt-1 mb-1"><a class="border_orange d-block p-3 px-5" data-bs-toggle="tab" aria-expanded="true" href="#profile4">Politics</a></li>
                        <li class="d-inline-block me-1 mt-1 mb-1"><a class="border_orange d-block p-3 px-5" data-bs-toggle="tab" aria-expanded="true" href="#profile5">Sports</a></li>

                    </ul>

                    <div class="tab-content  mt-4">
                        <div class="tab-pane active" id="profile1">
                            <div class="content_main">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/31.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block fs-3 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/36.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/37.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/38.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/39.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/40.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/41.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="profile2">
                            <div class="content_main">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/32.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block fs-3 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/42.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/43.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/44.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/45.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/46.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/47.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="profile3">
                            <div class="content_main">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/33.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block fs-3 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/48.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/49.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/50.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/51.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/52.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/53.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="profile4">
                            <div class="content_main">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/34.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block fs-3 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/54.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/55.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/56.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/57.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/58.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/59.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="profile5">
                            <div class="content_main">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/35.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block fs-3 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/60.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/61.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/62.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-3">
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/63.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Incididunt ut labore et dolore <br> magna aliqua Ut enim</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 15, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/64.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Lorem ipsum dolor sit amet, cibo mundi ea duo, vim exerci</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 17, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="video_2 position-relative">
                                            <div class="video_2_inner">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><img src="{{asset('style')}}/image/65.jpg" alt="abc" class="w-100 rounded_10"></a>
                                            </div>
                                            <div class="video_2_inner1 position-absolute bg_back top-0 w-100 h-100 text-center">
                                                <span class="d-block"><a class="d-inline-block  text-white rounded-circle  video_icon text-center fs-5" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#templateVideoModal"><i class="fa fa-play"></i></a></span>
                                                <b><a class="text-white link d-block font_14 text-uppercase mt-3" href="#">Chloe Skelton five-for propels Western Storm to victory</a></b>
                                                <span class="text-light font_11 fw-bold  text-uppercase d-block mt-2"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 19, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade" id="templateVideoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Cricket template Youtube video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- YouTube Embed -->
                    <div class="ratio ratio-16x9">
                        <iframe id="youtubeVideo" src="" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" loading="lazy" allowfullscreen></iframe>
                    </div>


                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        var templateVideoModal = document.getElementById('templateVideoModal');
        templateVideoModal.addEventListener('hide.bs.modal', function () {
            var iframe = document.getElementById('youtubeVideo');
            iframe.src = '';
        });

        templateVideoModal.addEventListener('show.bs.modal', function () {
            var iframe = document.getElementById('youtubeVideo');
            iframe.src = 'https://www.youtube.com/embed/xHYMdZvV1f0?autoplay=1';
        });
    </script>
    <script src="{{ asset('style') }}/js/youtube-player.js"></script>
@endpush

