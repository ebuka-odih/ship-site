@extends('pages.layout.app')
@section('content')

<!-- main-area -->
<main class="fix">

    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="assets/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h3 class="title">Contact Us</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <!-- Header -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="badge bg-danger mb-3 px-3 py-2">GET IN TOUCH</span>
                    <h1 class="display-5 fw-bold mb-3">Ready to Ship? Let's Connect!</h1>
                    <p class="lead text-muted">Our logistics experts are standing by to help you move your cargo efficiently and safely. Get a personalized quote or speak with our team about your shipping needs.</p>
                </div>
            </div>

            <!-- Contact Info Cards -->
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-phone text-danger fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold">Call Us</h5>
                            <p class="card-text text-muted">Speak directly with our logistics specialists</p>
                            <a href="tel:{{ \App\Models\Setting::get('company_phone', '+1 (555) 123-4567') }}" class="btn btn-outline-danger">
                                {{ \App\Models\Setting::get('company_phone', '+1 (555) 123-4567') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-envelope text-danger fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold">Email Us</h5>
                            <p class="card-text text-muted">Send us your requirements and get a quote</p>
                            <a href="mailto:{{ \App\Models\Setting::get('company_email', 'info@example.com') }}" class="btn btn-outline-danger">
                                {{ \App\Models\Setting::get('company_email', 'info@example.com') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-map-marker-alt text-danger fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold">Visit Us</h5>
                            <p class="card-text text-muted">Our headquarters and main operations center</p>
                            <address class="text-muted">
                                123 Logistics Way<br>
                                Shipping City, SC 12345
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-5">
                        <!-- Form -->
                        <div class="col-lg-8">
                            <div class="card border-0 shadow">
                                <div class="card-body p-5">
                                    <h3 class="fw-bold mb-4">Send us a Message</h3>
                                    <p class="text-muted mb-4">Ready to get started? Fill out the form and our team will get back to you within 24 hours with a customized shipping solution.</p>
                                    
                                    <form action="#" method="POST" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Your Name *</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                                <div class="invalid-feedback">
                                                    Please provide your name.
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Your Email *</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid email.
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Your Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="service" class="form-label">Service Required *</label>
                                                <select class="form-select" id="service" name="service" required>
                                                    <option value="">Select a service</option>
                                                    <option value="air-freight">Air Freight</option>
                                                    <option value="ocean-freight">Ocean Freight</option>
                                                    <option value="road-freight">Road Freight</option>
                                                    <option value="train-freight">Train Freight</option>
                                                    <option value="warehousing">Smart Warehousing</option>
                                                    <option value="relocation">Relocation Services</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a service.
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="message" class="form-label">Message *</label>
                                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tell us about your shipping requirements..." required></textarea>
                                                <div class="invalid-feedback">
                                                    Please provide your message.
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-danger btn-lg px-5">
                                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Support Info -->
                        <div class="col-lg-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-4">Need Immediate Help?</h5>
                                    
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="fas fa-phone text-danger"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-bold">Emergency Support</h6>
                                            <a href="tel:{{ \App\Models\Setting::get('company_phone', '+1 (555) 123-4567') }}" class="text-decoration-none">
                                                {{ \App\Models\Setting::get('company_phone', '+1 (555) 123-4567') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="fas fa-envelope text-danger"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-bold">Email Support</h6>
                                            <a href="mailto:{{ \App\Models\Setting::get('company_email', 'support@example.com') }}" class="text-decoration-none">
                                                {{ \App\Models\Setting::get('company_email', 'support@example.com') }}
                                            </a>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    
                                    <div class="text-center">
                                        <h6 class="fw-bold mb-3">Business Hours</h6>
                                        <div class="small text-muted">
                                            <div>Monday - Friday: 8:00 AM - 6:00 PM</div>
                                            <div>Saturday: 9:00 AM - 4:00 PM</div>
                                            <div>Sunday: Closed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Find Us</h3>
                    <p class="text-muted">Visit our headquarters for in-person consultations and support.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2sbd!4v1625618602100!5m2!1sen!2sbd" 
                                class="w-100" 
                                height="400" 
                                style="border:0; border-radius: 0.375rem;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- main-area-end -->

<script>
// Bootstrap form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

@endsection
