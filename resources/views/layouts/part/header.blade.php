@php
    $currentRoute = request()->route()->getName();
    $currentUrl = request()->url();

    $menus = \App\Models\Menu::with('children')
        ->whereNull('parent_id')
//        ->where('is_active', true)
        ->orderBy('order')
        ->get();

    $profilMenu = $menus->firstWhere('id', 1); // ID Profil
    $otherMenus = $menus->whereNotIn('id', [1, 2]); // skip Profil & Informasi Publik
@endphp

<header class="glass-nav sticky top-0 z-50 border-b border-slate-200/50">
    <div class="max-w-[1640px] mx-auto px-4 md:px-8 xl:px-12">

        <nav class="py-3 flex justify-between items-center w-full gap-6 lg:gap-12 xl:gap-20">

            <div class="flex-1 flex items-center justify-start shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="logo-container relative">
                        <div class="w-12 h-12 md:w-14 md:h-14 gov-badge-modern rounded-xl flex items-center justify-center shadow-xl hover-lift">
                            <div class="relative">
                                <img
                                    src="{{ asset('image/logo_konawe.png') }}"
                                    alt="Logo Kabupaten Konawe"
                                    class="w-8 h-8 md:w-10 md:h-10 object-contain logo-konawe"
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
                            <span class="text-[10px] font-bold text-secondary px-2 py-0.5 bg-secondary/10 rounded-full border border-secondary/20 animate-pulse-slow">
                                RESMI
                            </span>
                        </div>
                        <p class="text-[9px] md:text-[10px] font-bold text-slate-500 tracking-widest uppercase">
                            Pejabat Pengelola Informasi dan Dokumentasi
                        </p>
                    </div>
                </a>
            </div>

            <div class="hidden lg:flex justify-center items-center shrink-0">
                <ul class="flex items-center font-medium text-[12px] xl:text-[13px] 2xl:text-sm text-slate-700">
                    {{-- HOME MENU --}}
                    <li>
                        <a
                            href="{{ route('home') }}"
                            class="px-2 xl:px-3 py-3 {{ $currentRoute == 'home' ? 'text-primary border-b-2 border-primary' : 'hover:text-primary' }} hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block whitespace-nowrap"
                        >
                            HOME
                        </a>
                    </li>

                    {{-- PROFIL MENU --}}
                    @if($profilMenu)
                        <li class="relative group">
                            <button class="flex items-center gap-1 px-2 xl:px-3 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg focus:outline-none whitespace-nowrap">
                                {{ strtoupper($profilMenu->name) }}
                                @if($profilMenu->children->count())
                                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform group-hover:rotate-180"></i>
                                @endif
                            </button>

                            @if($profilMenu->children->count())
                                <div class="absolute left-0 mt-0 w-56 bg-white rounded-b-lg shadow-2xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10 text-sm text-left">
                                    @foreach ($profilMenu->children as $child)
                                        <a
                                            href="{{ $child->link }}"
                                            class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft hover-lift"
                                        >
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endif

                    {{-- INFORMASI PUBLIK MENU --}}
                    <li class="relative group">
                        <button class="flex items-center gap-1 px-2 xl:px-3 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg focus:outline-none whitespace-nowrap">
                            INFORMASI PUBLIK
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute left-0 mt-0 w-64 bg-white rounded-b-lg shadow-2xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10 text-sm text-left">
                            <a href="{{ route('ppid.berkala') }}" class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft hover-lift">Informasi Berkala</a>
                            <a href="{{ route('ppid.serta-merta') }}" class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft hover-lift">Informasi Serta Merta</a>
                            <a href="{{ route('ppid.setiap-saat') }}" class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft hover-lift">Informasi Setiap Saat</a>
                            <a href="{{ route('ppid.dikecualikan') }}" class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft hover-lift">Informasi Dikecualikan</a>
                        </div>
                    </li>

                    {{-- DYNAMIC MENUS --}}
                    @foreach ($otherMenus as $menu)
                        <li class="relative group">
                            <a
                                href="{{ $menu->link }}"
                                @if($menu->children->count())
                                    class="flex items-center gap-1 px-2 xl:px-3 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg focus:outline-none whitespace-nowrap"
                                @else
                                    class="px-2 xl:px-3 py-3 hover:text-primary hover:bg-primary-subtle transition-soft rounded-t-lg hover-lift inline-block whitespace-nowrap {{ $currentRoute == $menu->type ? 'text-primary border-b-2 border-primary' : '' }}"
                                @endif
                            >
                                {{ strtoupper($menu->name) }}
                                @if($menu->children->count())
                                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform group-hover:rotate-180"></i>
                                @endif
                            </a>

                            @if($menu->children->count())
                                <div class="absolute left-0 mt-0 w-56 bg-white rounded-b-lg shadow-2xl border border-slate-100 p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10 text-sm text-left">
                                    @foreach ($menu->children as $child)
                                        <a href="{{ $child->link }}" class="block py-2 px-3 hover:bg-primary-subtle rounded-lg hover:text-primary transition-soft hover-lift">
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="flex-1 flex items-center justify-end gap-3 shrink-0">
                <div class="text-right">
                    <h2 class="text-xs font-black text-primary leading-none tracking-wide">PEMERINTAH</h2>
                    <p class="text-[10px] font-bold text-dark flex items-center justify-end gap-1">
                        KAB. KONAWE
                        <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                    </p>
                </div>

                <a href="{{ url('/permohonan-informasi') }}" class="hidden md:flex items-center justify-center bg-primary hover:bg-primary-dark text-white px-4 xl:px-6 py-2 xl:py-2.5 rounded-xl font-bold text-[11px] xl:text-sm shadow-lg shadow-blue-200/50 transition-soft transform hover:-translate-y-0.5 hover:shadow-xl ripple-light whitespace-nowrap">
                    <i class="fa-solid fa-file-import mr-2"></i> PERMOHONAN
                </a>

                <button id="mobile-menu-toggle" class="lg:hidden w-10 h-10 rounded-lg flex flex-col items-center justify-center gap-1.5 focus:outline-none hover-scale" aria-label="Toggle menu">
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                </button>
            </div>

        </nav>

        <div id="mobile-menu" class="lg:hidden absolute top-full left-0 w-full bg-white border-t border-slate-100 shadow-xl opacity-0 invisible -translate-y-2 transition-all duration-300 z-50">
            <div class="max-h-[80vh] overflow-y-auto py-4 space-y-1">
                {{-- Mobile HOME --}}
                <a href="{{ route('home') }}" class="block py-3 px-6 {{ $currentRoute == 'home' ? 'bg-primary-subtle text-primary font-semibold border-l-4 border-primary' : 'hover:bg-primary-subtle hover:text-primary border-l-4 border-transparent' }} text-sm transition-soft">
                    HOME
                </a>

                {{-- Mobile PROFIL --}}
                @if($profilMenu)
                    @if($profilMenu->children->count())
                        <div>
                            <button class="mobile-dropdown-toggle w-full flex items-center justify-between py-3 px-6 hover:bg-primary-subtle hover:text-primary border-l-4 border-transparent text-sm font-medium transition-soft focus:outline-none">
                                <span>{{ strtoupper($profilMenu->name) }}</span>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="mobile-submenu max-h-0 overflow-hidden bg-slate-50 flex-col transition-all duration-300">
                                @foreach ($profilMenu->children as $child)
                                    <a href="{{ $child->link }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $profilMenu->link }}" class="block py-3 px-6 hover:bg-primary-subtle hover:text-primary border-l-4 border-transparent text-sm font-medium transition-soft">
                            {{ strtoupper($profilMenu->name) }}
                        </a>
                    @endif
                @endif

                {{-- Mobile INFORMASI PUBLIK --}}
                <div>
                    <button class="mobile-dropdown-toggle w-full flex items-center justify-between py-3 px-6 hover:bg-primary-subtle hover:text-primary border-l-4 border-transparent text-sm font-medium transition-soft focus:outline-none">
                        <span>INFORMASI PUBLIK</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="mobile-submenu max-h-0 overflow-hidden bg-slate-50 flex-col transition-all duration-300">
                        <a href="{{ route('ppid.berkala') }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Berkala</a>
                        <a href="{{ route('ppid.serta-merta') }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Serta Merta</a>
                        <a href="{{ route('ppid.setiap-saat') }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Setiap Saat</a>
                        <a href="{{ route('ppid.dikecualikan') }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Dikecualikan</a>
                    </div>
                </div>

                {{-- Mobile DYNAMIC MENUS (excluding Profil & Informasi Publik) --}}
                @foreach ($otherMenus as $menu)
                    @if($menu->children->count())
                        <div>
                            <button class="mobile-dropdown-toggle w-full flex items-center justify-between py-3 px-6 hover:bg-primary-subtle hover:text-primary border-l-4 border-transparent text-sm font-medium transition-soft focus:outline-none">
                                <span>{{ strtoupper($menu->name) }}</span>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="mobile-submenu max-h-0 overflow-hidden bg-slate-50 flex-col transition-all duration-300">
                                @foreach ($menu->children as $child)
                                    <a href="{{ $child->link }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->link }}" class="block py-3 px-6 hover:bg-primary-subtle hover:text-primary border-l-4 border-transparent text-sm font-medium transition-soft">
                            {{ strtoupper($menu->name) }}
                        </a>
                    @endif
                @endforeach

                <div class="px-6 pt-6 pb-4">
                    <a href="{{ url('/permohonan-informasi') }}" class="flex items-center justify-center w-full bg-primary text-white py-3.5 rounded-xl font-bold text-sm hover:bg-primary-dark transition-soft shadow-lg">
                        <i class="fa-solid fa-file-import mr-2"></i> PERMOHONAN INFORMASI
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
