@extends('pages.layout.app')
@section('content')

<!-- main-area -->

<main class="fix">

        <!-- slider-area -->
        <section class="slider__area">
            <div class="swiper-container slider__active">
                <div class="swiper-wrapper">
                    <div class="swiper-slide slider__single">
                        <div class="slider__bg" data-background="assets/img/slider/slider_bg01.jpg"></div>
                        <div class="container">
                            <div class="slider__content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h2 class="title">SMART LOGISTICS, SEAMLESS DELIVERY!</h2>
                                        <p>Experience next-generation shipping solutions with {{ \App\Models\Setting::get('company_name', config('app.name')) }}. Our AI-powered logistics network delivers your packages faster, smarter, and more reliably across the globe—connecting businesses to opportunities worldwide.</p>
                                        <a href="{{ route('services') }}" class="btn border-btn">Explore Our Services <img src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="assets/img/slider/slider_shape.svg" alt="shape" class="shape">
                    </div>
                    <div class="swiper-slide slider__single">
                        <div class="slider__bg" data-background="assets/img/slider/slider_bg02.jpg"></div>
                        <div class="container">
                            <div class="slider__content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h2 class="title">CONNECTING THE WORLD, ONE PACKAGE AT A TIME!</h2>
                                        <p>Transform your supply chain with {{ \App\Models\Setting::get('company_name', config('app.name')) }}'s innovative shipping technology. From same-day local delivery to international freight, we provide real-time tracking, carbon-neutral options, and guaranteed delivery windows that keep your business moving forward.</p>
                                        <a href="{{ route('services') }}" class="btn border-btn">Explore Our Services <img src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="assets/img/slider/slider_shape.svg" alt="shape" class="shape">
                    </div>

                </div>
            </div>
        </section>
        <!-- slider-area-end -->

        <!-- newsletter-area -->
        <section class="newsletter__area">
            <div class="container">
                <div class="newsletter__wrap">
                    <div class="row gx-0">
                        <div class="col-lg-12">
                            <div class="newsletter__content">
                                <h2 class="title"><i class="flaticon-waving-flag"></i>Track Shipment</h2>
                                <form action="{{ route('track') }}" method="GET" class="newsletter__form d-flex flex-wrap gap-2">
                                    <input type="text" class="form-control flex-fill" id="tracking_number" name="tracking_number" value="" placeholder="Enter tracking number (e.g., SH65A1B2C3D4E5F)" required>
                                    <button type="submit" class="btn btn-primary">Track Shipment <i class="fas fa-search ms-1"></i></button>
                                </form>
                                <img src="assets/img/images/newsletter_shape02.svg" alt="" class="shape rotateme-two">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- newsletter-area-end -->

        <!-- about-area -->
        <section class="about__area-three section-py-120">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-9">
                        <div class="about__img-three">
                            <img src="assets/img/images/h2_about_img01.jpg" alt="img" data-aos="fade-right" data-aos-delay="200">
                            <img src="assets/img/images/h2_about_img02.jpg" alt="img" data-aos="fade-left" data-aos-delay="400">
                            <img src="assets/img/images/h2_about_img03.jpg" alt="img" data-aos="fade-up" data-aos-delay="600">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about__content-three">
                            <div class="section__title mb-20">
                                <span class="sub-title">POWERING GLOBAL COMMERCE</span>
                                <h2 class="title">Intelligent Shipping Solutions for the Modern World</h2>
                            </div>
                            <p>
                                {{ \App\Models\Setting::get('company_name', config('app.name')) }} revolutionizes global shipping with cutting-edge technology and data-driven logistics. Our smart routing algorithms, real-time visibility, and carbon-conscious delivery options ensure your packages reach customers faster while reducing environmental impact.
                            </p>
                            <div class="choose__list-wrap">
                                <div class="row gutter-20">
                                    <div class="col-md-6">
                                        <div class="choose__list-item">
                                            <div class="icon">
                                                 <i class="flaticon-package"></i>
                                            </div>
                                            <div class="content">
                                                <h2 class="count"><span class="counter-number">10</span>M+</h2>
                                            <p>Shipments Delivered</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="choose__list-item">
                                            <div class="icon">
                                                <i class="flaticon-planet-earth"></i>
                                            </div>
                                            <div class="content">
                                               <h2 class="count"><span class="counter-number">20</span>M+</h2>
                                            <p>Satisfied Clients Worldwide</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="about__content-inner-two">

                                <div class="about__list-box about__list-box-five">

                                    <ul style="font-size: 16px" class="list-wrap">
                                        <li><i class="flaticon-check"></i>Real-time package tracking & analytics</li>
                                        <li><i class="flaticon-check"></i>Smart delivery optimization</li>
                                        <li><i class="flaticon-check"></i>Global network with local expertise</li>
                                        <li><i class="flaticon-check"></i>Sustainable & secure logistics solutions</li>
                                    </ul>
                                </div>

                            </div>
                            <a href="{{ route('about') }}" class="btn">About Us <img src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-area-end -->

        <!-- services-area -->
        <section class="services__area-two grey-bg section-pt-120 section-pb-90">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="section__title mb-60 mb-md-30">
                            <span class="sub-title">SHIPPING SOLUTIONS</span>
                            <h2 class="title">Next-Gen Logistics for Digital Commerce</h2>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="section__content mb-50">
                            <p>Transform your supply chain with intelligent shipping solutions that adapt to your business needs. From instant quotes to automated fulfillment, we make global commerce effortless.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container custom-container">
                <div class="row g-4 justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="services__item-two">
                            <div class="services__item-top">
                                <div class="services__icon-two">
                                    <i class="flaticon-delivery-cart"></i>
                                </div>
                                <h2 class="title"><a href="{{ route('services') }}">Instant <br>Delivery</a></h2>
                            </div>
                            <div class="services__content-two">
                                <p>Lightning-fast delivery solutions powered by AI routing for urgent shipments.</p>
                                <ul class="services__item-list list-wrap">
                                    <li><i class="flaticon-check"></i>Same-hour to same-day delivery</li>
                                    <li><i class="flaticon-check"></i>Live tracking with delivery predictions</li>
                                    <li><i class="flaticon-check"></i>Smart insurance & damage protection</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="services__item-two">
                            <div class="services__item-top">
                                <div class="services__icon-two">
                                    <i class="flaticon-warehouse-1"></i>
                                </div>
                                <h2 class="title"><a href="{{ route('services') }}">Smart Freight<br> Network</a></h2>
                            </div>
                            <div class="services__content-two">
                                <p>Intelligent freight solutions that optimize routes and costs across all transport modes.</p>
                                <ul class="services__item-list list-wrap">
                                    <li><i class="flaticon-check"></i>Multi-modal transport optimization</li>
                                    <li><i class="flaticon-check"></i>Dynamic pricing & route planning</li>
                                    <li><i class="flaticon-check"></i>Automated customs & documentation</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="services__item-two">
                            <div class="services__item-top">
                                <div class="services__icon-two">
                                     <i class="flaticon-train"></i>
                                </div>
                                <h2 class="title"><a href="{{ route('services') }}">Eco Transport<br> Solutions</a></h2>
                            </div>
                            <div class="services__content-two">
                                <p>Sustainable overland transport with carbon-neutral options and smart logistics.</p>
                                <ul class="services__item-list list-wrap">
                                    <li><i class="flaticon-check"></i>Electric & hybrid vehicle fleet</li>
                                    <li><i class="flaticon-check"></i>Carbon footprint tracking</li>
                                    <li><i class="flaticon-check"></i>Predictive delivery scheduling</li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="services__item-two">
                            <div class="services__item-top">
                                <div class="services__icon-two">
                                    <i class="flaticon-box"></i>
                                </div>
                                <h2 class="title"><a href="#">AI Warehouse<br> Management</a></h2>
                            </div>
                            <div class="services__content-two">
                                <p>Automated fulfillment centers with robotics and AI for maximum efficiency.</p>
                                <ul class="services__item-list list-wrap">
                                    <li><i class="flaticon-check"></i>Autonomous inventory management</li>
                                    <li><i class="flaticon-check"></i>Smart climate control systems</li>
                                    <li><i class="flaticon-check"></i>Predictive demand forecasting</li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- services-area-end -->


         <!-- work-area -->
        <section class="work__area-two">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section__title text-center white-title mb-50">
                            <span class="sub-title">GETTING STARTED</span>
                            <h2 class="title">Streamlined Shipping in 4 Simple Steps</h2>
                        </div>
                    </div>
                </div>
                <div class="work__item-wrap">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-sm-6">
                            <div class="work__item work__item-two">
                                <div class="work__icon work__icon-two">
                                    <i class="flaticon-package"></i>
                                    <span class="number">01</span>
                                </div>
                                <div class="work__content work__content-two">
                                    <h4 class="title">Get Instant Quote</h4>
                                    <p>Enter your shipment details and receive a real-time quote with multiple delivery options.</p>
                                </div>
                                <div class="work__shape work__shape-two">
                                    <img src="assets/img/images/work_shape01.svg" alt="" class="injectable">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="work__item work__item-two">
                                <div class="work__icon work__icon-two">
                                    <i class="flaticon-support"></i>
                                    <span class="number">02</span>
                                </div>
                                <div class="work__content work__content-two">
                                    <h4 class="title">Smart Booking</h4>
                                    <p>Book your shipment instantly with automated pickup scheduling and route optimization.</p>
                                </div>
                                <div class="work__shape work__shape-two">
                                    <img src="assets/img/images/work_shape02.svg" alt="" class="injectable">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="work__item work__item-two">
                                <div class="work__icon work__icon-two">
                                    <i class="flaticon-global-distribution"></i>
                                    <span class="number">03</span>
                                </div>
                                <div class="work__content work__content-two">
                                    <h4 class="title">Live Tracking</h4>
                                    <p>Monitor your shipment in real-time with predictive delivery updates and smart notifications.</p>
                                </div>
                                <div class="work__shape work__shape-two">
                                    <img src="assets/img/images/work_shape01.svg" alt="" class="injectable">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="work__item work__item-two">
                                <div class="work__icon work__icon-two">
                                    <i class="flaticon-parcel"></i>
                                    <span class="number">04</span>
                                </div>
                                <div class="work__content work__content-two">
                                    <h4 class="title">Delivery Confirmation</h4>
                                    <p>Get instant delivery confirmation with digital proof of delivery and customer feedback.</p>
                                </div>
                                <div class="work__shape work__shape-two">
                                    <img src="assets/img/images/work_shape01.svg" alt="" class="injectable">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- work-area-end -->






        <!-- cta-area -->
        <section class="cta__area-two">
            <div class="container">
                <div class="cta__wrap-two cta__wrap-three">
                    <div class="cta__img">
                        <img src="assets/img/images/cta_img.jpg" alt="img">
                    </div>
                    <div class="cta__content-two cta__content-three">
                        <div class="content__left">
                            <h2 class="title">Ready to Transform Your Shipping Experience?</h2>
                            <p>Join thousands of businesses already using our smart logistics platform. From same-day delivery to international freight, we provide the technology and reliability you need to scale your operations.</p>
                        </div>
                        <div class="cta__btn-two cta__btn-three">
                            <a href="{{ route('contact') }}" class="btn">Get a Quote <img src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta-area-end -->



        <!-- testimonial-area -->
        <section class="testimonial__area-two section-pt-130 section-pb-130">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10">
                        <div class="testimonial__wrap fix">
                            <div class="testimonial__icon testimonial__icon-two">
                                <img src="assets/img/icon/quote.svg" alt="" class="injectable">
                            </div>
                            <div class="testimonial-slider-dot">
                                <div class="swiper testimonial__nav">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <button><img src="assets/img/images/author01.png" alt="img"></button>
                                        </div>
                                        <div class="swiper-slide">
                                            <button><img src="assets/img/images/author02.png" alt="img"></button>
                                        </div>
                                        <div class="swiper-slide">
                                            <button><img src="assets/img/images/author03.png" alt="img"></button>
                                        </div>
                                        <div class="swiper-slide">
                                            <button><img src="assets/img/images/author04.png" alt="img"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper testimonial-active">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="testimonial__item">
                                            <div class="testimonial__info">
                                                <h2 class="name">Ralph Edwards</h2>
                                                <span>Business Owner</span>
                                            </div>
                                            <div class="testimonial__rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="testimonial__content testimonial__content-two">
                                                <p>"The AI-powered tracking system is incredible. I can predict delivery times and my customers love the real-time updates. It's transformed our customer experience."</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial__item">
                                            <div class="testimonial__info">
                                                <h2 class="name">Sarah Collins</h2>
                                                <span>Operations Manager</span>
                                            </div>
                                            <div class="testimonial__rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="testimonial__content testimonial__content-two">
                                                <p>
                                                    "The smart routing saved us 30% on shipping costs while improving delivery times. The carbon-neutral options align perfectly with our sustainability goals."
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial__item">
                                            <div class="testimonial__info">
                                                <h2 class="name">Eleanor Pena</h2>
                                                <span>E-commerce Seller</span>
                                            </div>
                                            <div class="testimonial__rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="testimonial__content testimonial__content-two">
                                                <p>
                                                    "Same-day delivery for my e-commerce business has been a game-changer. The automated fulfillment integration works seamlessly with our systems."
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial__item">
                                            <div class="testimonial__info">
                                                <h2 class="name">Floyd Miles</h2>
                                                <span> Logistics Coordinator</span>
                                            </div>
                                            <div class="testimonial__rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="testimonial__content testimonial__content-two">
                                                <p>
                                                    "The predictive analytics help us optimize inventory and reduce waste. It's like having a logistics expert working 24/7 for our business."
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial__nav-wrap testimonial__nav-wrap-two">
                                    <button class="testimonial-button-prev">
                                        <i class="flaticon-left-arrow"></i>
                                    </button>
                                    <button class="testimonial-button-next">
                                        <i class="flaticon-right-arrow"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- testimonial-area-end -->


    <!-- video-area -->
        <section class="video__area">
            <div class="video__bg" data-background="assets/img/bg/video_bg.jpg"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-6 order-0 order-lg-2">
                        <div class="video__play-btn video__play-btn-three">

                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="video__content">
                            <div style="text-align: center" class="section__title white-title">
                                <span class="sub-title">Innovation Meets Reliability</span>
                                <h2 class="title">The Future of Shipping is Here
Experience intelligent logistics that adapt to your business needs with real-time optimization and sustainable delivery solutions.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- video-area-end -->

    </main>

<!-- main-area-end -->
@endsection
