<div class="news_1_left1 p-3 bg-white border_thick mt-3">
    <div class="news_1_left1_inner row">
        <div class="col-md-12 col-sm-12">
            <div class="news_1_left1_inner_left pt-1">

                <b class="d-block text-uppercase"><i class="fa fa-camera fs-3"></i> Galeri Terbaru</b>
            </div>
        </div>
    </div>
</div>
<div class="news_1_left3 mt-3">
    <div class="row">
        @foreach($gallery as $galeri)
                <a href="{{ asset('storage/' . $galeri->media_path) }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-4 mb-4">
                    <img src="{{ asset('storage/' . $galeri->media_path) }}" class="img-fluid">
                </a>
        @endforeach
    </div>
</div>


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.5/dist/index.bundle.min.js"></script>
@endpush
