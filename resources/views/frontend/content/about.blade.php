@extends('frontend.layouts.app')

@section('title', 'About Us - ' . (get_setting('site_name') ?? 'Thai Spa Center'))

@section('content')
    <!-- Inner Hero Banner -->
    <section class="spa-inner-hero" style="background-image: url('{{ isset($about_banner_imgs) && $about_banner_imgs->first() ? asset('backend_img/about/' . $about_banner_imgs->first()->about_img) : asset('frontend_assets/img/slider/slider-1.jpg') }}');">
        <div class="spa-inner-hero-overlay"></div>
        <div class="container">
            <div class="spa-inner-hero-content">
                <h1 class="spa-hero-title mb-2">About Our Sanctuary</h1>
                <p class="spa-section-desc text-white opacity-75">
                    {{ isset($about_banner_imgs) && $about_banner_imgs->first() ? $about_banner_imgs->first()->about_title : 'Dedicated to providing authentic Thai healing arts and unmatched luxury relaxation.' }}
                </p>
                <ul class="spa-breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li><span>/</span></li>
                    <li><span class="text-white">About Us</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Story & Mission -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="spa-section-subtitle text-start p-0 mb-2">The Art of Serenity</span>
                    <h2 class="spa-heading fs-2 mb-4 text-emerald">Where Ancient Thai Traditions Meet Modern Wellness</h2>
                    <p class="text-muted leading-relaxed mb-3">
                        Founded with a passion for restorative wellness, our spa center offers an exquisite sanctuary from the bustling city. Our certified master therapists are trained in classical Wat Pho Thai massage lineages, deep tissue revitalization, and soothing aromatherapy.
                    </p>
                    <p class="text-muted leading-relaxed mb-4">
                        Every detail of our space—from the calming aroma of lemongrass and jasmine to our custom acoustic soundscapes and private luxury suites—has been curated to transport you into a world of pure tranquility.
                    </p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-3 bg-light border">
                                <h4 class="fs-5 text-emerald mb-1"><i class="fas fa-certificate text-warning me-2"></i> 100% Certified</h4>
                                <p class="small text-muted mb-0">Authentic Thai specialists</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3 bg-light border">
                                <h4 class="fs-5 text-emerald mb-1"><i class="fas fa-leaf text-success me-2"></i> Pure Botanicals</h4>
                                <p class="small text-muted mb-0">Organic essential oils</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="spa-about-img-box">
                        @if(isset($about_banner_imgs) && $about_banner_imgs->first())
                            <img src="{{ asset('backend_img/about/' . $about_banner_imgs->first()->about_img) }}" alt="About Thai Spa" class="rounded-4 w-100 shadow-lg">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    @if(isset($teams) && count($teams) > 0)
        <section class="py-5" style="background: var(--spa-light-alt);">
            <div class="container py-4">
                <div class="spa-section-header">
                    <span class="spa-section-subtitle">Master Practitioners</span>
                    <h2 class="spa-section-title">Meet Our Expert Therapists</h2>
                    <p class="spa-section-desc">
                        Our seasoned specialists bring years of disciplined training and intuitive healing to every session.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($teams as $team)
                        <div class="col-lg-4 col-md-6">
                            <div class="spa-team-card">
                                <div class="spa-team-img-wrap">
                                    <img src="{{ asset('backend_img/about/' . $team->team_img) }}" alt="{{ $team->name }}" loading="lazy">
                                </div>
                                <div class="spa-team-info">
                                    <h3 class="spa-team-name">{{ $team->name }}</h3>
                                    <div class="spa-team-role">{{ $team->position }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Working Hours Schedule Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="spa-section-subtitle text-start p-0 mb-2">Always Here For You</span>
                    <h2 class="spa-heading fs-2 mb-3 text-emerald">Operating Hours & Availability</h2>
                    <p class="text-muted mb-4">
                        We maintain flexible scheduling and round-the-clock availability so you can unwind whenever your schedule permits.
                    </p>
                    <a href="{{ url('/') }}#appointment" class="spa-btn spa-btn-primary">
                        <i class="fas fa-calendar-check"></i> Book Your Session Now
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="spa-schedule-card">
                        <h3 class="fs-4 text-emerald mb-3">Weekly Schedule</h3>
                        @if(isset($shedules) && count($shedules) > 0)
                            @foreach ($shedules as $shedule)
                                <div class="spa-schedule-item">
                                    <span class="spa-schedule-day">{{ $shedule->shedule_form }} @if($shedule->shedule_to) – {{ $shedule->shedule_to }} @endif</span>
                                    @if($shedule->time_form != null)
                                        <span class="spa-schedule-time">{{ $shedule->time_form }} – {{ $shedule->time_to }}</span>
                                    @else
                                        <span class="badge bg-danger">Closed</span>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="spa-schedule-item">
                                <span class="spa-schedule-day">Monday – Sunday</span>
                                <span class="spa-schedule-time text-success fw-bold">24 / 7 All Time Open</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
