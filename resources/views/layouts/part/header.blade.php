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

    /**
     * Build a flat "all nav items" array untuk digunakan oleh Priority Nav JS.
     * Setiap item punya: id, name, link, hasChildren, children[], isActive
     * Item "HOME", "PROFIL", "INFORMASI PUBLIK" ditandai essential = true
     * (selalu dipertahankan paling akhir sebelum dipindah ke overflow).
     */
    $navItems = [];

    // HOME — essential
    $navItems[] = [
        'id'          => '__home',
        'name'        => 'HOME',
        'link'        => route('home'),
        'hasChildren' => false,
        'children'    => [],
        'isActive'    => $currentRoute === 'home',
        'essential'   => true,
    ];

    // PROFIL — essential (has dropdown)
    if ($profilMenu) {
        $profilChildren = [];
        foreach ($profilMenu->children as $ch) {
            $profilChildren[] = ['name' => $ch->name, 'link' => $ch->link];
        }
        $navItems[] = [
            'id'          => '__profil',
            'name'        => strtoupper($profilMenu->name),
            'link'        => $profilMenu->link ?? '#',
            'hasChildren' => $profilMenu->children->count() > 0,
            'children'    => $profilChildren,
            'isActive'    => false,
            'essential'   => true,
        ];
    }

    // INFORMASI PUBLIK — essential (hardcoded dropdown)
    $navItems[] = [
        'id'          => '__infopublik',
        'name'        => 'INFORMASI PUBLIK',
        'link'        => '#',
        'hasChildren' => true,
        'children'    => [
            ['name' => 'Informasi Berkala',      'link' => route('ppid.berkala')],
            ['name' => 'Informasi Serta Merta',  'link' => route('ppid.serta-merta')],
            ['name' => 'Informasi Setiap Saat',  'link' => route('ppid.setiap-saat')],
            ['name' => 'Informasi Dikecualikan', 'link' => route('ppid.dikecualikan')],
        ],
        'isActive'    => false,
        'essential'   => true,
    ];

    // DYNAMIC MENUS — tidak essential (bisa masuk overflow lebih dulu)
    foreach ($otherMenus as $menu) {
        $menuPath   = trim(str_replace(url('/'), '', url($menu->link)), '/');
        $isActive   = $menuPath ? (request()->is($menuPath) || request()->is($menuPath . '/*')) : false;
        $dynChildren = [];
        foreach ($menu->children as $ch) {
            $chPath  = trim(str_replace(url('/'), '', url($ch->link)), '/');
            $dynChildren[] = [
                'name'     => $ch->name,
                'link'     => $ch->link,
                'isActive' => $chPath ? (request()->is($chPath) || request()->is($chPath . '/*')) : false,
            ];
        }
        $navItems[] = [
            'id'          => 'menu_' . $menu->id,
            'name'        => strtoupper($menu->name),
            'link'        => $menu->link,
            'hasChildren' => $menu->children->count() > 0,
            'children'    => $dynChildren,
            'isActive'    => $isActive,
            'essential'   => false,
        ];
    }
@endphp

{{-- ═══════════════════════════════════════════════════════════
     PRIORITY NAVIGATION STYLES (isolated, scoped to #ppid-nav)
═══════════════════════════════════════════════════════════ --}}
<style>
    /* ─── Priority Nav Container ─── */
    #ppid-nav-list {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;       /* SINGLE ROW — no wrap */
        overflow: visible;
        white-space: nowrap;
        gap: 0;
    }

    /* ─── Each nav item ─── */
    .ppid-nav-item {
        flex-shrink: 0;          /* never shrink individual item */
        position: relative;
    }

    /* ─── Nav link base ─── */
    .ppid-nav-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 12px 10px;
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        white-space: nowrap;
        border-radius: 6px 6px 0 0;
        transition: all .25s cubic-bezier(.4,0,.2,1);
        cursor: pointer;
        background: transparent;
        border: none;
        outline: none;
        line-height: 1;
    }
    @media (min-width: 1280px) { .ppid-nav-link { font-size: 13px; padding: 12px 12px; } }
    @media (min-width: 1536px) { .ppid-nav-link { font-size: 14px; } }

    .ppid-nav-link:hover,
    .ppid-nav-link:focus { color: #1F3A8A; background: #eff6ff; }
    .ppid-nav-link.active { color: #1F3A8A; border-bottom: 2px solid #1F3A8A; }

    .ppid-nav-link .ppid-chevron {
        font-size: 9px;
        transition: transform .25s ease;
        flex-shrink: 0;
    }

    /* ─── Dropdown panel ─── */
    .ppid-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 220px;
        background: #fff;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 20px 40px rgba(31,58,138,.15);
        border: 1px solid #e2e8f0;
        border-top: none;
        padding: 6px;
        z-index: 200;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-4px);
        transition: opacity .2s ease, transform .2s ease, visibility .2s;
        pointer-events: none;
    }
    .ppid-nav-item:hover .ppid-dropdown,
    .ppid-nav-item:focus-within .ppid-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        pointer-events: auto;
    }
    .ppid-nav-item:hover .ppid-chevron,
    .ppid-nav-item:focus-within .ppid-chevron { transform: rotate(180deg); }

    .ppid-dropdown a {
        display: block;
        padding: 9px 12px;
        font-size: 13px;
        color: #374151;
        border-radius: 8px;
        transition: all .2s;
        white-space: nowrap;
        text-decoration: none;
    }
    .ppid-dropdown a:hover { background: #eff6ff; color: #1F3A8A; }
    .ppid-dropdown a.active { background: #eff6ff; color: #1F3A8A; font-weight: 600; }

    /* ─── Overflow "Lainnya" button & dropdown ─── */
    #ppid-overflow-btn {
        display: none;        /* hidden until JS decides it's needed */
        flex-shrink: 0;
        position: relative;
    }
    #ppid-overflow-btn.visible { display: block; }

    #ppid-overflow-panel {
        position: absolute;
        top: 100%;
        right: 0;
        min-width: 210px;
        background: #fff;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 20px 40px rgba(31,58,138,.15);
        border: 1px solid #e2e8f0;
        border-top: none;
        padding: 6px;
        z-index: 200;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-4px);
        transition: opacity .2s ease, transform .2s ease, visibility .2s;
        pointer-events: none;
        max-height: 70vh;
        overflow-y: auto;
    }
    #ppid-overflow-btn.open #ppid-overflow-panel {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        pointer-events: auto;
    }
    #ppid-overflow-btn.open #ppid-overflow-trigger .ppid-chevron { transform: rotate(180deg); }

    /* overflow dropdown items */
    #ppid-overflow-panel .ov-item {
        display: block;
        padding: 9px 12px;
        font-size: 13px;
        color: #374151;
        border-radius: 8px;
        transition: all .2s;
        text-decoration: none;
        white-space: normal;
    }
    #ppid-overflow-panel .ov-item:hover { background: #eff6ff; color: #1F3A8A; }
    #ppid-overflow-panel .ov-item.active { background: #eff6ff; color: #1F3A8A; font-weight: 600; }
    #ppid-overflow-panel .ov-section-title {
        font-size: 10px;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: .08em;
        text-transform: uppercase;
        padding: 6px 12px 4px;
        margin-top: 4px;
        border-top: 1px solid #f1f5f9;
    }
    #ppid-overflow-panel .ov-section-title:first-child { border-top: none; margin-top: 0; }

    /* overflow sub-children */
    #ppid-overflow-panel .ov-child {
        display: block;
        padding: 7px 12px 7px 24px;
        font-size: 12px;
        color: #64748b;
        border-radius: 6px;
        transition: all .2s;
        text-decoration: none;
    }
    #ppid-overflow-panel .ov-child:hover { background: #f8fafc; color: #1F3A8A; }

    /* ─── Measurement ghost row (invisible, used to measure widths) ─── */
    #ppid-nav-ghost {
        position: fixed;
        top: -9999px;
        left: -9999px;
        visibility: hidden;
        pointer-events: none;
        display: flex;
        align-items: center;
        white-space: nowrap;
        font-size: 12px;
        font-weight: 600;
    }
    @media (min-width: 1280px) { #ppid-nav-ghost { font-size: 13px; } }
    @media (min-width: 1536px) { #ppid-nav-ghost { font-size: 14px; } }
</style>

{{-- ═══════════════════════════════════════════════════════════
     HEADER
═══════════════════════════════════════════════════════════ --}}
<header class="glass-nav sticky top-0 z-50 border-b border-slate-200/50">
    <div class="max-w-[1640px] mx-auto px-4 md:px-8 xl:px-12">

        {{-- ═══════════════════════════════════════════════════════════
             MOBILE NAVBAR (Hanya tampil di bawah breakpoint lg)
        ═══════════════════════════════════════════════════════════ --}}
        <nav class="lg:hidden flex items-center justify-between w-full py-3 relative">
            {{-- ── LEFT: Logo ── --}}
            <div class="flex items-center justify-start flex-shrink-0 relative z-10">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="logo-container relative">
                        <div class="w-12 h-12 gov-badge-modern rounded-xl flex items-center justify-center shadow-xl hover-lift">
                            <div class="relative">
                                <img
                                    src="{{ asset('image/logo_konawe.png') }}"
                                    alt="Logo Kabupaten Konawe"
                                    class="w-8 h-8 object-contain logo-konawe"
                                    loading="eager"
                                />
                                <div class="badge-indicator"></div>
                            </div>
                        </div>
                        <div class="logo-glow"></div>
                    </div>
                </a>
            </div>

            {{-- ── CENTER: Mobile Title ── --}}
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center text-center pointer-events-none w-max z-0">
                <h1 class="text-sm font-black text-primary leading-none tracking-wide">PEMERINTAH</h1>
                <p class="text-[11px] font-bold text-dark mt-0.5 tracking-tight flex items-center gap-1">
                    KAB. KONAWE
                    <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                </p>
            </div>

            {{-- ── RIGHT: Hamburger ── --}}
            <div class="flex items-center justify-end flex-shrink-0 relative z-10">
                <button
                    id="mobile-menu-toggle"
                    class="w-10 h-10 rounded-lg flex flex-col items-center justify-center gap-1.5 focus:outline-none hover-scale"
                    aria-label="Toggle menu"
                >
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                    <span class="w-6 h-0.5 bg-dark transition-all"></span>
                </button>
            </div>
        </nav>

        {{-- ═══════════════════════════════════════════════════════════
             DESKTOP NAVBAR (Hanya tampil di lg ke atas)
        ═══════════════════════════════════════════════════════════ --}}
        <nav id="ppid-main-nav" class="hidden lg:flex items-center w-full gap-3 xl:gap-5 py-3">

            {{-- ── LEFT: Logo ── --}}
            <div class="flex items-center justify-start flex-shrink-0">
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
                    <div>
                        <div class="flex items-baseline gap-1">
                            <h1 class="text-lg font-black text-dark leading-none tracking-tight">
                                PPID <span class="text-primary">KONAWE</span>
                            </h1>
                            <span class="text-[10px] font-bold text-secondary px-2 py-0.5 bg-secondary/10 rounded-full border border-secondary/20 animate-pulse-slow">
                                RESMI
                            </span>
                        </div>
                        <p class="text-[9px] md:text-[10px] font-bold text-slate-500 tracking-widest uppercase leading-[1.2] mt-0.5">
                            Pejabat Pengelola<br>
                            Informasi dan Dokumentasi
                        </p>
                    </div>
                </a>
            </div>

            {{-- ── CENTER: Priority Nav ── --}}
            <div id="ppid-nav-wrapper" class="flex-1 min-w-0 flex items-center justify-center">

                {{-- Visible menu items — managed by JS --}}
                <ul id="ppid-nav-list" role="menubar" aria-label="Navigasi utama">
                    @foreach($navItems as $item)
                    <li
                        class="ppid-nav-item"
                        data-nav-id="{{ $item['id'] }}"
                        data-essential="{{ $item['essential'] ? '1' : '0' }}"
                        role="none"
                    >
                        @if($item['hasChildren'])
                            {{-- Parent with dropdown --}}
                            <button
                                class="ppid-nav-link {{ $item['isActive'] ? 'active' : '' }}"
                                role="menuitem"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                {{ $item['name'] }}
                                <i class="fa-solid fa-chevron-down ppid-chevron"></i>
                            </button>
                            <div class="ppid-dropdown" role="menu">
                                @foreach($item['children'] as $ch)
                                    <a
                                        href="{{ $ch['link'] }}"
                                        class="{{ isset($ch['isActive']) && $ch['isActive'] ? 'active' : '' }}"
                                        role="menuitem"
                                    >{{ $ch['name'] }}</a>
                                @endforeach
                            </div>
                        @else
                            {{-- Simple link --}}
                            <a
                                href="{{ $item['link'] }}"
                                class="ppid-nav-link {{ $item['isActive'] ? 'active' : '' }}"
                                role="menuitem"
                            >{{ $item['name'] }}</a>
                        @endif
                    </li>
                    @endforeach
                </ul>

                {{-- Overflow "Lainnya" button — shown by JS when needed --}}
                <div id="ppid-overflow-btn" role="none">
                    <button
                        id="ppid-overflow-trigger"
                        class="ppid-nav-link"
                        aria-haspopup="true"
                        aria-expanded="false"
                        role="menuitem"
                    >
                        LAINNYA <i class="fa-solid fa-chevron-down ppid-chevron"></i>
                    </button>
                    <div id="ppid-overflow-panel" role="menu" aria-label="Menu lainnya">
                        {{-- Populated dynamically by JS --}}
                    </div>
                </div>
            </div>

            {{-- ── RIGHT: CTA ── --}}
            <div class="flex items-center justify-end gap-2 xl:gap-3 flex-shrink-0">
                <div class="text-right hidden 2xl:block">
                    <h2 class="text-xs font-black text-primary leading-none tracking-wide">PEMERINTAH</h2>
                    <p class="text-[10px] font-bold text-dark flex items-center justify-end gap-1">
                        KAB. KONAWE
                        <span class="w-1 h-1 bg-green-500 rounded-full animate-pulse"></span>
                    </p>
                </div>

                <a
                    href="{{ url('/permohonan-informasi') }}"
                    class="flex items-center justify-center bg-primary hover:bg-primary-dark text-white px-4 xl:px-5 py-2 xl:py-2.5 rounded-xl font-bold text-[11px] xl:text-[12px] shadow-lg shadow-blue-200/50 transition-soft transform hover:-translate-y-0.5 hover:shadow-xl ripple-light whitespace-nowrap flex-shrink-0"
                    style="flex-shrink:0"
                >
                    <i class="fa-solid fa-file-import mr-1.5"></i> PERMOHONAN
                </a>
            </div>

        </nav>{{-- /nav --}}

        {{-- ── MOBILE MENU ── --}}
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
                        <a href="{{ route('ppid.berkala') }}"     class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Berkala</a>
                        <a href="{{ route('ppid.serta-merta') }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Serta Merta</a>
                        <a href="{{ route('ppid.setiap-saat') }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Setiap Saat</a>
                        <a href="{{ route('ppid.dikecualikan') }}" class="block py-3 pl-10 pr-6 hover:text-primary text-slate-600 text-sm transition-soft border-l-[3px] border-slate-200 hover:border-primary hover:bg-slate-100">Informasi Dikecualikan</a>
                    </div>
                </div>

                {{-- Mobile DYNAMIC MENUS --}}
                @foreach ($otherMenus as $menu)
                    @php
                        $menuPath     = trim(str_replace(url('/'), '', url($menu->link)), '/');
                        $isMenuActive = $menuPath ? request()->is($menuPath) || request()->is($menuPath . '/*') : false;
                    @endphp
                    @if($menu->children->count())
                        <div>
                            <button class="mobile-dropdown-toggle w-full flex items-center justify-between py-3 px-6 hover:bg-primary-subtle {{ $isMenuActive ? 'text-primary bg-primary-subtle border-l-4 border-primary' : 'hover:text-primary border-l-4 border-transparent' }} text-sm font-medium transition-soft focus:outline-none">
                                <span>{{ strtoupper($menu->name) }}</span>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                            </button>
                            <div class="mobile-submenu max-h-0 overflow-hidden bg-slate-50 flex-col transition-all duration-300">
                                @foreach ($menu->children as $child)
                                    @php
                                        $chPath      = trim(str_replace(url('/'), '', url($child->link)), '/');
                                        $isChActive  = $chPath ? request()->is($chPath) || request()->is($chPath . '/*') : false;
                                    @endphp
                                    <a href="{{ $child->link }}" class="block py-3 pl-10 pr-6 hover:text-primary {{ $isChActive ? 'text-primary border-primary bg-slate-100 font-medium' : 'text-slate-600 border-slate-200 hover:border-primary hover:bg-slate-100' }} text-sm transition-soft border-l-[3px]">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->link }}" class="block py-3 px-6 hover:bg-primary-subtle hover:text-primary {{ $isMenuActive ? 'bg-primary-subtle text-primary border-l-4 border-primary font-medium' : 'border-l-4 border-transparent' }} text-sm font-medium transition-soft">
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

{{-- ═══════════════════════════════════════════════════════════
     PRIORITY NAVIGATION — JAVASCRIPT ENGINE
     Isolated: hanya memengaruhi #ppid-main-nav
═══════════════════════════════════════════════════════════ --}}
<script>
(function () {
    'use strict';

    /* ── Config ── */
    const OVERFLOW_BTN_WIDTH = 90;  // px reserved for "Lainnya" button
    const SAFETY_GAP         = 8;   // px extra buffer

    /* ── State ── */
    let itemWidths   = [];   // measured width of each nav item (px)
    let hiddenItems  = [];   // indices currently in overflow

    /* ── DOM refs ── */
    const navWrapper  = document.getElementById('ppid-nav-wrapper');
    const navList     = document.getElementById('ppid-nav-list');
    const overflowBtn = document.getElementById('ppid-overflow-btn');
    const overflowPanel = document.getElementById('ppid-overflow-panel');
    const overflowTrigger = document.getElementById('ppid-overflow-trigger');
    const allNavItems = Array.from(navList.querySelectorAll('.ppid-nav-item'));

    if (!navWrapper || !navList || !overflowBtn) return; // not on desktop

    /* ──────────────────────────────────────
       STEP 1: Measure each item's natural width
       (done once — widths are stable)
    ────────────────────────────────────── */
    function measureItemWidths() {
        itemWidths = allNavItems.map(li => {
            // Ensure it's visible for measurement
            const prevDisplay = li.style.display;
            li.style.visibility = 'hidden';
            li.style.display = '';
            const w = li.getBoundingClientRect().width;
            li.style.visibility = '';
            li.style.display = prevDisplay;
            return Math.ceil(w);
        });
    }

    /* ──────────────────────────────────────
       STEP 2: Get available width for the
       nav list (excluding logo & CTA areas)
    ────────────────────────────────────── */
    function getAvailableWidth() {
        return Math.floor(navWrapper.getBoundingClientRect().width);
    }

    /* ──────────────────────────────────────
       STEP 3: Priority sort
       - essential items → moved last
       - non-essential   → moved first
       Returns array of indices in "move-out priority" order
       (index 0 = first to be moved to overflow)
    ────────────────────────────────────── */
    function getPriorityOrder() {
        const nonEssential = [];
        const essential    = [];

        allNavItems.forEach((li, i) => {
            if (li.dataset.essential === '1') {
                essential.push(i);
            } else {
                nonEssential.push(i);
            }
        });

        // non-essential (from last to first by DOM order) → then essential (from last to first)
        return [...nonEssential.reverse(), ...essential.reverse()];
    }

    /* ──────────────────────────────────────
       STEP 4: Reflow — show/hide items
    ────────────────────────────────────── */
    function reflow() {
        const available    = getAvailableWidth();
        const priorityOrder = getPriorityOrder();

        // Start: show all items, clear overflow
        allNavItems.forEach(li => { li.style.display = ''; });
        hiddenItems = [];

        // Calculate total width of all items
        let totalW = itemWidths.reduce((a, b) => a + b, 0);

        // If everything fits — no overflow button needed
        if (totalW <= available - SAFETY_GAP) {
            overflowBtn.classList.remove('visible');
            return;
        }

        // Otherwise we need the overflow button — reserve its width
        let budget = available - OVERFLOW_BTN_WIDTH - SAFETY_GAP;

        // Keep removing items (lowest priority first) until it fits
        for (const idx of priorityOrder) {
            if (totalW <= budget) break;
            totalW -= itemWidths[idx];
            hiddenItems.push(idx);
            allNavItems[idx].style.display = 'none';
        }

        // Always show overflow button when there are hidden items
        overflowBtn.classList.toggle('visible', hiddenItems.length > 0);

        // Populate overflow panel
        buildOverflowPanel();
    }

    /* ──────────────────────────────────────
       STEP 5: Build overflow panel HTML
       from hidden nav items
    ────────────────────────────────────── */
    function buildOverflowPanel() {
        overflowPanel.innerHTML = '';

        if (hiddenItems.length === 0) return;

        // Sort hidden items by their original DOM order
        const sortedHidden = [...hiddenItems].sort((a, b) => a - b);

        sortedHidden.forEach(idx => {
            const li      = allNavItems[idx];
            const id      = li.dataset.navId;
            const name    = li.querySelector('.ppid-nav-link')?.textContent?.trim() || '';
            const link    = li.querySelector('a.ppid-nav-link')?.getAttribute('href') || '#';
            const isActive = li.querySelector('.active') !== null;
            const dropdown = li.querySelector('.ppid-dropdown');

            if (dropdown) {
                // Section title
                const title = document.createElement('div');
                title.className = 'ov-section-title';
                title.textContent = name.replace(/<[^>]+>/g, '');
                overflowPanel.appendChild(title);

                // Children
                dropdown.querySelectorAll('a').forEach(child => {
                    const a = document.createElement('a');
                    a.href = child.href;
                    a.className = 'ov-child' + (child.classList.contains('active') ? ' active' : '');
                    a.textContent = child.textContent.trim();
                    overflowPanel.appendChild(a);
                });
            } else {
                // Simple link
                const a = document.createElement('a');
                a.href = link;
                a.className = 'ov-item' + (isActive ? ' active' : '');
                a.textContent = name;
                overflowPanel.appendChild(a);
            }
        });
    }

    /* ──────────────────────────────────────
       STEP 6: Overflow toggle click
    ────────────────────────────────────── */
    overflowTrigger.addEventListener('click', function (e) {
        e.stopPropagation();
        overflowBtn.classList.toggle('open');
        const isOpen = overflowBtn.classList.contains('open');
        this.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Close on outside click
    document.addEventListener('click', function (e) {
        if (!overflowBtn.contains(e.target)) {
            overflowBtn.classList.remove('open');
            overflowTrigger.setAttribute('aria-expanded', 'false');
        }
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            overflowBtn.classList.remove('open');
            overflowTrigger.setAttribute('aria-expanded', 'false');
        }
    });

    /* ──────────────────────────────────────
       STEP 7: ResizeObserver — react to
       wrapper size changes automatically
    ────────────────────────────────────── */
    const observer = new ResizeObserver(function () {
        reflow();
    });

    /* ──────────────────────────────────────
       INIT
    ────────────────────────────────────── */
    // Wait for fonts & layout to settle, then measure
    function init() {
        measureItemWidths();
        reflow();
        observer.observe(navWrapper);
    }

    // Use requestAnimationFrame to ensure layout is fully painted
    if (document.readyState === 'complete') {
        requestAnimationFrame(init);
    } else {
        window.addEventListener('load', function () {
            requestAnimationFrame(init);
        });
    }

    // Re-measure on font load (Google Fonts can shift widths slightly)
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(function () {
            measureItemWidths();
            reflow();
        });
    }

})();
</script>
