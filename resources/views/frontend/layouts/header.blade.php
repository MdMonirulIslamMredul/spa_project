<!-- Topbar -->
<div class="spa-topbar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-5 d-none d-md-block">
                <div class="spa-topbar-social">
                    @if(get_setting('facebook'))
                        <a href="{{ get_setting('facebook') }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(get_setting('twitter'))
                        <a href="{{ get_setting('twitter') }}" target="_blank" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                    @endif
                    @if(get_setting('instagram'))
                        <a href="{{ get_setting('instagram') }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(get_setting('linkedin'))
                        <a href="{{ get_setting('linkedin') }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if(get_setting('youtube'))
                        <a href="{{ get_setting('youtube') }}" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    @endif
                    <span class="ms-2 opacity-75"><i class="far fa-clock me-1"></i> Open Daily: 24/7 Hours</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 text-center text-md-end spa-topbar-info">
                @if(get_setting('office_phone'))
                    <a href="tel:{{ get_setting('office_phone') }}" class="me-3">
                        <i class="fas fa-phone-alt me-1 text-warning"></i> {{ get_setting('office_phone') }}
                    </a>
                @endif
                @if(get_setting('office_email'))
                    <a href="mailto:{{ get_setting('office_email') }}">
                        <i class="fas fa-envelope me-1 text-warning"></i> {{ get_setting('office_email') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Main Sticky Navbar -->
<header class="spa-navbar-wrap">
    <div class="container">
        <nav class="spa-navbar">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="spa-brand-logo">
                @if(get_setting('frontend_logo_menu'))
                    <img src="{{ asset(get_setting('frontend_logo_menu')) }}" alt="{{ get_setting('site_name') ?? 'Thai Spa' }}">
                @else
                    <span class="spa-heading fs-3 text-emerald">THAI SPA</span>
                @endif
            </a>

            <!-- Desktop Menu -->
            <ul class="spa-nav-menu">
                <li class="spa-nav-item">
                    <a href="{{ url('/') }}" class="spa-nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li class="spa-nav-item">
                    <a href="{{ route('about') }}" class="spa-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                </li>
                <li class="spa-nav-item">
                    <a href="javascript:void(0)" class="spa-nav-link">
                        Services <i class="fas fa-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                    </a>
                    <ul class="spa-dropdown">
                        @if(isset($services_all) && count($services_all) > 0)
                            @foreach ($services_all as $service_item)
                                <li>
                                    <a href="{{ route('service.view', $service_item->id) }}">{{ $service_item->title }}</a>
                                </li>
                            @endforeach
                        @elseif(isset($services) && count($services) > 0)
                            @foreach ($services as $service_item)
                                <li>
                                    <a href="{{ route('service.view', $service_item->id) }}">{{ $service_item->title }}</a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="{{ url('/') }}#services">All Services</a></li>
                        @endif
                    </ul>
                </li>
                <li class="spa-nav-item">
                    <a href="javascript:void(0)" class="spa-nav-link">
                        Gallery <i class="fas fa-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                    </a>
                    <ul class="spa-dropdown">
                        <li>
                            <a href="{{ url('/') }}#photo-gallery">
                                <i class="fas fa-images me-2 text-warning"></i> Photo Gallery
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}#video-gallery">
                                <i class="fas fa-video me-2 text-warning"></i> Video Gallery
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="spa-nav-item">
                    <a href="{{ route('blog') }}" class="spa-nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>
                </li>
                <li class="spa-nav-item">
                    <a href="{{ route('contact') }}" class="spa-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                </li>
            </ul>

            <!-- Navbar Right Action & Mobile Button -->
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/') }}#appointment" class="spa-nav-cta d-none d-lg-inline-flex">
                    <i class="fas fa-calendar-check"></i> Book Appointment
                </a>

                <!-- Mobile Hamburger Toggle -->
                <button type="button" class="spa-mobile-toggle" id="spaMobileToggle" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </div>
</header>

<!-- Mobile Offcanvas Drawer -->
<div class="spa-drawer-backdrop" id="spaDrawerBackdrop"></div>
<div class="spa-mobile-drawer" id="spaMobileDrawer">
    <div>
        <div class="spa-drawer-header">
            <a href="{{ url('/') }}" class="spa-brand-logo">
                @if(get_setting('frontend_logo_menu'))
                    <img src="{{ asset(get_setting('frontend_logo_menu')) }}" alt="Logo" style="max-height: 40px;">
                @else
                    <span class="spa-heading fs-4">THAI SPA</span>
                @endif
            </a>
            <button type="button" class="spa-drawer-close" id="spaDrawerClose" aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <ul class="spa-drawer-menu">
            <li>
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                    <span><i class="fas fa-home me-2 text-warning"></i> Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                    <span><i class="fas fa-spa me-2 text-warning"></i> About Us</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="spa-drawer-toggle-sub">
                    <span><i class="fas fa-hand-sparkles me-2 text-warning"></i> Services</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                </a>
                <ul class="spa-drawer-submenu">
                    @if(isset($services_all) && count($services_all) > 0)
                        @foreach ($services_all as $service_item)
                            <li><a href="{{ route('service.view', $service_item->id) }}">{{ $service_item->title }}</a></li>
                        @endforeach
                    @elseif(isset($services) && count($services) > 0)
                        @foreach ($services as $service_item)
                            <li><a href="{{ route('service.view', $service_item->id) }}">{{ $service_item->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="spa-drawer-toggle-sub">
                    <span><i class="fas fa-images me-2 text-warning"></i> Gallery</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                </a>
                <ul class="spa-drawer-submenu">
                    <li>
                        <a href="{{ url('/') }}#photo-gallery" onclick="$('#spaMobileDrawer').removeClass('open'); $('#spaDrawerBackdrop').removeClass('open');">
                            Photo Gallery
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}#video-gallery" onclick="$('#spaMobileDrawer').removeClass('open'); $('#spaDrawerBackdrop').removeClass('open');">
                            Video Gallery
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">
                    <span><i class="fas fa-newspaper me-2 text-warning"></i> Blog</span>
                </a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    <span><i class="fas fa-envelope me-2 text-warning"></i> Contact</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="mt-4 pt-3 border-top border-light">
        <a href="{{ url('/') }}#appointment" class="spa-btn spa-btn-primary w-100 mb-3" onclick="$('#spaMobileDrawer').removeClass('open'); $('#spaDrawerBackdrop').removeClass('open');">
            <i class="fas fa-calendar-alt"></i> Book Appointment
        </a>
        <div class="text-center">
            @if(get_setting('office_phone'))
                <a href="tel:{{ get_setting('office_phone') }}" class="d-block text-dark fw-bold mb-2">
                    <i class="fas fa-phone-alt text-success me-1"></i> {{ get_setting('office_phone') }}
                </a>
            @endif
        </div>
    </div>
</div>
