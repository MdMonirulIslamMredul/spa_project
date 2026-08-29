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
                            @if($secrets->first()->secrets_img_l)
                                <img src="{{ asset('backend_img/secrets/' . $secrets->first()->secrets_img_l) }}" alt="Spa Treatment" class="rounded-4 w-100 shadow-lg">
                            @elseif($secrets->first()->secrets_img_r)
                                <img src="{{ asset('backend_img/secrets/' . $secrets->first()->secrets_img_r) }}" alt="Spa Treatment" class="rounded-4 w-100 shadow-lg">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- =========================================================================
         4. Pricing Section
         ========================================================================= -->
    @if(isset($pricings) && count($pricings) > 0)
        <section class="spa-pricing-section">
            <div class="container">
                <div class="spa-section-header text-white">
                    <span class="spa-section-subtitle">Affordable Luxury</span>
                    <h2 class="spa-section-title text-white">Treatment Packages & Pricing</h2>
                    <p class="spa-section-desc">
                        Select from our transparently priced wellness packages or consult with our front desk for custom sessions.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($pricings as $pricing)
                        <div class="col-lg-4 col-md-6">
                            <div class="spa-pricing-card">
                                @if($pricing->image)
                                    <img src="{{ asset('backend_img/pricing/' . $pricing->image) }}" alt="{{ $pricing->title }}" class="spa-pricing-img">
                                @endif
                                <h3 class="spa-pricing-title">{{ $pricing->title }}</h3>
                                <div class="spa-pricing-tag">Special Package</div>
                                <div class="spa-pricing-amount">
                                    {{ $pricing->price }} <span>TK</span>
                                </div>
                                <ul class="spa-pricing-features">
                                    <li><i class="fas fa-check text-warning me-2"></i> Full Body Thai Therapy</li>
                                    <li><i class="fas fa-check text-warning me-2"></i> Herbal Hot Compress</li>
                                    <li><i class="fas fa-check text-warning me-2"></i> Complimentary Herbal Tea</li>
                                    <li><i class="fas fa-check text-warning me-2"></i> Private Suite Experience</li>
                                </ul>
                                <div class="mt-auto">
                                    <a href="tel:{{ get_setting('office_phone') }}" class="spa-btn spa-btn-primary w-100">
                                        <i class="fas fa-phone-alt"></i> Book This Package
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- =========================================================================
         5. Photo Gallery Section
         ========================================================================= -->
    @if(isset($projects) && count($projects) > 0)
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="spa-section-header">
                    <span class="spa-section-subtitle">Atmosphere & Suites</span>
                    <h2 class="spa-section-title">Our Visual Gallery</h2>
                    <p class="spa-section-desc">Take a look inside our serene sanctuary designed for pure peace and renewal.</p>
                </div>

                <div class="spa-gallery-filter">
                    <button class="active" data-filter="*">All Moments</button>
                    @php
                        $categories = $projects->pluck('header_title')->unique();
                    @endphp
                    @foreach ($categories as $cat)
                        @if($cat)
                            <button data-filter=".{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</button>
                        @endif
                    @endforeach
                </div>

                <div class="row g-4 spa-photo-grid">
                    @foreach ($projects as $project)
                        <div class="col-lg-4 col-md-6 spa-photo-item {{ \Illuminate\Support\Str::slug($project->header_title) }}">
                            <div class="spa-photo-card">
                                <img src="{{ asset('/setting/banner/' . $project->image) }}" alt="{{ $project->header_title }}" loading="lazy">
                                <div class="spa-photo-overlay">
                                    <a href="{{ asset('/setting/banner/' . $project->image) }}" class="spa-image-popup text-white fs-3" title="{{ $project->header_title }}">
                                        <i class="fas fa-magnifying-glass-plus"></i>
                                    </a>
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
        <section class="py-5" style="background: var(--spa-light-alt);">
            <div class="container py-4">
                <div class="spa-section-header">
                    <span class="spa-section-subtitle">Experience The Ritual</span>
                    <h2 class="spa-section-title">Video Highlights</h2>
                    <p class="spa-section-desc">Watch our therapists in action and discover the art of Thai body therapy.</p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($videos as $video)
                        <div class="col-lg-6 col-md-6">
                            <div class="spa-video-wrapper">
                                {!! $video->video_url !!}
                            </div>
                            @if($video->video_title)
                                <h4 class="text-center mt-2 fs-5 text-emerald">{{ $video->video_title }}</h4>
                            @endif
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
                                            @if(isset($services))
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                                @endforeach
                                            @endif
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
