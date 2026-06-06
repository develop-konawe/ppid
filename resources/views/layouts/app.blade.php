<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PPID Kabupaten Konawe - Portal Informasi Publik Transparan</title>
    <meta
        name="description"
        content="Portal resmi PPID Kabupaten Konawe. Akses informasi publik secara transparan sesuai UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik."
    />
    <meta
        name="keywords"
        content="PPID Konawe, Informasi Publik, Transparansi, Pemerintah Konawe, Keterbukaan Informasi"
    />
    <meta name="author" content="Pemerintah Kabupaten Konawe" />

    <link rel="icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon/android-icon-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="theme-color" content="#ffffff">

    <link rel="canonical" href="{{ request()->url() }}">

    @stack('meta-head')

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />


    <link rel="stylesheet" href="{{ asset('style/fonts/css/brands.min.css') }}">

    @stack('scripts-head')


    <style>
        /* Accessibility Overrides */
        body.acc-high-contrast {
            background-color: #000 !important;
            color: #ff0 !important;
        }
        body.acc-high-contrast * {
            background-color: #000 !important;
            color: #ff0 !important;
            border-color: #ff0 !important;
        }
        body.acc-high-contrast img, body.acc-high-contrast svg {
            filter: contrast(200%) !important;
        }
        
        /* Fix for grayscale breaking position:fixed */
        .grayscale-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            backdrop-filter: grayscale(100%);
            -webkit-backdrop-filter: grayscale(100%);
            pointer-events: none;
            z-index: 55; /* Di bawah accessibility widget (z-60) tapi di atas navbar (z-50) */
            display: none;
        }
        body.acc-grayscale .grayscale-overlay {
            display: block;
        }

        body.acc-underline-links a {
            text-decoration: underline !important;
            text-decoration-thickness: 2px !important;
            text-underline-offset: 4px !important;
        }
        body.acc-readable-font, body.acc-readable-font * {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        /* Custom Styles */
        .glass-nav {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(31, 58, 138, 0.1);
        }

        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Logo Styles */
        .logo-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-glow {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(
                circle,
                rgba(255, 255, 255, 0.126) 0%,
                rgba(255, 255, 255, 0) 70%
            );
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .logo-container:hover .logo-glow {
            opacity: 0.5;
        }

        .logo-konawe {
            filter: drop-shadow(0 4px 8px rgba(31, 58, 138, 0.3));
            transition: all 0.3s ease;
        }

        .logo-container:hover .logo-konawe {
            filter: drop-shadow(0 8px 16px rgba(31, 58, 138, 0.5));
            transform: scale(1.05);
        }

        .gov-badge-modern {
            background: linear-gradient(135deg, #ffffff 0%, #2563eb 100%);
            border: 2px solid rgba(220, 38, 38, 0.3);
            box-shadow: 0 10px 25px -5px rgba(174, 183, 208, 0.4);
            position: relative;
            overflow: hidden;
        }

        .gov-badge-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .badge-indicator {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 14px;
            height: 14px;
            background: #dc2626;
            border: 2px solid white;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        .hover-lift {
            transition: transform 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .hover-glow {
            transition: box-shadow 0.3s ease;
        }

        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(31, 58, 138, 0.3);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .hover-border {
            position: relative;
        }

        .hover-border::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #1f3a8a;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .hover-border:hover::after {
            width: 100%;
        }


        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out;
        }

        *:focus {
            outline: 2px solid #1e3a8a;
            outline-offset: 2px;
        }

        html {
            scroll-behavior: smooth;
        }

        .animate-delay-100 {
            animation-delay: 100ms;
        }

        .animate-delay-200 {
            animation-delay: 200ms;
        }

        .animate-delay-300 {
            animation-delay: 300ms;
        }

        .animate-delay-400 {
            animation-delay: 400ms;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e3a8a;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #172554;
        }

        .gallery-item {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.02);
        }

        #lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #lightbox.active {
            display: flex;
        }

        #lightbox-img {
            max-width: 90%;
            max-height: 80vh;
            object-fit: contain;
            border: 3px solid white;
            border-radius: 8px;
            transition: transform 0.3s ease;
            cursor: zoom-in;
        }

        #lightbox-img.zoomed {
            transform: scale(1.5);
            cursor: zoom-out;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 40px;
            font-size: 40px;
            color: white;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .lightbox-close:hover {
            color: #dc2626;
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            color: white;
            cursor: pointer;
            padding: 20px;
            transition: color 0.3s ease;
            z-index: 10000;
        }

        .lightbox-nav:hover {
            color: #1f3a8a;
        }

        .lightbox-prev {
            left: 20px;
        }

        .lightbox-next {
            right: 20px;
        }

        .lightbox-counter {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 16px;
            background: rgba(0, 0, 0, 0.5);
            padding: 5px 15px;
            border-radius: 20px;
        }

        .lightbox-zoom {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .lightbox-zoom:hover {
            background: #1f3a8a;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-light text-slate-800 antialiased">
<!-- Grayscale Overlay -->
<div class="grayscale-overlay"></div>
<!-- Reading Progress Bar -->
<div class="progress-bar" id="progress-bar"></div>

<!-- Top Bar -->
@include('layouts.part.topbar')
<!-- Header & Navigation -->
@include('layouts.part.header')




    @yield('content')

<!-- Lightbox Modal -->
<div id="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <span class="lightbox-nav lightbox-prev" onclick="changeImage(-1)">&#10094;</span>
    <span class="lightbox-nav lightbox-next" onclick="changeImage(1)">&#10095;</span>
    <img id="lightbox-img" src="" alt="Lightbox Image" onclick="toggleZoom()" />
    <div class="lightbox-counter" id="lightbox-counter">1 / 6</div>
    <button class="lightbox-zoom" onclick="toggleZoom()">
        <i class="fa-solid fa-magnifying-glass-plus"></i> Zoom
    </button>
</div>

<!-- Footer -->
@include('layouts.part.footer')

@stack('back-to-top')

<!-- JavaScript -->
<script>
    // Enhanced Carousel Functionality
    class HeroCarousel {
        constructor() {
            this.slides = document.querySelectorAll('.carousel-slide');
            this.dots = document.querySelectorAll('.carousel-dot');
            this.prevBtn = document.getElementById('carousel-prev');
            this.nextBtn = document.getElementById('carousel-next');
            this.currentSlide = 0;
            this.totalSlides = this.slides.length;
            this.autoPlayInterval = null;
            this.autoPlayDelay = 5000;
            this.isAnimating = false;

            this.init();
        }

        init() {
            this.updateSlideIndicator();
            this.showSlide(this.currentSlide);

            if (this.prevBtn) {
                this.prevBtn.addEventListener('click', () => this.prevSlide());
            }

            if (this.nextBtn) {
                this.nextBtn.addEventListener('click', () => this.nextSlide());
            }

            this.dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    this.goToSlide(index);
                });
            });

            this.startAutoPlay();

            const carousel = document.querySelector('.carousel-container');
            if (carousel) {
                carousel.addEventListener('mouseenter', () => this.pauseAutoPlay());
                carousel.addEventListener('mouseleave', () => this.startAutoPlay());

                let startX = 0;
                carousel.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    this.pauseAutoPlay();
                });

                carousel.addEventListener('touchend', (e) => {
                    const endX = e.changedTouches[0].clientX;
                    const diffX = startX - endX;

                    if (Math.abs(diffX) > 50 && !this.isAnimating) {
                        if (diffX > 0) {
                            this.nextSlide();
                        } else {
                            this.prevSlide();
                        }
                    }

                    setTimeout(() => this.startAutoPlay(), 3000);
                });
            }

            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    this.prevSlide();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    this.nextSlide();
                }
            });
        }

        showSlide(index) {
            this.slides.forEach((slide) => {
                slide.classList.remove('active');
            });

            this.dots.forEach((dot) => {
                dot.classList.remove('active');
            });

            this.slides[index].classList.add('active');
            this.dots[index].classList.add('active');

            this.updateSlideIndicator();
        }

        goToSlide(index) {
            if (this.isAnimating || index === this.currentSlide) return;

            this.isAnimating = true;
            this.currentSlide = index;

            this.showSlide(this.currentSlide);

            setTimeout(() => {
                this.isAnimating = false;
            }, 1000);
        }

        nextSlide() {
            const nextIndex = (this.currentSlide + 1) % this.totalSlides;
            this.goToSlide(nextIndex);
        }

        prevSlide() {
            const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.goToSlide(prevIndex);
        }

        updateSlideIndicator() {
            const currentSlideElement = document.getElementById('current-slide');
            const totalSlidesElement = document.getElementById('total-slides');

            if (currentSlideElement) {
                currentSlideElement.textContent = this.currentSlide + 1;
            }

            if (totalSlidesElement) {
                totalSlidesElement.textContent = this.totalSlides;
            }
        }

        startAutoPlay() {
            this.pauseAutoPlay();
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, this.autoPlayDelay);
        }

        pauseAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
                this.autoPlayInterval = null;
            }
        }
    }

    // Mobile Menu Toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', () => {
            const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
            mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('active');

            const spans = mobileMenuToggle.querySelectorAll('span');
            if (!isExpanded) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }

    if (mobileMenu) {
        mobileMenu.querySelectorAll('a, button').forEach((item) => {
            item.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
                const spans = mobileMenuToggle.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            });
        });
    }

    // Back to Top Button
    const backToTopButton = document.getElementById('back-to-top');

    if (backToTopButton) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('hidden');
                backToTopButton.classList.add('flex');
            } else {
                backToTopButton.classList.remove('flex');
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        });
    }

    // Update current date
    const currentDateElement = document.getElementById('current-date');
    if (currentDateElement) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        currentDateElement.textContent = now.toLocaleDateString('id-ID', options);
    }
</script>

@stack('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- 1. Logika Menu Utama (Buka/Tutup Keseluruhan) ---
        const mobileBtn = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerLines = mobileBtn.querySelectorAll('span');

        mobileBtn.addEventListener('click', function () {
            const isMenuOpen = mobileMenu.classList.contains('opacity-100');

            if (!isMenuOpen) {
                // TAMPILKAN MENU: Hilangkan class yang menyembunyikan, tambahkan animasi
                mobileMenu.classList.remove('opacity-0', 'invisible', '-translate-y-2');
                mobileMenu.classList.add('opacity-100', 'visible', 'translate-y-0');

                // Animasi icon jadi (X)
                hamburgerLines[0].classList.add('rotate-45', 'translate-y-2');
                hamburgerLines[1].classList.add('opacity-0');
                hamburgerLines[2].classList.add('-rotate-45', '-translate-y-2');
            } else {
                // SEMBUNYIKAN MENU
                mobileMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                mobileMenu.classList.add('opacity-0', 'invisible', '-translate-y-2');

                // Animasi icon kembali ke hamburger
                hamburgerLines[0].classList.remove('rotate-45', 'translate-y-2');
                hamburgerLines[1].classList.remove('opacity-0');
                hamburgerLines[2].classList.remove('-rotate-45', '-translate-y-2');

                // Tutup otomatis semua dropdown yang sedang terbuka (opsional tapi disarankan)
                setTimeout(() => {
                    document.querySelectorAll('.mobile-submenu').forEach(sub => {
                        sub.style.maxHeight = null;
                        sub.classList.remove('py-2'); // hilangkan padding
                    });
                    document.querySelectorAll('.mobile-dropdown-toggle i').forEach(icon => {
                        icon.classList.remove('rotate-180');
                    });
                }, 300); // tunggu animasi slide up selesai
            }
        });


        // --- 2. Logika Dropdown Submenu (Accordion) ---
        const dropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        dropdownToggles.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const submenu = this.nextElementSibling;
                const icon = this.querySelector('i');

                // Putar Ikon Panah
                icon.classList.toggle('rotate-180');

                // Animasi Accordion (Buka/Tutup)
                if (submenu.style.maxHeight) {
                    // Jika sudah terbuka, maka tutup
                    submenu.style.maxHeight = null;
                    // Hapus padding agar tidak bersisa ruang kosong
                    setTimeout(() => submenu.classList.remove('py-2'), 300);
                } else {
                    // Tambahkan padding, lalu hitung tinggi scroll agar muncul animasi slide-down
                    submenu.classList.add('py-2');
                    submenu.style.maxHeight = submenu.scrollHeight + 16 + "px"; // +16px untuk mengcover padding
                }
            });
        });
    });
</script>

@include('layouts.part.accessibility')

</body>
</html>
