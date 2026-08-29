<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', get_setting('site_name') ?? 'Thai Spa Center')</title>
    <meta name="description" content="{{ get_setting('meta_description') ?? 'Luxury Thai Spa & Wellness Center' }}">
    <meta name="keywords" content="spa, thai spa, massage, gulshan spa, wellness, beauty care">
    <meta name="google-site-verification" content="mZW3yJl8cuaEjE0JYWvAh_v-6WF6osNm9TLyIEpPQ8o" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(get_setting('favicon')) }}">

    <!-- Google Fonts: Playfair Display (Serif) + Plus Jakarta Sans (Clean Modern Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/modern-spa.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    @stack('styles')
</head>

<body>
    @include('frontend.layouts.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('status'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('status') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('flash_success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ session('flash_success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <!-- Main Navigation & UI Initialization Script -->
    <script>
        $(document).ready(function() {
            // Mobile Drawer Toggle
            $('#spaMobileToggle, #spaDrawerClose, #spaDrawerBackdrop').on('click', function() {
                $('#spaMobileDrawer').toggleClass('open');
                $('#spaDrawerBackdrop').toggleClass('open');
                $('body').toggleClass('overflow-hidden');
            });

            // Mobile Submenu Toggle
            $('.spa-drawer-toggle-sub').on('click', function(e) {
                e.preventDefault();
                $(this).next('.spa-drawer-submenu').toggleClass('open');
                $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
            });

            // Hero Owl Carousel
            if ($('.spa-hero-slider').length) {
                $('.spa-hero-slider').owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 6000,
                    autoplayHoverPause: true,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    dots: true,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn'
                });
            }

            // Magnific Popup for Gallery
            if ($('.spa-image-popup').length) {
                $('.spa-image-popup').magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });
            }

            // Datepicker initialization
            if ($('.datepicker').length) {
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: '0d',
                    autoclose: true,
                    todayHighlight: true
                });
            }

            // Isotope Filter for Photo Gallery
            if ($('.spa-photo-grid').length) {
                var $grid = $('.spa-photo-grid').isotope({
                    itemSelector: '.spa-photo-item',
                    layoutMode: 'fitRows'
                });

                $('.spa-gallery-filter').on('click', 'a', function(e) {
                    e.preventDefault();
                    var filterValue = $(this).attr('data-filter');
                    $grid.isotope({ filter: filterValue });
                    $('.spa-gallery-filter a').removeClass('selected');
                    $(this).addClass('selected');
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
