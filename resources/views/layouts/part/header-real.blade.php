<header class="glass-nav sticky top-0 z-50 border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <nav class="py-3 flex justify-between items-center">
            <!-- Logo & Government Title -->
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="logo-container relative">
                        <div
                            class="w-14 h-14 gov-badge-modern rounded-xl flex items-center justify-center shadow-xl hover-lift"
                        >
                            <div class="relative">
                                <img
                                    src="https://ppid.konawekab.go.id/image/logo_konawe.png"
                                    alt="Logo Kabupaten Konawe"
                                    class="w-10 h-10 object-contain logo-konawe"
                                    loading="eager"
                                />
                                <div class="badge-indicator"></div>
                            </div>
                        </div>
                        <div class="logo-glow"></div>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex items-baseline gap-1">
                            <h1 class="text-lg font-black text-dark leading-none tracking-tight">
                                PPID <span class="text-primary">KONAWE</span>
                            </h1>
                            <span
                                class="text-xs font-bold text-secondary px-2 py-0.5 bg-secondary/10 rounded-full border border-secondary/20 animate-pulse-slow"
                            >
                    RESMI
                  </span>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 tracking-widest uppercase">
                            Pejabat Pengelola Informasi dan Dokumentasi
                        </p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <ul class="hidden lg:flex items-center gap-1 font-medium text-sm text-slate-700">
                <li>
                    <a
                        href="{{ route('home') }}"
                        class="px-4 py-3 text-primary border-b-2 border-primary hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block"
                    >
                        HOME
                    </a>
                </li>

                <li class="relative group">
                    <button
                        class="flex items-center gap-1 px-4 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg focus:outline-none"
                    >
                        PROFIL
                        <i
                            class="fa-solid fa-chevron-down text-[10px] transition-transform group-hover:rotate-180"
                        ></i>
                    </button>
                    <div
                        class="absolute left-0 mt-0 w-56 bg-white rounded-b-lg shadow-2xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10"
                    >
                        <a
                            href="#visi-misi"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Visi & Misi
                        </a>
                        <a
                            href="#struktur-organisasi"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Struktur Organisasi
                        </a>
                        <a
                            href="#tugas-fungsi"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Tugas & Fungsi
                        </a>
                        <a
                            href="#maklumat"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Maklumat Pelayanan
                        </a>
                    </div>
                </li>

                <li class="relative group">
                    <button
                        class="flex items-center gap-1 px-4 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg focus:outline-none"
                    >
                        INFORMASI PUBLIK
                        <i
                            class="fa-solid fa-chevron-down text-[10px] transition-transform group-hover:rotate-180"
                        ></i>
                    </button>
                    <div
                        class="absolute left-0 mt-0 w-64 bg-white rounded-b-lg shadow-2xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10"
                    >
                        <a
                            href="{{ route('ppid.berkala') }}"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Informasi Berkala
                        </a>
                        <a
                            href="{{ route('ppid.serta-merta') }}"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Informasi Serta Merta
                        </a>
                        <a
                            href="{{ route('ppid.setiap-saat') }}"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Informasi Setiap Saat
                        </a>
                        <a
                            href="{{ route('ppid.dikecualikan') }}"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm hover-lift"
                        >
                            Informasi Dikecualikan
                        </a>
                        <a
                            href="#dokumen-publik"
                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft text-sm mt-1 pt-2 border-t hover-lift"
                        >
                            Dokumen Publik
                        </a>
                    </div>
                </li>

                <li>
                    <a
                        href="berita.html"
                        class="px-4 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block"
                    >
                        BERITA
                    </a>
                </li>
                <li>
                    <a
                        href="pengumuman.html"
                        class="px-4 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block"
                    >
                        PENGUMUMAN
                    </a>
                </li>
                <li>
                    <a
                        href="regulasi.html"
                        class="px-4 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block"
                    >
                        REGULASI
                    </a>
                </li>
                <li>
                    <a
                        href="#gallery"
                        class="px-4 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block"
                    >
                        GALERI
                    </a>
                </li>
                <li>
                    <a
                        href="kontak.html"
                        class="px-4 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block"
                    >
                        KONTAK
                    </a>
                </li>
            </ul>

            <!-- CTA & Mobile Menu Button -->
            <div class="flex items-center gap-3">
                <!-- Government Title for Mobile -->
                <div class="lg:hidden text-right">
                    <h2 class="text-xs font-black text-primary leading-none tracking-wide">PEMERINTAH</h2>
                    <p class="text-[10px] font-bold text-dark flex items-center justify-end gap-1">
                        KAB. KONAWE
                        <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                    </p>
                </div>

                <button
                    class="hidden md:block bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-200/50 transition-soft transform hover:-translate-y-0.5 hover:shadow-xl ripple-light"
                >
                    <i class="fa-solid fa-file-import mr-2"></i> PERMOHONAN
                </button>

                <!-- Mobile Menu Toggle -->
                <button
                    id="mobile-menu-toggle"
                    class="lg:hidden w-10 h-10 rounded-lg flex flex-col items-center justify-center gap-1.5 focus:outline-none hover-scale"
                    aria-label="Toggle menu"
                >
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden bg-white border-t border-slate-100">
            <div class="py-4 space-y-2">
                <a
                    href="index.html"
                    class="block py-2 px-4 bg-primary-subtle text-primary font-semibold rounded-lg text-sm hover-lift"
                >
                    HOME
                </a>
                <a
                    href="#profil"
                    class="block py-2 px-4 hover:bg-primary-subtle hover:text-primary rounded-lg transition-soft text-sm hover-lift"
                >
                    PROFIL
                </a>
                <a
                    href="informasi"
                    class="block py-2 px-4 hover:bg-primary-subtle hover:text-primary rounded-lg transition-soft text-sm hover-lift"
                >
                    INFORMASI PUBLIK
                </a>
                <a
                    href="berita.html"
                    class="block py-2 px-4 hover:bg-primary-subtle hover:text-primary rounded-lg transition-soft text-sm hover-lift"
                >
                    BERITA
                </a>
                <a
                    href="pengumuman.html"
                    class="block py-2 px-4 hover:bg-primary-subtle hover:text-primary rounded-lg transition-soft text-sm hover-lift"
                >
                    PENGUMUMAN
                </a>
                <a
                    href="regulasi.html"
                    class="block py-2 px-4 hover:bg-primary-subtle hover:text-primary rounded-lg transition-soft text-sm hover-lift"
                >
                    REGULASI
                </a>
                <a
                    href="#gallery"
                    class="block py-2 px-4 hover:bg-primary-subtle hover:text-primary rounded-lg transition-soft text-sm hover-lift"
                >
                    GALERI
                </a>
                <a
                    href="kontak.html"
                    class="block py-2 px-4 hover:bg-primary-subtle hover:text-primary rounded-lg transition-soft text-sm hover-lift"
                >
                    KONTAK
                </a>
                <button
                    class="w-full mt-3 bg-primary text-white py-2.5 rounded-lg font-bold text-sm hover:bg-primary-dark transition-soft ripple-light"
                >
                    <i class="fa-solid fa-file-import mr-2"></i> PERMOHONAN INFORMASI
                </button>
            </div>
        </div>
    </div>
</header>
