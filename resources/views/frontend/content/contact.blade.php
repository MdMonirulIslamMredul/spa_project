@extends('frontend.layouts.app')

@section('title', 'Contact Us - ' . (get_setting('site_name') ?? 'Thai Spa Center'))

@section('content')
    <!-- Inner Hero Banner -->
    <section class="spa-inner-hero" style="background-image: url('{{ isset($contact_banner) && $contact_banner->first() ? asset('backend_img/contact/' . $contact_banner->first()->contact_img) : asset('frontend_assets/img/slider/slider-1.jpg') }}');">
        <div class="spa-inner-hero-overlay"></div>
        <div class="container">
            <div class="spa-inner-hero-content">
                <h1 class="spa-hero-title mb-2">Get In Touch</h1>
                <p class="spa-section-desc text-white opacity-75">
                    {{ isset($contact_banner) && $contact_banner->first() ? $contact_banner->first()->contact_title : 'Have questions or want to plan a custom spa experience? We would love to hear from you.' }}
                </p>
                <ul class="spa-breadcrumbs">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li><span>/</span></li>
                    <li><span class="text-white">Contact Us</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Contact Details & Form -->
    <section class="py-5" style="background: var(--spa-light-alt);">
        <div class="container py-4">
            <div class="row g-4">
                <!-- Left: Contact Form -->
                <div class="col-lg-7">
                    <div class="spa-booking-card">
                        <span class="spa-section-subtitle text-start p-0 mb-2">We Are Here For You</span>
                        <h2 class="spa-heading fs-3 text-emerald mb-4">Send Us A Message</h2>
                        
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="spa-form-group">
                                        <label class="spa-form-label">Your Name *</label>
                                        <input type="text" name="name" class="spa-form-control" placeholder="Full name..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="spa-form-group">
                                        <label class="spa-form-label">Email Address *</label>
                                        <input type="email" name="email" class="spa-form-control" placeholder="Email address..." required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="spa-form-group">
                                        <label class="spa-form-label">Subject *</label>
                                        <input type="text" name="subject" class="spa-form-control" placeholder="Inquiry subject..." required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="spa-form-group">
                                        <label class="spa-form-label">Your Message *</label>
                                        <textarea name="comments" class="spa-form-control" rows="5" placeholder="Write your message here..." required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 pt-2">
                                    <button type="submit" class="spa-btn spa-btn-primary w-100 py-3">
                                        <i class="fas fa-paper-plane me-2"></i> Submit Inquiry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right: Contact Information Box -->
                <div class="col-lg-5">
                    <div class="spa-contact-info-card">
                        <h3 class="spa-heading fs-4 text-white mb-4">Contact Information</h3>

                        <div class="spa-contact-info-item">
                            <div class="spa-contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="spa-contact-info-text">
                                <h5>Sanctuary Location</h5>
                                <p class="mb-0">{{ get_setting('office_address') }}</p>
                            </div>
                        </div>

                        <div class="spa-contact-info-item">
                            <div class="spa-contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="spa-contact-info-text">
                                <h5>Direct Phone Line</h5>
                                <p class="mb-0"><a href="tel:{{ get_setting('office_phone') }}" class="text-white">{{ get_setting('office_phone') }}</a></p>
                            </div>
                        </div>

                        <div class="spa-contact-info-item">
                            <div class="spa-contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="spa-contact-info-text">
                                <h5>Email Inquiries</h5>
                                <p class="mb-0"><a href="mailto:{{ get_setting('office_email') }}" class="text-white">{{ get_setting('office_email') }}</a></p>
                            </div>
                        </div>

                        <div class="spa-contact-info-item">
                            <div class="spa-contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="spa-contact-info-text">
                                <h5>Opening Hours</h5>
                                <p class="mb-0">24/7 Hours All Time Open</p>
                            </div>
                        </div>

                        @if(get_setting('facebook'))
                            <div class="pt-3 border-top border-white border-opacity-10">
                                <a href="{{ get_setting('facebook') }}" target="_blank" class="d-inline-flex align-items-center text-white gap-2 opacity-90 hover-opacity-100">
                                    <i class="fab fa-facebook-square fs-4 text-warning"></i>
                                    <span>Follow us on Facebook</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Smooth Rounded Container) -->
    <section class="py-5" style="background: var(--spa-light-alt);">
        <div class="container">
            <div class="spa-map-container" style="min-height: 420px;">
                @if(get_setting('office_map_iframe_url'))
                    {!! get_setting('office_map_iframe_url') !!}
                @else
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14606.07065977936!2d90.4125!3d23.7937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a0f70deb73%3A0x30c36498fef0d73f!2sGulshan%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1680000000000" width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                @endif
            </div>
        </div>
    </section>
@endsection
