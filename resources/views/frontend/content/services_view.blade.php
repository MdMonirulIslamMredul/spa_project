@extends('frontend.layouts.app')

@php
    $service = isset($services) ? $services->first() : null;
    $service_title = $service ? ($service->title ?? $service->service_title) : 'Service Details';
    $raw_phone = preg_replace('/[^0-9]/', '', get_setting('office_phone') ?? '8801736010400');
    if (substr($raw_phone, 0, 2) !== '88' && strlen($raw_phone) == 11) {
        $raw_phone = '88' . $raw_phone;
    }
@endphp

@section('title', $service_title . ' - ' . (get_setting('site_name') ?? 'Thai Spa Center'))

@section('content')
    <!-- =========================================================================
         Inner Hero Banner
         ========================================================================= -->
    <section class="spa-inner-hero" style="background-image: url('{{ $service && $service->ban_img ? asset('setting/banner/' . $service->ban_img) : ($service && $service->service_image ? asset('setting/banner/' . $service->service_image) : asset('frontend_assets/img/slider/slider-1.jpg')) }}');">
        <div class="spa-inner-hero-overlay"></div>
        <div class="container">
            <div class="spa-inner-hero-content">
                <div class="spa-hero-badge mx-auto mb-3">
                    <i class="fas fa-spa text-warning"></i> Signature Thai Therapy
                </div>
                <h1 class="spa-hero-title mb-2">{{ $service_title }}</h1>
                <p class="spa-section-desc text-white opacity-90">
                    {{ $service && $service->ban_title ? $service->ban_title : 'Immerse yourself in authentic Thai healing rituals designed for total relaxation and physical rejuvenation.' }}
                </p>
                <ul class="spa-breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li><span>/</span></li>
                    <li><a href="{{ url('/') }}#services">Services</a></li>
                    <li><span>/</span></li>
                    <li><span class="text-white">{{ $service_title }}</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         Service Details & Sidebar
         ========================================================================= -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-5">
                <!-- Main Content Column -->
                <div class="col-lg-8">
                    @if($service)
                        <div class="spa-service-view-content">
                            <!-- Featured Image (Smooth Rounded Container) -->
                            @if($service->service_image)
                                <div class="spa-service-main-image">
                                    <img id="main-service-img" src="{{ asset('setting/banner/' . $service->service_image) }}" alt="{{ $service_title }}">
                                </div>
                                @php
                                    $gallery_images = array_filter([
                                        $service->service_image,
                                        $service->service_image_2 ?? null,
                                        $service->service_image_3 ?? null,
                                        $service->service_image_4 ?? null,
                                    ]);
                                @endphp
                                @if(count($gallery_images) > 1)
                                    <div class="d-flex gap-2 mt-3 mb-2 overflow-auto pb-1" id="service-gallery-thumbs">
                                        @foreach($gallery_images as $gIdx => $gImg)
                                            <img src="{{ asset('setting/banner/' . $gImg) }}" 
                                                 alt="{{ $service_title }} {{ $gIdx + 1 }}" 
                                                 class="spa-gallery-thumb rounded-3" 
                                                 style="width: 90px; height: 65px; object-fit: cover; cursor: pointer; transition: all 0.25s ease; opacity: {{ $gIdx === 0 ? '1' : '0.6' }}; border: 2px solid {{ $gIdx === 0 ? '#1b4d3e' : '#e2e8f0' }};"
                                                 onclick="document.getElementById('main-service-img').src = this.src; document.querySelectorAll('.spa-gallery-thumb').forEach(el => { el.style.opacity = '0.6'; el.style.borderColor = '#e2e8f0'; }); this.style.opacity = '1'; this.style.borderColor = '#1b4d3e';">
                                        @endforeach
                                    </div>
                                @endif
                            @endif

                            <!-- Meta Attributes Bar -->
                            <div class="spa-service-meta-bar">
                                @if($service->price)
                                    <div class="spa-price-badge-lg">
                                        ৳{{ $service->price }} <span>Starting</span>
                                    </div>
                                @endif
                                <div class="spa-meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>60 / 90 / 120 Mins</span>
                                </div>
                                <div class="spa-meta-item">
                                    <i class="fas fa-certificate text-warning"></i>
                                    <span>Certified Thai Technique</span>
                                </div>
                                <div class="spa-meta-item">
                                    <i class="fas fa-leaf text-success"></i>
                                    <span>100% Organic Oils</span>
                                </div>
                                <div class="spa-meta-item">
                                    <i class="fas fa-door-closed"></i>
                                    <span>Private Suite</span>
                                </div>
                            </div>

                            <!-- Title & Service Overview -->
                            <h2 class="spa-heading fs-2 text-emerald mb-3">{{ $service_title }}</h2>
                            
                            <div class="text-secondary leading-loose fs-6 mb-5" style="line-height: 1.9;">
                                {!! nl2br(e($service->service_details ?? $service->description ?? 'Experience our time-honored traditional therapy, combining acupressure, gentle stretching, and therapeutic touch to restore physical vitality and mental tranquility.')) !!}
                            </div>

                            <!-- The Treatment Ritual Journey (4 Steps with Dedicated Badges) -->
                            <div class="mb-5">
                                <span class="spa-section-subtitle text-start p-0 mb-2">The Sanctuary Ritual</span>
                                <h3 class="spa-heading fs-3 text-emerald mb-3">What to Expect During Your Session</h3>
                                
                                <div class="spa-step-grid">
                                    <div class="spa-step-card">
                                        <div class="spa-step-badge">01</div>
                                        <h5>Welcome & Consultation</h5>
                                        <p>Personalized aroma selection and focus area consultation with herbal welcome tea.</p>
                                    </div>
                                    <div class="spa-step-card">
                                        <div class="spa-step-badge">02</div>
                                        <h5>Foot Cleansing Ritual</h5>
                                        <p>Warm botanical foot soak with Himalayan salts and natural essential oils.</p>
                                    </div>
                                    <div class="spa-step-card">
                                        <div class="spa-step-badge">03</div>
                                        <h5>Signature Therapy</h5>
                                        <p>Targeted pressure point therapy, rhythmic movement, and energy line balancing.</p>
                                    </div>
                                    <div class="spa-step-card">
                                        <div class="spa-step-badge">04</div>
                                        <h5>Post-Session Unwind</h5>
                                        <p>Hot towel compress, peaceful rest in private suite, and refreshing jasmine tea.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Key Benefits Grid -->
                            <div class="mb-5">
                                <span class="spa-section-subtitle text-start p-0 mb-2">Proven Health Benefits</span>
                                <h3 class="spa-heading fs-3 text-emerald mb-4">Why Choose This Treatment</h3>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="spa-benefit-card">
                                            <div class="spa-benefit-icon">
                                                <i class="fas fa-bolt"></i>
                                            </div>
                                            <div>
                                                <h5 class="spa-heading fs-5 mb-1">Deep Muscle Relief</h5>
                                                <p class="text-muted small mb-0">Releases deep chronic tightness, knots, and post-work fatigue across the neck, back, and shoulders.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="spa-benefit-card">
                                            <div class="spa-benefit-icon">
                                                <i class="fas fa-heart-pulse"></i>
                                            </div>
                                            <div>
                                                <h5 class="spa-heading fs-5 mb-1">Enhanced Circulation</h5>
                                                <p class="text-muted small mb-0">Stimulates healthy blood and lymphatic flow, helping eliminate toxins and accelerating recovery.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="spa-benefit-card">
                                            <div class="spa-benefit-icon">
                                                <i class="fas fa-person-walking"></i>
                                            </div>
                                            <div>
                                                <h5 class="spa-heading fs-5 mb-1">Restored Flexibility</h5>
                                                <p class="text-muted small mb-0">Gentle assisted stretches increase joint range of motion and improve posture and mobility.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="spa-benefit-card">
                                            <div class="spa-benefit-icon">
                                                <i class="fas fa-moon"></i>
                                            </div>
                                            <div>
                                                <h5 class="spa-heading fs-5 mb-1">Calm & Restful Sleep</h5>
                                                <p class="text-muted small mb-0">Soothes the central nervous system, reduces stress hormone levels, and promotes restorative sleep.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Included Amenities Checklist -->
                            <div class="p-4 rounded-4 bg-light border mb-5">
                                <h4 class="spa-heading fs-5 text-emerald mb-3">All Treatment Sessions Include:</h4>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-check text-success"></i>
                                            <span class="small fw-semibold text-dark">Private Suite with Temperature & Aroma Control</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-check text-success"></i>
                                            <span class="small fw-semibold text-dark">Organic Massage Oils & Thai Herbal Balms</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-check text-success"></i>
                                            <span class="small fw-semibold text-dark">Freshly Sanitized Luxury Towels & Robes</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-check text-success"></i>
                                            <span class="small fw-semibold text-dark">Complimentary Pre & Post-Session Herbal Tea</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Action Bar -->
                            <div class="p-4 rounded-4 text-white shadow-md d-flex justify-content-between align-items-center flex-wrap gap-3" style="background: var(--spa-primary);">
                                <div>
                                    <h4 class="text-white mb-1">Ready to book this treatment?</h4>
                                    <p class="small text-light opacity-90 mb-0">Book online or call directly for immediate availability.</p>
                                </div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="tel:{{ get_setting('office_phone') }}" class="spa-btn spa-btn-outline">
                                        <i class="fas fa-phone-alt"></i> Call Now
                                    </a>
                                    <a href="{{ url('/') }}#appointment" class="spa-btn spa-btn-primary">
                                        <i class="fas fa-calendar-check"></i> Book Online
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar Column -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <!-- Instant Booking Card -->
                        <div class="p-4 rounded-4 text-white mb-4 shadow-md spa-sidebar-card" style="background: var(--spa-primary-dark); border: 1px solid var(--spa-border-gold);">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-warning text-dark px-3 py-1">Instant Reservation</span>
                                @if($service && $service->price)
                                    <div class="fs-4 fw-bold text-warning">৳{{ $service->price }}</div>
                                @endif
                            </div>
                            <h3 class="spa-heading fs-4 text-white mb-2">Reserve Your Session</h3>
                            <p class="small text-light opacity-85 mb-4">Choose your preferred time slot or contact our front desk directly.</p>
                            
                            <div class="d-grid gap-2 mb-3">
                                <a href="{{ url('/') }}#appointment" class="spa-btn spa-btn-primary w-100">
                                    <i class="fas fa-calendar-alt"></i> Reserve Appointment
                                </a>
                                <a href="https://api.whatsapp.com/send?phone={{ $raw_phone }}&text=Hello!%20I%20would%20like%20to%20book%20the%20{{ urlencode($service_title) }}%20treatment." target="_blank" class="spa-btn w-100 text-white" style="background: #25D366;">
                                    <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                                </a>
                                @if(get_setting('office_phone'))
                                    <a href="tel:{{ get_setting('office_phone') }}" class="spa-btn spa-btn-outline w-100">
                                        <i class="fas fa-phone-alt"></i> {{ get_setting('office_phone') }}
                                    </a>
                                @endif
                            </div>
                            <div class="text-center small text-light opacity-75">
                                <i class="fas fa-lock me-1"></i> No advance payment required for reservation
                            </div>
                        </div>

                        <!-- Other Treatments Menu -->
                        @if(isset($services_all) && count($services_all) > 1)
                            <div class="p-4 rounded-4 bg-light border mb-4 spa-sidebar-card">
                                <h4 class="spa-heading fs-5 text-emerald mb-3">Explore Other Treatments</h4>
                                <div class="spa-sidebar-service-list">
                                    @foreach ($services_all as $other_service)
                                        @if($service && $other_service->id != $service->id)
                                            <a href="{{ route('service.view', $other_service->id) }}" class="spa-sidebar-service-item">
                                                @if($other_service->service_image)
                                                    <img src="{{ asset('setting/banner/' . $other_service->service_image) }}" alt="{{ $other_service->title }}">
                                                @endif
                                                <div class="spa-sidebar-service-info">
                                                    <h6>{{ $other_service->title }}</h6>
                                                    @if($other_service->price)
                                                        <span class="price-tag">৳{{ $other_service->price }}</span>
                                                    @endif
                                                </div>
                                                <i class="fas fa-chevron-right text-muted small ms-auto"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 24/7 Hours Widget -->
                        <div class="p-4 rounded-4 bg-white border shadow-sm spa-sidebar-card">
                            <h4 class="spa-heading fs-5 text-emerald mb-2"><i class="far fa-clock text-warning me-2"></i> Operating Hours</h4>
                            <p class="text-muted small mb-3">We welcome walk-ins and phone reservations 24/7 every day.</p>
                            <div class="d-flex justify-content-between py-2 border-bottom text-dark small fw-semibold">
                                <span>Monday – Sunday</span>
                                <span class="text-success">24/7 Open</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
