@php
    $currentRoute = request()->route()->getName();

    $menus = \App\Models\Menu::with('children')
        ->whereNull('parent_id')
//        ->where('is_active', true)
        ->orderBy('order')
        ->get();

    // ambil 3 data pertama
@endphp
<section id="header">
    <nav class="navbar navbar-expand-lg navbar-light w-100 justify-content-start">
        <div class="container-xxl mx-3" style="margin-left: 0">
            <a class="d-flex text-white" href="{{ route('home') }}">
                <b class="fs-4  d-block text-uppercase logo bg_black p-2 px-3"> <span>
                <img class="img-fluid m-2" style="width: 8%" src="{{ asset('image/logo_konawe.png')}}" alt="logo"/>
            </span>  PPID Kabupaten Konawe</b>
            </a>
            <button class="navbar-toggler offcanvas-nav-btn  ms-auto me-3" type="button">
                <img src="{{ Vite::asset('resources/style/image/icons-svg/list.svg')}}" width="40" height="40" alt="Open TemplateOnweb website menu"/>
            </button>
            <div class="offcanvas offcanvas-start offcanvas-nav" style="width: 50rem">
                <div class="offcanvas-header shadow">
                    <a class="d-flex text-white" href="{{ route('home') }}">
                        <b class="fs-4  d-block text-uppercase logo"> <img class="me-1" style="width: 8%" src="{{asset('image/logo_konawe.png')}}"/> PPID Kabupaten Konawe</b>
                    </a>
                    <img src="{{ Vite::asset('resources/style/image/icons-svg/x.svg')}}" width="40" height="40" class="ms-auto" data-bs-dismiss="offcanvas" aria-label="Close" alt="Close TemplateOnweb website menu"/>
                </div>
                <div class="offcanvas-body pt-0 align-items-center">
                    <ul class="navbar-nav align-items-lg-center ms-auto">
                        <li class="nav-item">
                            <a style="font-size: 14px" class="nav-link dropdown-toggle {{ $currentRoute == 'home' ? 'active' : '' }}" href="{{ route('home') }}" title="Visit home page">
                                Home
                            </a>
                        </li>
                        @foreach ($menus as $menu)
                            <li class="nav-item {{ $menu->children->count() ? 'dropdown' : '' }} drop_border">
                                <a class="nav-link {{ $menu->children->count() ? 'dropdown-toggle' : '' }} {{ $currentRoute == $menu->type ? 'active' : '' }}"
                                   href="{{ $menu->link }}"
                                   id="navbarDropdown{{ $menu->id }}"
                                      role="button"
                                   aria-expanded="false"
                                   style="font-size: 14px"
                                   @if($menu->children->count()) data-bs-toggle="dropdown" @endif>
                                    {{ strtoupper($menu->name) }} @if($menu->children->count()) <img src="{{ Vite::asset('resources/style/image/icons-svg/chevron-down.svg') }}" width="15" height="15" alt="Submenu open/close icon"> @endif
                                </a>

                                @if($menu->children->count())
                                    <ul class="dropdown-menu drop_1 shadow" aria-labelledby="navbarDropdown{{ $menu->id }}">
                                        @foreach ($menu->children as $child)
                                            <li><a class="dropdown-item" href="{{ $child->link }}">{{ $child->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
        </div>
    </nav>
</section>
