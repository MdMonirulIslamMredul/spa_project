@extends('frontend.layouts.app')

@section('title', 'Wellness Blog & Spa Insights - ' . (get_setting('site_name') ?? 'Thai Spa Center'))

@section('content')
    <!-- Inner Hero Banner -->
    <section class="spa-inner-hero" style="background-image: url('{{ isset($blogs) && $blogs->first() && $blogs->first()->blog_ban_img ? asset('backend_img/blogs/' . $blogs->first()->blog_ban_img) : asset('frontend_assets/img/slider/slider-1.jpg') }}');">
        <div class="spa-inner-hero-overlay"></div>
        <div class="container">
            <div class="spa-inner-hero-content">
                <h1 class="spa-hero-title mb-2">Wellness Journal</h1>
                <p class="spa-section-desc text-white opacity-75">
                    Explore expert insights, self-care rituals, aromatherapy secrets, and the holistic benefits of authentic Thai therapies.
                </p>
                <ul class="spa-breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li><span>/</span></li>
                    <li><span class="text-white">Blog</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-5" style="background: var(--spa-light-alt);">
        <div class="container py-4">
            <div class="spa-section-header">
                <span class="spa-section-subtitle">Articles & Guides</span>
                <h2 class="spa-section-title">Latest Wellness Stories</h2>
                <p class="spa-section-desc">Discover tips from our master practitioners to enhance your health and serenity.</p>
            </div>

            <div class="row g-4">
                @if(isset($blogs) && count($blogs) > 0)
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6">
                            <div class="spa-blog-card">
                                <div class="spa-blog-img-wrap">
                                    @if($blog->blog_img)
                                        <img src="{{ asset('backend_img/blogs/' . $blog->blog_img) }}" alt="{{ $blog->blog_title }}" loading="lazy">
                                    @endif
                                </div>
                                <div class="spa-blog-body">
                                    <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                                        <i class="far fa-calendar-alt text-warning"></i>
                                        <span>{{ date('M d, Y', strtotime($blog->created_at ?? 'now')) }}</span>
                                        <span>•</span>
                                        <span class="text-success"><i class="fas fa-spa me-1"></i> Wellness</span>
                                    </div>
                                    <h3 class="spa-blog-title">
                                        <a href="{{ route('blog.details', $blog->id) }}">{{ $blog->blog_title }}</a>
                                    </h3>
                                    <p class="spa-blog-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->blog_sort ?? $blog->blog_long ?? ''), 110) }}
                                    </p>
                                    <div class="mt-auto pt-2">
                                        <a href="{{ route('blog.details', $blog->id) }}" class="spa-service-action">
                                            <span>Read Article</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
