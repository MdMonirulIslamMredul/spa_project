@extends('frontend.layouts.app')

@php
    $blog = isset($blogs_details) ? $blogs_details->first() : null;
@endphp

@section('title', ($blog ? $blog->blog_title : 'Blog Article') . ' - ' . (get_setting('site_name') ?? 'Thai Spa Center'))

@section('content')
    <!-- Inner Hero Banner -->
    <section class="spa-inner-hero" style="background-image: url('{{ $blog && $blog->blog_ban_img ? asset('backend_img/blogs/' . $blog->blog_ban_img) : asset('frontend_assets/img/slider/slider-1.jpg') }}');">
        <div class="spa-inner-hero-overlay"></div>
        <div class="container">
            <div class="spa-inner-hero-content">
                <h1 class="spa-hero-title mb-2">{{ $blog ? $blog->blog_title : 'Wellness Article' }}</h1>
                <ul class="spa-breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li><span>/</span></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><span>/</span></li>
                    <li><span class="text-white">Article</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-5">
                <!-- Main Article Column -->
                <div class="col-lg-8">
                    @if($blog)
                        <article class="spa-article">
                            @if($blog->blog_img)
                                <div class="mb-4 rounded-4 overflow-hidden shadow-sm">
                                    <img src="{{ asset('backend_img/blogs/' . $blog->blog_img) }}" alt="{{ $blog->blog_title }}" class="w-100 object-fit-cover" style="max-height: 480px;">
                                </div>
                            @endif

                            <div class="d-flex align-items-center gap-3 text-muted mb-4 pb-3 border-bottom">
                                <span><i class="far fa-calendar-alt text-warning me-1"></i> {{ date('F d, Y', strtotime($blog->created_at ?? 'now')) }}</span>
                                <span>•</span>
                                <span><i class="fas fa-user-circle text-success me-1"></i> By Thai Spa Specialist</span>
                                <span>•</span>
                                <span><i class="fas fa-tag text-secondary me-1"></i> Wellness & Body Care</span>
                            </div>

                            <h2 class="spa-heading fs-2 text-emerald mb-4">{{ $blog->blog_title }}</h2>

                            <div class="text-secondary leading-loose fs-6" style="line-height: 1.9;">
                                {!! nl2br(e($blog->blog_long ?? $blog->blog_sort ?? '')) !!}
                            </div>

                            <hr class="my-5" style="border-color: var(--spa-border);">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <a href="{{ route('blog') }}" class="spa-btn spa-btn-outline text-dark border-dark" style="color: var(--spa-primary) !important;">
                                    <i class="fas fa-arrow-left me-1"></i> Back To All Articles
                                </a>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-semibold text-dark">Share:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-x-twitter"></i></a>
                                </div>
                            </div>
                        </article>
                    @endif
                </div>

                <!-- Sidebar Column -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <!-- Booking CTA Box -->
                        <div class="p-4 rounded-4 text-white mb-4 shadow-md" style="background: var(--spa-primary);">
                            <span class="badge bg-warning text-dark mb-2">Exclusive Relaxation</span>
                            <h3 class="spa-heading fs-4 text-white mb-3">Ready to Feel Rejuvenated?</h3>
                            <p class="small text-light opacity-90 mb-4">Book your signature Thai therapy today and let our master therapists restore your vitality.</p>
                            <a href="{{ url('/') }}#appointment" class="spa-btn spa-btn-primary w-100 mb-2">
                                <i class="fas fa-calendar-alt"></i> Reserve Session
                            </a>
                            @if(get_setting('office_phone'))
                                <a href="tel:{{ get_setting('office_phone') }}" class="spa-btn spa-btn-outline w-100">
                                    <i class="fas fa-phone-alt"></i> {{ get_setting('office_phone') }}
                                </a>
                            @endif
                        </div>

                        <!-- Working Hours Widget -->
                        <div class="p-4 rounded-4 bg-light border">
                            <h4 class="spa-heading fs-5 text-emerald mb-3"><i class="far fa-clock text-warning me-2"></i> Opening Hours</h4>
                            <p class="text-muted small mb-3">Our sanctuary is open 24 hours every day to accommodate your lifestyle.</p>
                            <div class="d-flex justify-content-between py-2 border-bottom text-dark small fw-semibold">
                                <span>Mon – Sun</span>
                                <span class="text-success">24/7 Hours Open</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
