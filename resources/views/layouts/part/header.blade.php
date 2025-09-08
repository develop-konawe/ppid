<?php

$currentRoute = request()->route()->getName();

?>
<section id="header">
    <nav class="navbar navbar-expand-lg navbar-light w-100">
        <div class="container-xl mx-3">
            <a class="d-flex text-white" href="{{ route('home') }}">
                <b class="fs-4  d-block text-uppercase logo bg_black p-2 px-3"> <span>
                <img class="img-fluid m-2" style="width: 8%" src="{{asset('image/logo_konawe.png')}}" alt="logo"/>
            </span>  PPID Kabupaten Konawe</b>
            </a>
            <button class="navbar-toggler offcanvas-nav-btn  ms-auto me-3" type="button">
                <img src="{{asset('style')}}/image/icons-svg/list.svg" width="40" height="40" alt="Open TemplateOnweb website menu"/>
            </button>
            <div class="offcanvas offcanvas-start offcanvas-nav" style="width: 50rem">
                <div class="offcanvas-header shadow">
                    <a class="d-flex text-white" href="{{ route('home') }}">
                        <b class="fs-4  d-block text-uppercase logo"> <img class="me-1" style="width: 8%" src="{{asset('image/logo_konawe.png')}}"/> PPID Kabupaten Konawe</b>
                    </a>
                    <img src="{{asset('style')}}/image/icons-svg/x.svg" width="40" height="40" class="ms-auto" data-bs-dismiss="offcanvas" aria-label="Close" alt="Close TemplateOnweb website menu"/>

                </div>
                <div class="offcanvas-body pt-0 align-items-center">
                    <ul class="navbar-nav align-items-lg-center ms-auto">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'home' ? 'active' : '' }}" href="{{ route('home') }}" title="Visit home page">
                                Home
                            </a>
                        </li>

                        <li class="nav-item dropdown drop_border">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'profile' ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil<img src="{{ asset('style/image/icons-svg/chevron-down.svg')}}" width="15" height="15" alt="Submenu open/close icon">
                            </a>
                            <ul class="dropdown-menu drop_1 shadow" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="news.html"> News</a></li>
                                <li><a class="dropdown-item border-0" href="news_detail.html"> News Detail</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown drop_border">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'info' ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Informasi Publik<img src="{{ asset('style/image/icons-svg/chevron-down.svg') }}" width="15" height="15" alt="Submenu open/close icon">
                            </a>
                            <ul class="dropdown-menu drop_1 shadow" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" > Videos</a></li>
                                <li><a class="dropdown-item border-0" href="team.html"> Team</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'news' ? 'active' : '' }}" href="{{ route('news') }}" title="Visit home page">
                                Berita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'announcement' ? 'active' : '' }}" href="{{ route('announcement') }}" title="Visit home page">
                                Pengumuman
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'regulation' ? 'active' : '' }}" href="{{ route('regulation') }}" title="Visit home page">
                                Regulasi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'gallery' ? 'active' : '' }}" href="{{ route('gallery') }}" title="Visit home page">
                                Galeri
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle {{ $currentRoute == 'contact' ? 'active' : '' }}" href="{{ route('contact') }}" title="Visit home page">
                                Kontak
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-lg-center ms-auto social_nav">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle px-3" href="#" title="Visit home page">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle px-3" href="#" title="Visit home page">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle col_yellow px-3" href="#" title="Visit home page">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </nav>
</section>
