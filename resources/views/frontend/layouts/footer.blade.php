<!-- Modern Luxury Spa Footer -->
<footer class="spa-footer">
    <div class="container">
        <div class="row g-4">
            <!-- Column 1: Brand & About -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="spa-footer-logo">
                    <a href="{{ url('/') }}">
                        @if(get_setting('frontend_logo_footer'))
                            <img src="{{ asset(get_setting('frontend_logo_footer')) }}" alt="{{ get_setting('site_name') ?? 'Thai Spa' }}">
                        @else
                            <h3 class="text-white mb-3">THAI SPA</h3>
                        @endif
                    </a>
                </div>
                <p class="mb-4 text-white opacity-90">{{ get_setting('footer_description') ?? 'Indulge in pure bliss and rejuvenating wellness treatments designed to revitalize your body and mind in luxury.' }}</p>
                <div class="spa-topbar-social">
                    @if(get_setting('facebook'))
                        <a href="{{ get_setting('facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(get_setting('twitter'))
                        <a href="{{ get_setting('twitter') }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
                    @endif
                    @if(get_setting('instagram'))
                        <a href="{{ get_setting('instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(get_setting('linkedin'))
                        <a href="{{ get_setting('linkedin') }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if(get_setting('youtube'))
                        <a href="{{ get_setting('youtube') }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h4 class="spa-footer-title">Quick Links</h4>
                <ul class="spa-footer-links">
                    <li><a href="{{ url('/') }}"><i class="fas fa-angle-right me-1 text-warning"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-angle-right me-1 text-warning"></i> About Us</a></li>
                    <li><a href="{{ route('blog') }}"><i class="fas fa-angle-right me-1 text-warning"></i> Blog Post</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right me-1 text-warning"></i> Contact Us</a></li>
                    <li><a href="{{ url('/') }}#appointment"><i class="fas fa-angle-right me-1 text-warning"></i> Appointment</a></li>
                </ul>
            </div>

            <!-- Column 3: Working Hours (High-Contrast & Clear) -->
            <div class="col-lg-3 col-md-6 col-12">
                <h4 class="spa-footer-title">Opening Hours</h4>
                <div class="spa-footer-hours-card mb-3">
                    <div class="hours-title">
                        <i class="far fa-clock"></i>
                        <span>24/7 Hours Open</span>
                    </div>
                    <p>Every day of the week, including holidays. Walk-ins & reservations welcome.</p>
                </div>
            </div>

            <!-- Column 4: Contact & Newsletter -->
            <div class="col-lg-3 col-md-6 col-12">
                <h4 class="spa-footer-title">Contact Us</h4>
                <div class="mb-3 text-white">
                    <p class="mb-2"><i class="fas fa-map-marker-alt text-warning me-2"></i> {{ get_setting('office_address') }}</p>
                    <p class="mb-2">
                        <i class="fas fa-phone-alt text-warning me-2"></i> 
                        <a href="tel:{{ get_setting('office_phone') }}" class="text-white fw-bold">{{ get_setting('office_phone') }}</a>
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-envelope text-warning me-2"></i> 
                        <a href="mailto:{{ get_setting('office_email') }}" class="text-white">{{ get_setting('office_email') }}</a>
                    </p>
                </div>
                <div>
                    <h6 class="text-white mb-2" style="font-size: 0.88rem;">Subscribe For Offers</h6>
                    <form action="#" method="POST" onsubmit="event.preventDefault(); Toastify({text: 'Thank you for subscribing!', backgroundColor: '#0F3E36'}).showToast();">
                        <div class="spa-subscribe-form">
                            <input type="email" placeholder="Your email address..." required>
                            <button type="submit">Join</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="spa-footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0">{{ get_setting('copyright_text') ?? '© ' . date('Y') . ' Thai Spa Center. All Rights Reserved.' }}</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed for Ultimate Relaxation & Luxury Wellness</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Desktop Floating Action Buttons -->
<div class="spa-fab-group">
    @php
        $raw_phone = preg_replace('/[^0-9]/', '', get_setting('office_phone') ?? '8801736010400');
        if (substr($raw_phone, 0, 2) !== '88' && strlen($raw_phone) == 11) {
            $raw_phone = '88' . $raw_phone;
        }
    @endphp
    <a href="https://api.whatsapp.com/send?phone={{ $raw_phone }}&text=Hello!%20I%20would%20like%20to%20book%20a%20spa%20treatment." target="_blank" class="spa-fab-btn spa-fab-whatsapp" aria-label="WhatsApp Us" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="tel:{{ get_setting('office_phone') }}" class="spa-fab-btn spa-fab-phone" aria-label="Call Us" title="Call Us Now">
        <i class="fas fa-phone-alt"></i>
    </a>
</div>

<!-- Mobile Bottom Docked Quick Action Bar -->
<div class="spa-mobile-dock">
    <div class="spa-dock-container">
        <a href="tel:{{ get_setting('office_phone') }}" class="spa-dock-btn spa-dock-call">
            <i class="fas fa-phone-alt"></i> Call Now
        </a>
        <a href="https://api.whatsapp.com/send?phone={{ $raw_phone }}&text=Hello!%20I%20would%20like%20to%20book%20a%20spa%20treatment." target="_blank" class="spa-dock-btn spa-dock-whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="{{ url('/') }}#appointment" class="spa-dock-btn spa-dock-book">
            <i class="fas fa-calendar-check"></i> Book
        </a>
    </div>
</div>
