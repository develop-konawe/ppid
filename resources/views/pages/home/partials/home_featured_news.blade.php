<div class="news_1_left1 p-3 bg-white border_thick">
    <div class="news_1_left1_inner row">
        <div class="col-md-3 col-sm-4">
            <div class="news_1_left1_inner_left pt-1">
                <b class="d-block text-uppercase"><i class="fa fa-award fs-3"></i> Kabar Unggulan</b>
            </div>
        </div>
        <div class="col-md-9 col-sm-8">
            <div class="news_1_left1_inner_right">
                <ul class="nav nav-tabs mb-0 fw-bold font_11 border-0 justify-content-end">
                    <li class="nav-item d-inline-block">
                        <a href="#home" data-bs-toggle="tab" aria-expanded="false" class="nav-link active text-center">
                            <span class="d-md-block text-uppercase">Semua</span>
                        </a>
                    </li>
                    @if($beritas->isNotEmpty())
                    <li class="nav-item d-inline-block">
                        <a href="#berita" data-bs-toggle="tab" aria-expanded="true" class="nav-link text-center">
                            <span class="d-md-block text-uppercase">Berita</span>
                        </a>
                    </li>
                    @endif

                    @if($pengumumans && $pengumumans->isNotEmpty())
                        <li class="nav-item d-inline-block">
                            <a href="#pengumuman" data-bs-toggle="tab" aria-expanded="true" class="nav-link border-end-0 text-center">
                                <span class="d-md-block text-uppercase">Pengumuman</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>

<div class="news_1_left2 mt-3">
    <div class="tab-content">
        {{-- All News Tab --}}
        <div class="tab-pane active" id="home">
            <div id="carouselHomeCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @php $jumlahPengumuman = ($pengumumans) ? $pengumumans->count() : 0; @endphp
                    @for($i = 0; $i < ($beritas->count() + $jumlahPengumuman); $i++)
                        <button type="button" data-bs-target="#carouselHomeCaptions" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" aria-label="Slide 1"></button>
                    @endfor

                </div>
                <div class="carousel-inner">
                    @foreach ($beritas as $key => $berita)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="news_1_left2_inner position-relative">
                                <div class="news_1_left2_inner1">
                                    {{-- Begin Gambar  --}}
                                    @if(file_exists(public_path('storage/'.$berita->image)))
                                        <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{ asset('storage/' . $berita->image) }}" class="img-fluid" alt="abc"></a>
                                    @elseif(file_exists(public_path($berita->image)))
                                        <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{  asset($berita->image)  }}" class="img-fluid" alt="..."></a>
                                    @else
                                        <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{ asset('style/image/28.jpg') }}" class="img-fluid" alt="..."></a>
                                    @endif
                                    {{-- End Gambar  --}}
                                </div>
                                <div class="news_1_left2_inner2 position-absolute bottom-0 px-4 bg_back w-100 h-100 top-0">
                                    <ul class="mb-0">
                                        <li class="d-flex">
			   <span class="flex-column">
                   @if($berita->category_id)
                       <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1">{{ $berita->category->name }}</b>
                   @endif
				 <b class="d-block fs-2 text-uppercase mt-2 mb-2"><a class="text-white" href="{{ route('news.detail', $berita->slug) }}">{{ $berita->title }}</a></b>
				 <span class="text-light font_11 fw-bold  text-uppercase"><i class="fa fa-user"></i> Admin - {{ $berita->created_at->format('M d, Y') }}</span>
			   </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($pengumumans as $key => $pengumuman)
                        <div class="carousel-item {{ ($beritas->isEmpty() && $key == 0) ? 'active' : '' }}">
                            <div class="news_1_left2_inner position-relative">
                                <div class="news_1_left2_inner1">
                                    {{-- Begin Gambar  --}}
                                    @if(file_exists(public_path('storage/'.$pengumuman->image)))
                                        <a href="{{ route('announcement.detail', $pengumuman->slug) }}"><img src="{{ asset('storage/' . $pengumuman->image) }}" class="img-fluid" alt="abc"></a>
                                    @elseif(file_exists(public_path($pengumuman->image)))
                                        <a href="{{ route('announcement.detail', $pengumuman->slug) }}"><img src="{{  asset($pengumuman->image)  }}" class="img-fluid" alt="..."></a>
                                    @else
                                        <a href="{{ route('announcement.detail', $pengumuman->slug) }}"><img src="{{ asset('style/image/28.jpg') }}" class="img-fluid" alt="..."></a>
                                    @endif
                                    {{-- End Gambar  --}}
                                </div>
                                <div class="news_1_left2_inner2 position-absolute bottom-0 px-4 bg_back w-100 h-100 top-0">
                                    <ul class="mb-0">
                                        <li class="d-flex">
                                       <span class="flex-column">
                                         <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1">Popular</b>
                                         <b class="d-block fs-2 text-uppercase mt-2 mb-2"><a class="text-white" href="{{ route('announcement.detail', $pengumuman->slug) }}">{{ $pengumuman->title }} </a></b>
                                         <span class="text-light font_11 fw-bold  text-uppercase"><i class="fa fa-user"></i> Admin - {{ $pengumuman->published_at->format('M d, Y') }}</span>
                                       </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- Berita Tab --}}
        @if($beritas && $beritas->count() > 0)
        <div class="tab-pane" id="berita">
            <div id="carouselBeritaCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @for($i = 0; $i < $beritas->count(); $i++)
                        <button type="button" data-bs-target="#carouselBeritaCaptions" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" aria-label="Slide {{ ($i + 1) }}"></button>
                    @endfor
{{--                    <button type="button" data-bs-target="#carouselBeritaCaptions" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>--}}
{{--                    <button type="button" data-bs-target="#carouselBeritaCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>--}}
                </div>
                <div class="carousel-inner">
                    @foreach ($beritas as $key => $berita)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="news_1_left2_inner position-relative">
                                <div class="news_1_left2_inner1">
                                    {{-- Begin Gambar  --}}
                                    @if(file_exists(public_path('storage/'.$berita->image)))
                                        <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{ asset('storage/' . $berita->image) }}" class="img-fluid" alt="abc"></a>
                                    @elseif(file_exists(public_path($berita->image)))
                                        <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{  asset($berita->image)  }}" class="img-fluid" alt="..."></a>
                                    @else
                                        <a href="{{ route('news.detail', $berita->slug) }}"><img src="{{ asset('style/image/28.jpg') }}" class="img-fluid" alt="..."></a>
                                    @endif
                                    {{-- End Gambar  --}}
                                </div>
                                <div class="news_1_left2_inner2 position-absolute bottom-0 px-4 bg_back w-100 h-100 top-0">
                                    <ul class="mb-0">
                                        <li class="d-flex">
			   <span class="flex-column">
			     <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1">Trending</b>
				 <b class="d-block fs-2 text-uppercase mt-2 mb-2"><a class="text-white" href="news_detail.html">{{ $berita->title }}</a></b>
				 <span class="text-light font_11 fw-bold  text-uppercase"><img src="{{ asset('style') }}/image/8.jpg" class="me-2 rounded-circle" alt="abc"> Admin - {{ $berita->created_at->format('M d, Y') }}</span>
			   </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($pengumumans && $pengumumans->count() > 0)
        <div class="tab-pane" id="pengumuman">
            <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide-to="1" aria-label="Slide 2" class="" aria-current="true"></button>
                </div>
                <div class="carousel-inner">
                    @foreach ($pengumumans as $key => $pengumuman)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="news_1_left2_inner position-relative">
                                <div class="news_1_left2_inner1">
                                    <a href="{{ route('news.detail', $pengumuman->slug) }}"><img src="{{ asset('storage/' . $pengumuman->image) }}" class="img-fluid" alt="abc"></a>
                                </div>
                                <div class="news_1_left2_inner2 position-absolute bottom-0 px-4 bg_back w-100 h-100 top-0">
                                    <ul class="mb-0">
                                        <li class="d-flex">
                                           <span class="flex-column">
                                             <b class="d-inline-block bg_yellow text-white p-1 px-3 font_10 text-uppercase rounded-1">Popular</b>
                                             <b class="d-block fs-2 text-uppercase mt-2 mb-2"><a class="text-white" href="news_detail.html">{{ $pengumuman->title }} </a></b>
                                             <span class="text-light font_11 fw-bold  text-uppercase"><img src="{{ asset('style') }}/image/9.jpg" class="me-2 rounded-circle" alt="abc"> Admin - {{ $berita->created_at->format('M d, Y') }}</span>
                                           </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>

</div>
