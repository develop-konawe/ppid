<div class="news_1_right1 bg-white mt-3 border_light">
    <b class="d-block text-uppercase p-3 border_thick">Berita Populer</b>
    <ul class="mb-0 border-top pt-3">
        @if($popularBeritas && $popularBeritas->isNotEmpty())
            @foreach($popularBeritas as $berita)
            <li class="d-flex border-bottom  pb-3 mb-3">
                <span class="ps-3 align-items-center d-flex">
                    <a href="{{ route('news.detail', $berita->slug) }}">
                        @if(file_exists(public_path('storage/'.$berita->image)))
                            <img width="70"  src="{{ asset('storage/' . $berita->image) }}" alt="abc">
                        @elseif(file_exists(public_path($berita->image)))
                            <img width="70"  src="{{  asset($berita->image)  }}" alt="...">
                        @else
                            <img width="70" alt="abc"  src="{{ asset('style') }}/image/20.jpg">
                        @endif
                    </a>
                </span>

                <span class="flex-column mx-3">
                    @if($berita->category_id)
                        <b class="d-inline-block bg_violet text-white p-1 px-3 font_10 text-uppercase rounded-1">{{ $berita->category->name }}</b>
                    @endif
                    <b class="d-block font_13 text-uppercase mt-1"><a href="{{ route('news.detail', $berita->slug) }}">{{ $berita->title }}</a></b>
                    <span class="light_gray font_10 fw-bold  text-uppercase"> <i class="fa fa-clock me-1 text-warning align-middle"></i> Aug 13, 2016</span>
                </span>
            </li>
            @endforeach
        @else
        @endif
    </ul>
</div>
