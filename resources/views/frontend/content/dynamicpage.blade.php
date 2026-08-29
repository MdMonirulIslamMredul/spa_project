@extends('frontend.layouts.app')

@section('title', ($page->title ?? 'Page') . ' - ' . (get_setting('site_name') ?? 'Thai Spa Center'))

@section('content')
    <!-- Inner Hero Banner -->
    <section class="spa-inner-hero" style="background-image: url('{{ $page->image ? asset('/setting/banner/' . $page->image) : asset('frontend_assets/img/slider/slider-1.jpg') }}');">
        <div class="spa-inner-hero-overlay"></div>
        <div class="container">
            <div class="spa-inner-hero-content">
                <h1 class="spa-hero-title mb-2">{{ $page->title }}</h1>
                <ul class="spa-breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li><span>/</span></li>
                    <li><span class="text-white">{{ $page->title }}</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Page Body Content -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="spa-dynamic-content text-secondary leading-loose" style="line-height: 1.85;">
                        {!! $page->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
