@extends('frontend.layouts.app')

@section('title', get_setting('site_name') ?? 'Thai Spa Center - Luxury Massage & Wellness')

@section('content')
    <!-- =========================================================================
         1. Hero Slider Section
         ========================================================================= -->
    <section class="spa-hero-section">
        <div class="spa-hero-slider owl-carousel">
            @if(isset($sliders) && count($sliders) > 0)
                @foreach ($sliders as $slider)
                    <div class="spa-hero-slide" style="background-image: url('{{ asset('/setting/banner/' . $slider->image) }}');">
                        <div class="spa-hero-overlay"></div>
                        <div class="container">
                            <div class="spa-hero-content">
                                <div class="spa-hero-badge">
                                    <i class="fas fa-sparkles text-warning"></i> Luxury Wellness & Spa
                                </div>
                                <h1 class="spa-hero-title">{{ $slider->header_title }}</h1>
                                @if($slider->bottom_title)
                                    <h2 class="spa-hero-subtitle">{{ $slider->bottom_title }}</h2>
                                @endif
                                <p class="spa-hero-text">
                                    Experience the epitome of relaxation with authentic Thai therapies, soothing aromatherapy, and bespoke body treatments performed by master therapists.
                                </p>
                                <div class="spa-hero-actions">
                                    <a href="tel:{{ get_setting('office_phone') }}" class="spa-btn spa-btn-primary">
                                        <i class="fas fa-phone-alt"></i> Call For Booking
                                    </a>
                                    <a href="#services" class="spa-btn spa-btn-outline">
                                        Explore Services <i class="fas fa-arrow-down ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="spa-hero-slide" style="background-image: url('{{ asset('frontend_assets/img/slider/slider-1.jpg') }}');">
                    <div class="spa-hero-overlay"></div>
                    <div class="container">
                        <div class="spa-hero-content">
                            <div class="spa-hero-badge">
                                <i class="fas fa-sparkles text-warning"></i> Luxury Wellness & Spa
                            </div>
                            <h1 class="spa-hero-title">Experience Ultimate Serenity & Rejuvenation</h1>
                            <h2 class="spa-hero-subtitle">Authentic Thai Massage & Wellness Treatments</h2>
                            <p class="spa-hero-text">
                                Step into an oasis of calm designed to revitalize your body, soothe your mind, and restore your natural harmony.
                            </p>
                            <div class="spa-hero-actions">
                                <a href="tel:{{ get_setting('office_phone') }}" class="spa-btn spa-btn-primary">
                                    <i class="fas fa-phone-alt"></i> Call For Booking
                                </a>
                                <a href="{{ route('about') }}" class="spa-btn spa-btn-outline">
                                    About Our Spa <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- =========================================================================
         2. Treatment Packages & Pricing Section (From Services Table)
         ========================================================================= -->
    @php
        $package_items = (isset($services) && count($services) > 0) ? $services : (isset($services_all) && count($services_all) > 0 ? $services_all : []);
    @endphp

    @if(count($package_items) > 0)
        <style>
            /* Treatment Packages High Contrast & Guaranteed Live Server Readability */
            #packages.spa-pricing-section {
                background: radial-gradient(circle at top, #14463b 0%, #081e18 100%) !important;
                padding: 5.5rem 0 !important;
                position: relative !important;
            }
            #packages .spa-section-header .spa-section-subtitle {
                color: #F3E5AB !important;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                font-weight: 700;
            }
            #packages .spa-section-header .spa-section-title {
                color: #FFFFFF !important;
                font-weight: 700;
            }
            #packages .spa-section-header .spa-section-desc {
                color: rgba(255, 255, 255, 0.88) !important;
            }
            #packages .spa-package-card {
                background: linear-gradient(165deg, rgba(20, 58, 48, 0.95) 0%, rgba(8, 26, 20, 0.98) 100%) !important;
                border: 1px solid rgba(212, 175, 55, 0.4) !important;
                border-radius: 20px !important;
                overflow: hidden !important;
                box-shadow: 0 12px 35px rgba(0, 0, 0, 0.45) !important;
                height: 100% !important;
                display: flex !important;
                flex-direction: column !important;
                transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease !important;
            }
            #packages .spa-package-card:hover {
                transform: translateY(-7px) !important;
                border-color: #D4AF37 !important;
                box-shadow: 0 18px 45px rgba(0, 0, 0, 0.55), 0 0 25px rgba(212, 175, 55, 0.3) !important;
            }
            #packages .spa-package-img-wrap {
                position: relative !important;
                height: 220px !important;
                overflow: hidden !important;
                background-color: #081e18 !important;
            }
            #packages .spa-package-img {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
                display: block !important;
                transition: transform 0.6s ease !important;
            }
            #packages .spa-package-card:hover .spa-package-img {
                transform: scale(1.08) !important;
            }
            #packages .spa-package-img-overlay {
                position: absolute !important;
                inset: 0 !important;
                background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(8, 26, 20, 0.85) 100%) !important;
                pointer-events: none !important;
            }
            #packages .spa-package-badge {
                position: absolute !important;
                top: 14px !important;
                left: 14px !important;
                background: rgba(8, 26, 20, 0.9) !important;
                border: 1px solid #D4AF37 !important;
                color: #F3E5AB !important;
                font-size: 0.72rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.06em !important;
                text-transform: uppercase !important;
                padding: 4px 12px !important;
                border-radius: 30px !important;
                z-index: 3 !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.3) !important;
            }
            #packages .spa-package-duration-tag {
                position: absolute !important;
                top: 14px !important;
                right: 14px !important;
                background: rgba(0, 0, 0, 0.75) !important;
                border: 1px solid rgba(255, 255, 255, 0.35) !important;
                color: #ffffff !important;
                font-size: 0.72rem !important;
                font-weight: 600 !important;
                padding: 4px 12px !important;
                border-radius: 30px !important;
                z-index: 3 !important;
            }
            #packages .spa-package-body {
                padding: 1.6rem !important;
                display: flex !important;
                flex-direction: column !important;
                flex-grow: 1 !important;
                color: #ffffff !important;
            }
            #packages .spa-package-title {
                color: #FFFFFF !important;
                font-size: 1.45rem !important;
                font-weight: 700 !important;
                margin-bottom: 0.5rem !important;
                line-height: 1.3 !important;
                font-family: 'Playfair Display', Georgia, serif !important;
                text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
            }
            #packages .spa-package-desc {
                color: rgba(255, 255, 255, 0.88) !important;
                font-size: 0.88rem !important;
                line-height: 1.6 !important;
                margin-bottom: 1.25rem !important;
            }
            #packages .spa-package-price-box {
                background: rgba(212, 175, 55, 0.12) !important;
                border: 1px solid rgba(212, 175, 55, 0.35) !important;
                border-radius: 12px !important;
                padding: 0.85rem 1.1rem !important;
                margin-bottom: 1.25rem !important;
            }
            #packages .spa-package-price-box-header {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                margin-bottom: 0.35rem !important;
            }
            #packages .spa-package-price-label {
                font-size: 0.72rem !important;
                text-transform: uppercase !important;
                letter-spacing: 0.1em !important;
                color: #F3E5AB !important;
                font-weight: 700 !important;
            }
            #packages .spa-package-price-badge {
                font-size: 0.68rem !important;
                background: #D4AF37 !important;
                color: #081e18 !important;
                font-weight: 800 !important;
                padding: 2px 8px !important;
                border-radius: 10px !important;
                text-transform: uppercase !important;
                letter-spacing: 0.05em !important;
            }
            #packages .spa-package-price-val {
                font-size: 1.65rem !important;
                font-weight: 800 !important;
                color: #F8E8B8 !important;
                font-family: 'Playfair Display', Georgia, serif !important;
                line-height: 1.2 !important;
            }
            #packages .spa-package-durations {
                margin-bottom: 1.25rem !important;
            }
            #packages .spa-durations-title {
                font-size: 0.76rem !important;
                text-transform: uppercase !important;
                letter-spacing: 0.07em !important;
                color: #F3E5AB !important;
                font-weight: 700 !important;
                margin-bottom: 0.55rem !important;
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
            }
            #packages .spa-durations-list {
                display: grid !important;
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 8px !important;
            }
            #packages .spa-duration-pill {
                background: rgba(255, 255, 255, 0.08) !important;
                border: 1px solid rgba(212, 175, 55, 0.3) !important;
                border-radius: 8px !important;
                padding: 6px 4px !important;
                text-align: center !important;
                transition: all 0.25s ease !important;
            }
            #packages .spa-duration-pill:hover {
                background: rgba(212, 175, 55, 0.22) !important;
                border-color: #D4AF37 !important;
            }
            #packages .spa-duration-time {
                display: block !important;
                font-size: 0.73rem !important;
                color: #FFFFFF !important;
                font-weight: 600 !important;
                margin-bottom: 2px !important;
            }
            #packages .spa-duration-cost {
                display: block !important;
                font-size: 0.92rem !important;
                font-weight: 800 !important;
                color: #F8E8B8 !important;
            }
            #packages .spa-package-perks {
                list-style: none !important;
                padding: 0 !important;
                margin: 0 0 1.5rem 0 !important;
                flex-grow: 1 !important;
            }
            #packages .spa-package-perks li {
                padding: 7px 0 !important;
                border-bottom: 1px dashed rgba(255, 255, 255, 0.15) !important;
                color: rgba(255, 255, 255, 0.92) !important;
                font-size: 0.86rem !important;
                display: flex !important;
                align-items: center !important;
            }
            #packages .spa-package-perks li i {
                color: #D4AF37 !important;
                margin-right: 10px !important;
                font-size: 0.85rem !important;
                flex-shrink: 0 !important;
            }
            #packages .spa-package-perks li:last-child {
                border-bottom: none !important;
            }
            #packages .spa-package-actions {
                margin-top: auto !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 10px !important;
            }
            #packages .spa-package-actions .spa-btn-primary {
                background: linear-gradient(135deg, #D4AF37 0%, #C5A880 100%) !important;
                color: #081e18 !important;
                font-weight: 800 !important;
                border: none !important;
                border-radius: 30px !important;
                padding: 12px 20px !important;
                font-size: 0.92rem !important;
                text-align: center !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                text-decoration: none !important;
                box-shadow: 0 4px 15px rgba(212, 175, 55, 0.35) !important;
                transition: all 0.3s ease !important;
            }
            #packages .spa-package-actions .spa-btn-primary:hover {
                background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 100%) !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 6px 20px rgba(212, 175, 55, 0.45) !important;
                color: #081e18 !important;
            }
            #packages .spa-package-actions .spa-btn-outline-gold {
                background: transparent !important;
                color: #F3E5AB !important;
                border: 1.5px solid rgba(212, 175, 55, 0.7) !important;
                border-radius: 30px !important;
                padding: 10px 18px !important;
                font-size: 0.88rem !important;
                font-weight: 600 !important;
                text-align: center !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                text-decoration: none !important;
                transition: all 0.25s ease !important;
            }
            #packages .spa-package-actions .spa-btn-outline-gold:hover {
                background: rgba(212, 175, 55, 0.15) !important;
                border-color: #D4AF37 !important;
                color: #FFFFFF !important;
            }
        </style>
        <section class="spa-pricing-section" id="packages">
            <div class="container">
                <div class="spa-section-header text-white text-center">
                    <span class="spa-section-subtitle">Affordable Luxury & Transparency</span>
                    <h2 class="spa-section-title text-white">Wellness & Treatment Packages</h2>
                    <p class="spa-section-desc">
                        Explore our all-inclusive therapy packages with flexible session durations and transparent pricing. Every session is conducted in a private luxury suite with organic aromatherapy.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($package_items as $service_pkg)
                        @php
                            $detailsText = $service_pkg->service_details ?? '';
                            preg_match_all('/(\d+\s*Minutes?)\s*[\—\–\-–\:]\s*([0-9,]+)\s*(?:TK|Tk|৳)?/iu', $detailsText, $matches, PREG_SET_ORDER);
                            $priceTiers = [];
                            $prices = [];
                            foreach ($matches as $m) {
                                $dur = trim($m[1]);
                                $val = trim($m[2]);
                                $numericVal = (int) str_replace(',', '', $val);
                                $priceTiers[] = [
                                    'duration' => $dur,
                                    'price' => $val,
                                    'amount' => $numericVal
                                ];
                                $prices[] = $numericVal;
                            }
                            
                            $minPrice = !empty($prices) ? min($prices) : ($service_pkg->price ?? 0);
                            $maxPrice = !empty($prices) ? max($prices) : ($service_pkg->price ?? 0);
                            $priceRangeFormatted = ($minPrice == $maxPrice || empty($prices)) 
                                ? '৳' . number_format($minPrice) 
                                : '৳' . number_format($minPrice) . ' – ৳' . number_format($maxPrice);
                                
                            $cleanDesc = $service_pkg->description;
                            if (empty($cleanDesc) && !empty($detailsText)) {
                                $parts = preg_split('/Pricing\s*&\s*Duration/iu', $detailsText);
                                $cleanDesc = trim($parts[0] ?? '');
                            }
                            if (empty($cleanDesc)) {
                                $cleanDesc = 'Experience authentic restorative therapy designed to alleviate fatigue, soothe muscular tension, and renew vitality.';
                            }

                            $pkgTitle = $service_pkg->title ?? $service_pkg->service_title ?? 'Spa Treatment Package';
                            $pkgImg = $service_pkg->service_image ? asset('/setting/banner/' . $service_pkg->service_image) : ($service_pkg->ban_img ? asset('/setting/banner/' . $service_pkg->ban_img) : asset('frontend_assets/img/slider/slider-1.jpg'));
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="spa-package-card">
                                <!-- Package Image Banner -->
                                <div class="spa-package-img-wrap">
                                    <img src="{{ $pkgImg }}" alt="{{ $pkgTitle }}" class="spa-package-img" loading="lazy">
                                    <div class="spa-package-img-overlay"></div>
                                    <span class="spa-package-badge"><i class="fas fa-crown text-warning me-1"></i> Signature Package</span>
                                    <span class="spa-package-duration-tag"><i class="far fa-clock me-1"></i> 60 - 120 Mins</span>
                                </div>

                                <!-- Package Body Content -->
                                <div class="spa-package-body">
                                    <h3 class="spa-package-title">{{ $pkgTitle }}</h3>
                                    <p class="spa-package-desc">{{ \Illuminate\Support\Str::limit($cleanDesc, 110) }}</p>

                                    <!-- Price Range Box -->
                                    <div class="spa-package-price-box">
                                        <div class="spa-package-price-box-header">
                                            <span class="spa-package-price-label">Price Range</span>
                                            <span class="spa-package-price-badge">All Inclusive</span>
                                        </div>
                                        <div class="spa-package-price-val">
                                            {{ $priceRangeFormatted }}
                                        </div>
                                    </div>

                                    <!-- Session Durations & Pricing Breakdown -->
                                    @if(count($priceTiers) > 0)
                                        <div class="spa-package-durations">
                                            <div class="spa-durations-title">
                                                <i class="fas fa-stopwatch text-warning"></i> Available Session Durations:
                                            </div>
                                            <div class="spa-durations-list">
                                                @foreach($priceTiers as $tier)
                                                    <div class="spa-duration-pill">
                                                        <span class="spa-duration-time">{{ $tier['duration'] }}</span>
                                                        <span class="spa-duration-cost">৳{{ $tier['price'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Package Perks & Inclusions -->
                                    <ul class="spa-package-perks">
                                        <li><i class="fas fa-check text-warning me-2"></i> Private Suite with Ambient Shower</li>
                                        <li><i class="fas fa-check text-warning me-2"></i> Certified Master Therapist</li>
                                        <li><i class="fas fa-check text-warning me-2"></i> 100% Organic Botanical Essential Oils</li>
                                        <li><i class="fas fa-check text-warning me-2"></i> Complimentary Herbal Tea & Refreshment</li>
                                    </ul>

                                    <!-- Action Buttons -->
                                    <div class="spa-package-actions">
                                        <a href="tel:{{ get_setting('office_phone') }}" class="spa-btn spa-btn-primary w-100">
                                            <i class="fas fa-phone-alt me-2"></i> Book This Package
                                        </a>
                                        <a href="{{ route('service.view', $service_pkg->id) }}" class="spa-btn-outline-gold w-100">
                                            <i class="fas fa-info-circle me-1"></i> View Full Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif



    <!-- =========================================================================
         2. Services Section
         ========================================================================= -->
    <section class="py-5" id="services">
        <div class="container py-4">
            <div class="spa-section-header">
                <span class="spa-section-subtitle">Tailored Therapies</span>
                <h2 class="spa-section-title">Our Signature Spa Services</h2>
                <p class="spa-section-desc">
                    Each ritual is masterfully crafted using natural botanical oils, ancient techniques, and modern wellness practices for complete revitalization.
                </p>
            </div>

            <div class="row g-4">
                @if(isset($services) && count($services) > 0)
                    @foreach ($services->slice(0, 6) as $service)
                        <div class="col-lg-4 col-md-6">
                            <div class="spa-service-card">
                                <div class="spa-service-img-wrap">
                                    <img src="{{ asset('/setting/banner/' . $service->service_image) }}" alt="{{ $service->title }}" loading="lazy">
                                    <span class="spa-service-badge">Premium Treatment</span>
                                </div>
                                <div class="spa-service-body">
                                    <h3 class="spa-service-title">{{ $service->title }}</h3>
                                    <p class="spa-service-desc">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($service->service_details ?? $service->title), 100) }}
                                    </p>
                                    <a href="{{ route('service.view', $service->id) }}" class="spa-service-action">
                                        <span>Discover More</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- =========================================================================
         3. About & Philosophy Section
         ========================================================================= -->
    @if(isset($secrets) && $secrets->count() > 0)
        <section class="spa-about-section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="spa-about-box">
                            <span class="spa-section-subtitle text-start p-0 mb-2">Our Philosophy</span>
                            <h2 class="spa-section-title text-start mb-3">Holistic Healing & Luxury Wellness</h2>
                            <p class="text-muted mb-4 leading-relaxed">
                                {{ $secrets->first()->secrets_des ?? 'We believe that true wellness comes from aligning physical relaxation with inner peace. Our therapists are internationally certified in classical Thai techniques, aromatherapy, and modern body rejuvenation.' }}
                            </p>
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                                    <span class="fw-semibold">100% Organic Essential Oils & Herbal Compresses</span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                                    <span class="fw-semibold">Private, Soundproofed Luxury Treatment Suites</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                                    <span class="fw-semibold">Master Therapists Certified in Traditional Thai Bodywork</span>
                                </li>
                            </ul>
                            <div class="pt-2">
                                <a href="{{ route('about') }}" class="spa-btn spa-btn-emerald">
                                    Learn About Us <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="spa-about-img-box">
                            @php
                                $secret = $secrets->first();
                                $secretImg = null;
                                if ($secret && $secret->secrets_img_l && file_exists(public_path('backend_img/secrets/' . $secret->secrets_img_l))) {
                                    $secretImg = asset('backend_img/secrets/' . $secret->secrets_img_l);
                                } elseif ($secret && $secret->secrets_img_r && file_exists(public_path('backend_img/secrets/' . $secret->secrets_img_r))) {
                                    $secretImg = asset('backend_img/secrets/' . $secret->secrets_img_r);
                                } elseif ($secret && $secret->secrets_img && file_exists(public_path('backend_img/secrets/' . $secret->secrets_img))) {
                                    $secretImg = asset('backend_img/secrets/' . $secret->secrets_img);
                                } else {
                                    $secretImg = asset('backend_img/secrets/spa_philosophy.jpg');
                                }
                            @endphp
                            <img src="{{ $secretImg }}" alt="Spa Treatment Sanctuary" class="rounded-4 w-100 shadow-lg">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <!-- =========================================================================
         5. Photo Gallery Section
         ========================================================================= -->
    @php
        $galleryItems = (isset($images) && count($images) > 0) ? $images : collect();
    @endphp
    @if(isset($galleryItems) && count($galleryItems) > 0)
        <section class="py-5 bg-white" id="photo-gallery">
            <div class="container py-4">
                <div class="spa-section-header">
                    <span class="spa-section-subtitle">Atmosphere & Suites</span>
                    <h2 class="spa-section-title">Our Visual Gallery</h2>
                    <p class="spa-section-desc">Take a look inside our serene sanctuary designed for pure peace and renewal.</p>
                </div>

                <div class="spa-gallery-filter">
                    <button class="active" data-filter="*">All Moments</button>
                    @php
                        $categories = $galleryItems->map(function($item) {
                            return $item->title ?? $item->header_title;
                        })->filter()->unique();
                    @endphp
                    @foreach ($categories as $cat)
                        @if($cat)
                            <button data-filter=".{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</button>
                        @endif
                    @endforeach
                </div>

                <div class="row g-4 spa-photo-grid">
                    @foreach ($galleryItems as $item)
                        @php
                            $itemTitle = $item->title ?? $item->header_title ?? 'Spa Sanctuary';
                            $itemImg = asset('/setting/banner/' . $item->image);
                            $catSlug = \Illuminate\Support\Str::slug($itemTitle);
                        @endphp
                        <div class="col-lg-4 col-md-6 spa-photo-item {{ $catSlug }}">
                            <div class="spa-photo-card">
                                <img src="{{ $itemImg }}" alt="{{ $itemTitle }}" loading="lazy">
                                <div class="spa-photo-caption">
                                    <h5>{{ $itemTitle }}</h5>
                                </div>
                                <div class="spa-photo-overlay text-center">
                                    <a href="{{ $itemImg }}" class="spa-image-popup text-white fs-3 mb-2" title="{{ $itemTitle }}">
                                        <i class="fas fa-magnifying-glass-plus"></i>
                                    </a>
                                    <h5 class="text-white fw-bold mb-1">{{ $itemTitle }}</h5>
                                    <span class="small text-warning text-uppercase"><i class="fas fa-spa me-1"></i> Atmosphere & Suites</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- =========================================================================
         6. Video Gallery Section
         ========================================================================= -->
    @if(isset($videos) && count($videos) > 0)
        <section class="py-5" style="background: var(--spa-light-alt);" id="video-gallery">
            <div class="container py-4">
                <div class="spa-section-header">
                    <span class="spa-section-subtitle">Experience The Ritual</span>
                    <h2 class="spa-section-title">Video Highlights</h2>
                    <p class="spa-section-desc">Watch our therapists in action and discover the art of Thai body therapy.</p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($videos as $video)
                        <div class="col-lg-6 col-md-6">
                            <div class="spa-video-card h-100 d-flex flex-column">
                                <div class="spa-video-wrapper mb-3">
                                    @php
                                        $rawUrl = trim($video->video_url);
                                        if (stripos($rawUrl, '<iframe') !== false) {
                                            $embedHtml = $rawUrl;
                                        } elseif (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $rawUrl, $matches)) {
                                            $embedHtml = '<iframe src="https://www.youtube.com/embed/' . $matches[1] . '" title="' . e(strip_tags($video->video_title)) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                        } else {
                                            $embedHtml = '<iframe src="' . e($rawUrl) . '" title="' . e(strip_tags($video->video_title)) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                        }
                                    @endphp
                                    {!! $embedHtml !!}
                                </div>
                                @if($video->video_title)
                                    <div class="spa-video-info text-center px-2">
                                        <h4 class="fs-5 text-emerald fw-semibold mb-1">{{ strip_tags($video->video_title) }}</h4>
                                        <span class="small text-muted"><i class="fas fa-play-circle text-warning me-1"></i> Watch Treatment Experience</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- =========================================================================
         7. Fun Factory / Stats Section
         ========================================================================= -->
    <section class="spa-stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="spa-stat-card">
                        <i class="fas fa-user-doctor spa-stat-icon"></i>
                        <div class="spa-stat-number">10+</div>
                        <div class="spa-stat-label">Certified Therapists</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="spa-stat-card">
                        <i class="fas fa-heart-pulse spa-stat-icon"></i>
                        <div class="spa-stat-number">4,000+</div>
                        <div class="spa-stat-label">Happy Guests</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="spa-stat-card">
                        <i class="fas fa-award spa-stat-icon"></i>
                        <div class="spa-stat-number">70+</div>
                        <div class="spa-stat-label">Excellence Awards</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="spa-stat-card">
                        <i class="fas fa-spa spa-stat-icon"></i>
                        <div class="spa-stat-number">100+</div>
                        <div class="spa-stat-label">Unique Treatments</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         8. Appointment Booking Section
         ========================================================================= -->
    <section class="spa-booking-section" id="appointment">
        <div class="container">
            <div class="spa-section-header">
                <span class="spa-section-subtitle">Reserve Your Serenity</span>
                <h2 class="spa-section-title">Book An Appointment</h2>
                <p class="spa-section-desc">Schedule your session effortlessly and experience tailored luxury wellness.</p>
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- Location Map -->
                <div class="col-lg-5">
                    <div class="spa-map-container">
                        @if(get_setting('office_map_iframe_url'))
                            {!! get_setting('office_map_iframe_url') !!}
                        @else
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14606.07065977936!2d90.4125!3d23.7937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a0f70deb73%3A0x30c36498fef0d73f!2sGulshan%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1680000000000" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        @endif
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="col-lg-7">
                    <div class="spa-booking-card">
                        <form action="{{ route('appoinment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="send_appointment_form" />
                            
                            <h3 class="spa-heading fs-4 mb-4 text-emerald">Session Details</h3>
                            
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="spa-form-group">
                                        <label for="appointment-service" class="spa-form-label">Preferred Treatment *</label>
                                        <select name="appointment_service" id="appointment-service" class="spa-form-control" required>
                                            <option value="">Select a treatment</option>
                                            @php
                                                $bookingServices = (isset($services_all) && $services_all->count() > 0) ? $services_all : (isset($services) ? $services : collect());
                                            @endphp
                                            @foreach ($bookingServices as $service)
                                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="spa-form-group">
                                        <label for="appointment-date" class="spa-form-label">Appointment Date *</label>
                                        <input type="text" id="appointment-date" class="spa-form-control datepicker" name="appointment_date" placeholder="Select Date" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="spa-form-group">
                                        <label for="appointment-time" class="spa-form-label">Preferred Time Slot *</label>
                                        <select name="appointment_time" id="appointment-time" class="spa-form-control" required>
                                            <option value="">Select Time Slot</option>
                                            <option value="10:00 AM">10:00 AM</option>
                                            <option value="11:00 AM">11:00 AM</option>
                                            <option value="12:00 PM">12:00 PM</option>
                                            <option value="01:00 PM">01:00 PM</option>
                                            <option value="02:00 PM">02:00 PM</option>
                                            <option value="03:00 PM">03:00 PM</option>
                                            <option value="04:00 PM">04:00 PM</option>
                                            <option value="05:00 PM">05:00 PM</option>
                                            <option value="06:00 PM">06:00 PM</option>
                                            <option value="07:00 PM">07:00 PM</option>
                                            <option value="08:00 PM">08:00 PM</option>
                                            <option value="09:00 PM">09:00 PM</option>
                                            <option value="10:00 PM">10:00 PM</option>
                                            <option value="11:00 PM">11:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" style="border-color: var(--spa-border);">

                            <h3 class="spa-heading fs-4 mb-4 text-emerald">Contact Information</h3>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="spa-form-group">
                                        <label for="first-name" class="spa-form-label">Full Name *</label>
                                        <input type="text" name="name" class="spa-form-control" id="first-name" placeholder="Your name..." required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="spa-form-group">
                                        <label for="phone" class="spa-form-label">Phone Number *</label>
                                        <input type="tel" name="number" class="spa-form-control" id="phone" placeholder="Your phone number..." required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="spa-form-group">
                                        <label for="email" class="spa-form-label">Email Address (Optional)</label>
                                        <input type="email" name="email" class="spa-form-control" id="email" placeholder="Your email address...">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="spa-form-group">
                                        <label for="appointment-comment" class="spa-form-label">Special Notes / Preferences</label>
                                        <textarea name="message" class="spa-form-control" rows="3" id="appointment-comment" placeholder="Tell us if you have special focus areas, pressure preference, or health considerations..."></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 pt-2">
                                    <button type="submit" class="spa-btn spa-btn-primary w-100 py-3">
                                        <i class="fas fa-paper-plane"></i> Confirm & Send Reservation
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
