<footer id="contact" class="bg-dark text-white pt-16 pb-10">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-12 border-b border-slate-700"
        >
            <!-- Logo & Description -->
            <div class="space-y-6 fade-scroll">
                <div class="flex items-center gap-3 group">
                    <div
                        class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm border border-white/20 group-hover:bg-primary/20 transition-soft"
                    >
                        <img
                            src="https://ppid.konawekab.go.id/image/logo_konawe.png"
                            alt="Logo Kabupaten Konawe"
                            class="w-9 h-9 object-contain"
                        />
                    </div>
                    <h4 class="text-xl font-bold italic">
                        PPID <span class="text-primary">KONAWE</span>
                    </h4>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Dinas Komunikasi dan Informatika Kabupaten Konawe, Sulawesi Tenggara. Mewujudkan
                    masyarakat informasi yang cerdas dan berdaya saing melalui keterbukaan informasi
                    publik.
                </p>
                <div class="flex gap-4">
                    <a
                        href="#"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary transition-soft hover-scale"
                    >
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a
                        href="#"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary transition-soft hover-scale"
                    >
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a
                        href="#"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary transition-soft hover-scale"
                    >
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a
                        href="#"
                        class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary transition-soft hover-scale"
                    >
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </div>
            </div>

            <!-- Tentang PPID -->
            <div class="fade-scroll">
                <h5 class="font-bold mb-6 text-lg text-white">TENTANG PPID</h5>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('page.detail', 'profil-singkat-ppid') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-chevron-right text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>Profil PPID
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('page.detail', 'standar-pelayanan-ppid') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-chevron-right text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>Standar Pelayanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('page.detail', 'maklumat-ppid') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-chevron-right text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>Maklumat Pelayanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('page.detail', 'sop-ppid') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-chevron-right text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>SOP Layanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('regulation') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-chevron-right text-xs mr-3 group-hover:translate-x-1 transition-transform"></i>Regulasi Publik
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Layanan Publik -->
            <div class="fade-scroll">
                <h5 class="font-bold mb-6 text-lg text-white">LAYANAN INFORMASI</h5>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('ppid.berkala') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-clock-rotate-left text-xs mr-3 group-hover:scale-110 transition-transform"></i>Informasi Berkala
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ppid.setiap-saat') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-folder-open text-xs mr-3 group-hover:scale-110 transition-transform"></i>Informasi Setiap Saat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ppid.serta-merta') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-bolt text-xs mr-3 group-hover:scale-110 transition-transform"></i>Informasi Serta Merta
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('permohonan.index') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-file-import text-xs mr-3 group-hover:scale-110 transition-transform"></i>Permohonan Informasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-slate-400 hover:text-primary transition-soft inline-flex items-center group">
                            <i class="fa-solid fa-headset text-xs mr-3 group-hover:scale-110 transition-transform"></i>Hubungi Kami (Bantuan)
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="fade-scroll">
                <h5 class="font-bold mb-6 text-lg text-white">KONTAK KAMI</h5>
                <ul class="space-y-4">
                    <li class="flex gap-3 items-start group">
                        <i
                            class="fa-solid fa-location-dot text-primary mt-1 group-hover:scale-110 transition-transform"
                        ></i>
                        <div>
                            <p class="font-medium">Alamat</p>
                            <p class="text-slate-400 text-sm mt-1">
                                Kompleks Perkantoran Pemerintah Kabupaten Konawe, Sulawesi Tenggara
                            </p>
                        </div>
                    </li>
                    <li class="flex gap-3 items-center group">
                        <i
                            class="fa-solid fa-envelope text-primary group-hover:scale-110 transition-transform"
                        ></i>
                        <div>
                            <p class="font-medium">Email</p>
                            <a
                                href="mailto:ppid@konawelkab.go.id"
                                class="text-slate-400 text-sm hover:text-primary transition-soft"
                            >
                                ppid@konawelkab.go.id
                            </a>
                        </div>
                    </li>
                    <li class="flex gap-3 items-center group">
                        <i
                            class="fa-solid fa-phone text-primary group-hover:scale-110 transition-transform"
                        ></i>
                        <div>
                            <p class="font-medium">Telepon</p>
                            <a
                                href="tel:+62408123456"
                                class="text-slate-400 text-sm hover:text-primary transition-soft"
                            >
                                (0408) 123456
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright & Additional Links -->
        <div class="flex flex-col md:flex-row justify-between items-center mt-10 gap-4">
            <p class="text-slate-500 text-sm">
                © 2026 <span class="font-semibold">Diskominfo Kabupaten Konawe</span>. Hak Cipta
                Dilindungi.
            </p>
            <div class="flex gap-6 text-slate-500 text-sm">
                <a href="#kebijakan-privasi" class="hover:text-primary transition-soft hover-border">
                    Kebijakan Privasi
                </a>
                <a href="#syarat-ketentuan" class="hover:text-primary transition-soft hover-border">
                    Syarat & Ketentuan
                </a>
                <a href="#peta-situs" class="hover:text-primary transition-soft hover-border">
                    Peta Situs
                </a>
                <a href="#accessibility" class="hover:text-primary transition-soft hover-border">
                    Aksesibilitas
                </a>
            </div>
        </div>

        <!-- Back to Top Button -->
        <button
            id="back-to-top"
            class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center hover:bg-primary-dark transition-soft z-40 hover-scale hidden"
        >
            <i class="fa-solid fa-arrow-up"></i>
        </button>
    </div>
</footer>
