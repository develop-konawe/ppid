@php use Illuminate\Support\Facades\Storage; @endphp

@push('style')
    <style>
        .ppid-hero-banner {
            position: relative;
            width: auto;
            height: 100vh;
            background-color: #000;
            overflow: hidden;
        }

        .ppid-hero-banner img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
            object-position: center;
            background-color: #000;
        }

        @media (orientation: portrait) {
            .ppid-hero-banner img {
                object-fit: contain; /* tampil utuh dengan ruang hitam kiri-kanan */
                background-color: #000;
            }
        }
    </style>

@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const heroImages = document.querySelectorAll('.ppid-hero-banner img');

            heroImages.forEach(img => {
                img.addEventListener('load', () => {
                    const { naturalWidth, naturalHeight } = img;
                    const isPortrait = naturalHeight > naturalWidth;

                    if (isPortrait) {
                        // Portrait → tinggi penuh, lebar otomatis
                        img.style.height = '100vh';
                        img.style.width = 'auto';
                        img.style.objectFit = 'contain';
                    } else {
                        // Landscape → isi penuh
                        img.style.width = '100%';
                        img.style.height = '100vh';
                        img.style.objectFit = 'cover';
                    }
                });
            });
        });
    </script>


@endpush

<section id="center" class="center_home">
    @if($banners && $banners->isNotEmpty())
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
    {{--       loop banner yang di kirim dari controller home dan buat yang aktif pertama       --}}

                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="3000">
                        <div class="row justify-content-center ppid-hero-banner">
                            @if(Storage::disk('public')->exists($banner->image))
                                <img id="ppid-hero-image" src="{{ asset('storage/' . $banner->image) }}" loading="lazy" class="d-block " alt="{{ $banner->title }}" >
                            @else
                                <img src="{{ asset('image/1.jpg') }}" loading="lazy" class="d-block img-fluid" alt="{{ $banner->title }}">
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    @else
        <div class="m-4">
        <div class="row row-cols-1 row-cols-lg-1 row-cols-md-1">
            <div class="col mb-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="blog_2">
                            <p class="fs-4 mt-3 px-3 mb-0 pb-4">Belum ada banner terbaru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endif
</section>
