@extends('pages.layout.app')
@section('content')

    <!-- main-area -->
    <main class="fix">

        <!-- breadcrumb-area -->
        <section class="breadcrumb__area breadcrumb__bg" data-background="assets/img/bg/breadcrumb_bg.jpg"
             style="background-image: url(assets/img/bg/breadcrumb_bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb__content">
                            <h1 class="title">About Us</h1>
                            <nav class="breadcrumb">
                                <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                                </span>
                                <span class="breadcrumb-separator"><i class="flaticon-right-arrow"></i></span>
                                <span property="itemListElement" typeof="ListItem">About Us</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- about-area -->
        <section class="about__area-two section-py-120">
            <div class="container">
                <div class="row align-items-center justify-content-center gutter-24">
                    <div class="col-lg-6 col-md-9">
                        <div class="about__img-two">
                            <img src="assets/img/images/inner_about_img01.jpg" alt="img" data-aos="fade-right"
                                 data-aos-delay="400" class="aos-init aos-animate">
                            <img src="assets/img/images/inner_about_img02.jpg" alt="img" data-aos="fade-up"
                                 data-aos-delay="600" class="aos-init aos-animate">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about__content-two">
                            <div class="section__title section__title-two mb-20">
                            <span class="sub-title">About {{ \App\Models\Setting::get('company_name', config('app.name')) }}</span>
                            <h2 class="title">Pioneering the Future of Smart Logistics</h2>
                            </div>
                            <p class="info-one">
                            {{ \App\Models\Setting::get('company_name', config('app.name')) }} is revolutionizing global shipping through cutting-edge technology and intelligent logistics solutions. We combine AI-powered routing, real-time tracking, and sustainable delivery options to create seamless shipping experiences for businesses worldwide. Our mission is to transform how goods move across borders with innovation, efficiency, and environmental consciousness.
                            </p>
                            <h5>Our Mission</h5>
                            <p>
                            To democratize global commerce by providing intelligent, sustainable, and cost-effective shipping solutions that empower businesses to scale efficiently while reducing their carbon footprint.
                            </p>
                        <h5 class="mt-3">Our Vision</h5>
                            <p>
                            To become the world's leading smart logistics platform, recognized for innovation, sustainability, and exceptional customer experience in the digital economy.
                            </p>

                            <div class="about__content-inner mt-3">
                                <div class="about__list-box about__list-box-two">
                                <h5>Why Choose Our Smart Shipping Platform</h5>
                                    <ul style="list-style: none; padding: 0;">
                                    <li>✔️ <strong>AI-Powered Optimization</strong> – Our machine learning algorithms ensure the most efficient routes and delivery times for every shipment.</li>
                                    <li>✔️ <strong>Real-Time Intelligence</strong> – Advanced tracking and predictive analytics keep you informed at every step of the journey.</li>
                                    <li>✔️ <strong>Carbon-Conscious Delivery</strong> – Sustainable shipping options that reduce environmental impact while maintaining speed and reliability.</li>
                                    <li>✔️ <strong>Seamless Integration</strong> – Our platform integrates effortlessly with your existing systems for automated, hassle-free shipping management.</li>
                                    </ul>
                                <h5>Global Network, Local Intelligence</h5>
                                <p>With our extensive network of smart warehouses, eco-friendly transport partners, and AI-driven logistics hubs worldwide, we deliver the perfect blend of global reach and local expertise. Whether you need instant same-day delivery or complex international freight solutions, our intelligent platform adapts to your unique requirements.</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-area-end -->

        <!-- features-area -->
        <section class="features__area section-pb-90">
            <div class="container">
                <div class="row justify-content-center gutter-24">
                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                        <div class="features__item">
                            <div class="features__icon">
                                <i class="flaticon-warehouse-1"></i>
                            </div>
                            <div class="features__content">
                            <h2 class="title">Smart Inventory Management</h2>
                            <p>Automated warehousing solutions powered by AI for optimal inventory control and fulfillment efficiency.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">
                        <div class="features__item">
                            <div class="features__icon">
                                <i class="flaticon-air-freight"></i>
                            </div>
                            <div class="features__content">
                            <h2 class="title">Express Air Logistics</h2>
                            <p>Lightning-fast air cargo solutions with intelligent routing and carbon-neutral options for urgent deliveries.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="800">
                        <div class="features__item">
                        <div class="flaticon-ship"></i>
                            </div>
                            <div class="features__content">
                            <h2 class="title">Sustainable Ocean Freight</h2>
                            <p>Eco-friendly sea freight services with smart container optimization and environmental impact tracking.</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="features__shape">
                <img src="assets/img/images/features_shape.png" alt="shape" data-aos="fade-left" data-aos-delay="400"
                     class="aos-init aos-animate">
            </div>
        </section>
        <!-- features-area-end -->

        <!-- video-area -->
        <section class="video__area-two section-py-140">
            <div class="video__bg video__bg-two" data-background="assets/img/bg/video_bg02.jpg"
             style="background-image: url(assets/img/bg/video_bg02.jpg);"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="video__content">
                            <div class="section__title white-title mb-30">
                            <span class="sub-title">Innovation & Performance Excellence</span>
                            <h2 class="title">Delivering Results Through Smart Technology</h2>
                            </div>
                            <div class="progress__wrap progress__wrap-two">
                                <div class="progress__item progress__item-two">
                                    <div class="progress__item-top">
                                        <h3 class="progress__title">On-Time Deliveries</h3>
                                    <div class="progress-value"><span class="counter-number">98</span>%</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar"
                                         style="width: 98%; animation: 1.8s ease 0s 1 normal none running animate-positive; opacity: 1;"></div>
                                </div>
                                </div>
                                <div class="progress__item progress__item-two">
                                    <div class="progress__item-top">
                                        <h3 class="progress__title">Customer Satisfaction</h3>
                                    <div class="progress-value"><span class="counter-number">99</span>%</div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar"
                                         style="width: 99%; animation: 1.8s ease 0s 1 normal none running animate-positive; opacity: 1;"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- video-area-end -->

        <!-- counter-area -->
        <section class="counter__area counter__bg section-pt-120 section-pb-90"
                 data-background="assets/img/bg/vector_bg05.svg"
             style="background-image: url(assets/img/bg/vector_bg05.svg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter__item-two">
                            <div class="counter__icon-two">
                                <i class="flaticon-air-plane"></i>
                            </div>
                            <div class="counter__content-two">
                            <h2 class="count"><span class="counter-number">50000</span>+</h2>
                            <p>Smart Shipments Delivered</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter__item-two">
                            <div class="counter__icon-two">
                                <i class="flaticon-parcels"></i>
                            </div>
                            <div class="counter__content-two">
                            <h2 class="count"><span class="counter-number">25</span>+</h2>
                            <p>Innovation Awards</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter__item-two">
                            <div class="counter__icon-two">
                                <i class="flaticon-parcel"></i>
                            </div>
                            <div class="counter__content-two">
                            <h2 class="count"><span class="counter-number">15</span>+</h2>
                            <p>Years of Innovation</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="counter__item-two">
                            <div class="counter__icon-two">
                                <i class="flaticon-protected"></i>
                            </div>
                            <div class="counter__content-two">
                            <h2 class="count"><span class="counter-number">99.9</span>%</h2>
                            <p>Secure Delivery Rate</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- counter-area-end -->

    </main>
    <!-- main-area-end -->

@endsection