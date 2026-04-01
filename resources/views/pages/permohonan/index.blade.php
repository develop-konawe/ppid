@extends('layouts.app')

@section('title', 'Permohonan Informasi Publik')

@push('meta-head')
    <meta property="og:title" content="Permohonan Informasi Publik PPID Kabupaten Konawe" />
    <meta property="og:description" content="Formulir permohonan informasi publik secara online di Kabupaten Konawe." />
@endpush

@push('styles')
    <style>
        .contact-hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .transition-soft {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
            border-color: #3b82f6;
        }
    </style>
@endpush

@section('content')
    <main>
        <!-- Hero Section -->
        <section class="contact-hero py-20 md:py-28 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative max-w-7xl mx-auto px-4 text-center text-white z-10">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                    <i class="fa-solid fa-file-signature text-sm"></i>
                    <span class="text-sm font-medium">LAYANAN ONLINE</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4">
                    PERMOHONAN <span class="text-blue-200">INFORMASI PUBLIK</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
                    Formulir pengajuan permintaan informasi publik kepada PPID Kabupaten Konawe sesuai dengan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#F8FAFC">
                    <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
                </svg>
            </div>
        </section>

        <!-- Form Section -->
        <section class="max-w-4xl mx-auto px-4 md:px-8 py-12 -mt-10 relative z-20">
            
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-6 mb-8 shadow-lg flex items-start">
                    <div class="bg-green-500 rounded-full w-10 h-10 flex text-white justify-center items-center flex-shrink-0 mt-1">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-green-800">Permohonan Berhasil Dikirim!</h3>
                        <p class="text-green-700 mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 mb-8 shadow-lg">
                    <div class="flex items-center text-red-800 font-bold mb-2">
                        <i class="fa-solid fa-circle-exclamation mr-2 text-xl text-red-500"></i> Mohon periksa kembali form Anda
                    </div>
                    <ul class="list-disc pl-8 text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-slate-100">
                <div class="mb-10 text-center">
                    <h2 class="text-2xl font-bold text-dark mb-3">Formulir Permohonan</h2>
                    <p class="text-slate-500">Silakan isi formulir di bawah ini dengan lengkap dan benar.</p>
                </div>

                <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <!-- Section 1: Identitas Pemohon -->
                    <div>
                        <h3 class="flex items-center text-lg font-bold text-primary mb-6 pb-2 border-b border-slate-100">
                            <i class="fa-solid fa-user-circle mr-2"></i> Identitas Pemohon
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Kategori Pemohon <span class="text-red-500">*</span></label>
                                <select name="kategori_pemohon" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft text-slate-700">
                                    <option value="Perorangan" {{ old('kategori_pemohon') == 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                                    <option value="Kelompok Orang" {{ old('kategori_pemohon') == 'Kelompok Orang' ? 'selected' : '' }}>Kelompok / Komunitas</option>
                                    <option value="Badan Hukum" {{ old('kategori_pemohon') == 'Badan Hukum' ? 'selected' : '' }}>Badan Hukum / Organisasi</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">NIK / No. Identitas <span class="text-red-500">*</span></label>
                                <input type="number" name="nik_no_identitas" value="{{ old('nik_no_identitas') }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft" placeholder="Masukkan 16 digit NIK">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap Pemohon/Organisasi <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft" placeholder="Nama lengkap sesuai KTP / Dokumen Resmi">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" required rows="3" class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft resize-none" placeholder="Masukkan alamat lengkap (Jalan, RT/RW, Desa, Kec, Kabupaten)">{{ old('alamat') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Email Aktif <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft" placeholder="Contoh: nama@email.com">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                <input type="tel" name="no_telp" value="{{ old('no_telp') }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft" placeholder="Contoh: 08123456789">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft" placeholder="Contoh: Pegawai Negeri / Wiraswasta / Mahasiswa">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Upload KTP / Dokumen Identitas Resmi <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition-soft">
                                    <input type="file" name="foto_ktp" id="foto_ktp" accept="image/jpeg,image/png,image/jpg,image/webp" required class="w-full cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                                    <p class="text-xs text-slate-500 mt-3 pt-2">Format: JPG, JPEG, PNG, WEBP (Maks: 2MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Detail Permohonan -->
                    <div class="mt-8 pt-8 border-t-4 border-slate-50">
                        <h3 class="flex items-center text-lg font-bold text-primary mb-6 pb-2 border-b border-slate-100">
                            <i class="fa-solid fa-file-text mr-2"></i> Rincian Permohonan
                        </h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Rincian Informasi Yang Dibutuhkan <span class="text-red-500">*</span></label>
                                <textarea name="rincian_informasi" required rows="4" class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft resize-none" placeholder="Tuliskan secara ringkas dan padat wujud informasi yang Anda inginkan">{{ old('rincian_informasi') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Tujuan Penggunaan Informasi <span class="text-red-500">*</span></label>
                                <textarea name="tujuan_penggunaan" required rows="4" class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-soft resize-none" placeholder="Jelaskan alasan dan tujuan Anda membutuhkan informasi ini (Contoh: untuk penelitian / skripsi, reportase berita dll)">{{ old('tujuan_penggunaan') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-3">Cara Memperoleh Informasi <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-2">
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="cara_memperoleh" value="Melihat/Membaca/Mendengarkan/Mencatat" required class="w-4 h-4 text-primary" {{ old('cara_memperoleh') == 'Melihat/Membaca/Mendengarkan/Mencatat' ? 'checked' : '' }}>
                                        <span class="text-sm text-slate-700">Melihat / Mencatat</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="cara_memperoleh" value="Mendapatkan Salinan Softcopy" required class="w-4 h-4 text-primary" {{ old('cara_memperoleh', 'Mendapatkan Salinan Softcopy') == 'Mendapatkan Salinan Softcopy' ? 'checked' : '' }}>
                                        <span class="text-sm text-slate-700">Mendapatkan Salinan Soft Copy</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="cara_memperoleh" value="Mendapatkan Salinan Hardcopy" required class="w-4 h-4 text-primary" {{ old('cara_memperoleh') == 'Mendapatkan Salinan Hardcopy' ? 'checked' : '' }}>
                                        <span class="text-sm text-slate-700">Mendapatkan Salinan Hard Copy</span>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-3">Cara Mendapatkan Salinan Informasi <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-2">
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="cara_mendapatkan" value="Mengambil Langsung" required class="w-4 h-4 text-primary" {{ old('cara_mendapatkan') == 'Mengambil Langsung' ? 'checked' : '' }}>
                                        <span class="text-sm text-slate-700">Mengambil Langsung</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="cara_mendapatkan" value="Email" required class="w-4 h-4 text-primary" {{ old('cara_mendapatkan', 'Email') == 'Email' ? 'checked' : '' }}>
                                        <span class="text-sm text-slate-700">Dikirim via Email</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="cara_mendapatkan" value="Kurir/Pos" required class="w-4 h-4 text-primary" {{ old('cara_mendapatkan') == 'Kurir/Pos' ? 'checked' : '' }}>
                                        <span class="text-sm text-slate-700">Dikirim via Pos / Kurir</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50">
                                        <input type="radio" name="cara_mendapatkan" value="Faksimili" required class="w-4 h-4 text-primary" {{ old('cara_mendapatkan') == 'Faksimili' ? 'checked' : '' }}>
                                        <span class="text-sm text-slate-700">Dikirim via Faksimili</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-xl mt-8">
                        <div class="flex items-start">
                            <i class="fa-solid fa-circle-info text-blue-500 mt-1 mr-3 text-lg"></i>
                            <div class="text-sm text-blue-800 leading-relaxed">
                                <p class="font-bold mb-1">Pernyataan Kesesuaian</p>
                                <p>Dengan menekan tombol "Kirim Permohonan" di bawah ini, saya menyatakan bahwa seluruh data yang saya isikan adalah benar dan dapat dipertanggungjawabkan apabila di kemudian hari terdapat kekeliruan, serta saya tunduk pada ketentuan Keterbukaan Informasi Publik yang berlaku.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center pt-6">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-10 rounded-xl transition-soft transform hover:-translate-y-1 hover:shadow-xl inline-flex items-center justify-center gap-3 text-lg w-full md:w-auto min-w-[300px]">
                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim Permohonan
                        </button>
                    </div>

                </form>
            </div>
        </section>
    </main>
@endsection
