<div class="news_1_left1 p-3 bg-white border_thick mt-3">
    <div class="news_1_left1_inner row">
        <div class="col-md-12 col-sm-12">
            <div class="news_1_left1_inner_left pt-1">
                <b class="d-block text-uppercase"><i class="fa fa-bullhorn fs-3"></i>  Pengumuman Terbaru</b>
            </div>
        </div>
    </div>
</div>
<div class="news_1_left3 mt-3">
    @if($latestPengumuman && $latestPengumuman->isNotEmpty())
        <div class="row row-cols-2 row-cols-lg-2 row-cols-md-2">
            @foreach($latestPengumuman as $pengumuman)
                    <div class="col mb-4">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="blog_1 position-relative">
                                    @if($pengumuman->image)
                                    <div class="blog_1_inner_top">
                                        {{-- Cek apakah file ada di storage atau di public --}}
                                        {{-- Jika ada di storage, tampilkan dari storage --}}
                                        {{-- Jika ada di public, tampilkan dari public --}}
                                        {{-- Jika tidak ada, tampilkan gambar default --}}
                                        {{-- Begin Gambar  --}}
                                        @if(file_exists(public_path('storage/'.$pengumuman->image)))
                                            <a href="{{ route('news.detail', $pengumuman->slug) }}"><img src="{{ asset('storage/' . $pengumuman->image) }}" class="img-fluid" alt="abc"></a>
                                        @elseif(file_exists(public_path($pengumuman->image)))
                                            <a href="{{ route('news.detail', $pengumuman->slug) }}"><img src="{{  asset($pengumuman->image)  }}" class="img-fluid" alt="..."></a>
                                        @else
                                            <a href="{{ route('news.detail', $pengumuman->slug) }}"><img src="{{ asset('style/image/28.jpg') }}" class="img-fluid" alt="..."></a>
                                        @endif
                                        {{-- End Gambar  --}}
                                    </div>
                                    <div class="blog_1_inner_1 position-absolute text-end w-100 p-3">
                                        <ul class="mb-0">

                                            <li class="d-block fs-6 mt-2"><a
                                                    class="d-block bg-info text-white  rounded-circle text-center icon_1 icon_2"
                                                    href="news_detail.html"><i
                                                        class="fa-brands fa-facebook-f"></i></a></li>
                                            <li class="d-block fs-6 mt-2"><a
                                                    class="d-block bg-danger text-white  rounded-circle text-center icon_1 icon_2"
                                                    href="news_detail.html"><i
                                                        class="fa-brands fa-twitter"></i></a></li>
                                            <li class="d-block fs-6 mt-2"><a
                                                    class="d-block bg-success text-white  rounded-circle text-center icon_1 icon_2"
                                                    href="news_detail.html"><i
                                                        class="fa-brands fa-pinterest-p"></i></a></li>
                                            <li class="d-block fs-6 mt-2"><a
                                                    class="d-block bg_orange text-white  rounded-circle text-center icon_1 icon_2"
                                                    href="news_detail.html"><i
                                                        class="fa-brands fa-instagram"></i></a></li>
                                            <li class="d-block fs-6 mt-2"><a
                                                    class="d-block bg_violet text-white  rounded-circle text-center icon_1"
                                                    href="{{ route('news.detail', $pengumuman->slug) }}"><i class="fa fa-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif


                                </div>
                                <div class="blog_2 pt-3 pb-3">
                                    <div class="blog_1_inner top-0 p-3">
                                        @if($pengumuman->category_id)
                                            <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1">{{ $pengumuman->category->name }}</b>
                                        @endif
                                    </div>
                                    <span class="light_gray font_12 fw-bold px-3 text-uppercase">{{ $pengumuman->published_at->format('M d, Y') }}</span>
                                    <b class="d-block fs-6 text-uppercase mt-2 px-3"><a
                                            href="{{ route('news.detail', $pengumuman->slug) }}">{{ $pengumuman->title }}</a></b>

                                    <hr>
                                    <ul class="mb-0 px-3 font_11 fw-bold text-uppercase justify-content-between d-flex">
                                        <li>
                                            <a href="news_detail.html"><i class="fa fa-user"></i></a>
                                            <span class="light_gray ms-2">Porta Quis</span>
                                        </li>
                                        <li class="my-auto">
                                            <a class="light_gray" href="news_detail.html"><i
                                                    class="fa fa-eye me-1"></i> {{ $pengumuman->views }}</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    @else
        <div class="row row-cols-1 row-cols-lg-1 row-cols-md-1">
            <div class="col mb-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="blog_2">
                            <p class="fs-4 mt-3 px-3 mb-0 pb-4">Belum ada pengumuman terbaru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
