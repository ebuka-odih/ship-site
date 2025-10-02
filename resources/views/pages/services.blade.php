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
                            <h1 class="title">Our Services</h1>
                            <nav class="breadcrumb">
                                <span property="itemListElement" typeof="ListItem">
                                <a href="{{ route('home') }}">Home</a>
                                </span>
                                <span class="breadcrumb-separator"><i class="flaticon-right-arrow"></i></span>
                                <span property="itemListElement" typeof="ListItem">Services</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- services-area -->
        <section class="services__area-five grey-bg section-pt-120 section-pb-90">
            <div class="container">
                <div class="text-center">
                <h2>Smart Logistics Solutions</h2>
                <p style="font-size: 20px">
                    {{ \App\Models\Setting::get('company_name', config('app.name')) }} delivers cutting-edge logistics and freight solutions powered by AI and sustainable technology. 
                    From instant same-day delivery to complex international freight, we provide intelligent, eco-friendly 
                    shipping options that adapt to your business needs.
                </p>
                </div>
                <div class="row gutter-24 justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="services__item-three">
                            <div class="services__thumb-three">
                                <a href="#"><img src="assets/img/services/services_img01.jpg" alt="img"></a>
                            </div>
                            <div class="services__content-three">
                                <div class="services__icon-three">
                                    <i class="flaticon-ship"></i>
                                </div>
                            <h4 class="title"><a>Smart Ocean Freight</a></h4>
                            <p>Intelligent sea freight solutions with AI-powered route optimization, carbon-neutral shipping options, 
                                and real-time container tracking for sustainable international trade.</p>
                            </div>
                            <div class="mt-3">
                            <h6 style="text-align: center" class="text-center">Our intelligent services include:</h6>
                                <ul style="list-style: none">
                                <li>✔️ Smart Container Load (FCL) & Less than Container Load (LCL)</li>
                                <li>✔️ Automated door-to-door and port-to-port delivery</li>
                                <li>✔️ AI-powered customs clearance and predictive cargo tracking</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="services__item-three">
                            <div class="services__thumb-three">
                                <a href="#"><img src="assets/img/services/services_img02.jpg" alt="img"></a>
                            </div>
                            <div class="services__content-three">
                                <div class="services__icon-three">
                                    <i class="flaticon-truck"></i>
                                </div>
                            <h4 class="title"><a>Eco Road Freight</a></h4>
                            <p>Electric and hybrid vehicle fleet with smart routing algorithms for fuel-efficient, 
                                carbon-conscious road transportation across domestic and international routes.</p>
                            </div>
                            <div class="mt-3">
                            <h6 style="text-align: center" class="text-center">Our sustainable services include:</h6>
                                <ul style="list-style: none">
                                <li>✔️ Smart truckload (FTL) and less-than-truckload (LTL) optimization</li>
                                <li>✔️ Cross-border logistics with automated customs processing</li>
                                <li>✔️ Temperature-controlled and specialized eco-friendly transport</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="services__item-three">
                            <div class="services__thumb-three">
                            <a href="#"><img src="assets/img/services/services_img03.jpg" alt="img"></a>
                            </div>
                            <div class="services__content-three">
                                <div class="services__icon-three">
                                    <i class="flaticon-airplane"></i>
                                </div>
                            <h4 class="title"><a>Express Air Logistics</a></h4>
                            <p>Lightning-fast air cargo solutions with intelligent routing, carbon offset options, 
                                and predictive delivery windows for time-critical shipments worldwide.</p>
                            </div>
                            <div class="mt-3">
                            <h6 style="text-align: center" class="text-center">Our express services include:</h6>
                                <ul style="list-style: none">
                                <li>✔️ Same-day and next-day air cargo solutions</li>
                                <li>✔️ Smart airport-to-airport and door-to-door services</li>
                                <li>✔️ Automated freight consolidation and customs handling</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="services__item-three">
                            <div class="services__thumb-three">
                            <a href="#"><img src="assets/img/services/services_img04.jpg" alt="img"></a>
                            </div>
                            <div class="services__content-three">
                                <div class="services__icon-three">
                                    <i class="flaticon-train"></i>
                                </div>
                            <h4 class="title"><a>Smart Rail Freight</a></h4>
                            <p>Eco-friendly rail logistics with AI-driven scheduling, intermodal connectivity, 
                                and carbon footprint tracking for sustainable bulk cargo transportation.</p>
                            </div>
                            <div class="mt-3">
                            <h6 style="text-align: center" class="text-center">Our intelligent services include:</h6>
                                <ul style="list-style: none">
                                <li>✔️ AI-optimized long-distance cargo transportation</li>
                                <li>✔️ Smart intermodal connectivity with road and sea freight</li>
                                <li>✔️ Automated handling for bulk shipments with real-time tracking</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="services__item-three">
                            <div class="services__thumb-three">
                            <a href="#"><img src="assets/img/services/services_img07.jpg" alt="img"></a>
                            </div>
                            <div class="services__content-three">
                                <div class="services__icon-three">
                                    <i class="flaticon-warehouse"></i>
                                </div>
                            <h4 class="title"><a>AI Warehouse Management</a></h4>
                            <p>Automated fulfillment centers with robotics, predictive inventory management, 
                                and smart climate control systems for optimal storage and distribution.</p>
                            </div>
                            <div class="mt-3">
                            <h6 style="text-align: center" class="text-center">Our smart services include:</h6>
                                <ul style="list-style: none">
                                <li>✔️ Autonomous climate-controlled storage systems</li>
                                <li>✔️ AI-powered inventory management and distribution</li>
                                <li>✔️ 24/7 security with real-time tracking and analytics</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="services__item-three">
                            <div class="services__thumb-three">
                            <a href="#"><img src="assets/img/services/services_img08.jpg" alt="img"></a>
                            </div>
                            <div class="services__content-three">
                                <div class="services__icon-three">
                                    <i class="flaticon-moving-truck"></i>
                                </div>
                            <h4 class="title"><a>Smart Relocation Services</a></h4>
                            <p>Intelligent moving solutions with automated packing optimization, real-time tracking, 
                                and eco-friendly transport for seamless domestic and international relocations.</p>
                        </div>
                        <div class="mt-3">
                            <h6 style="text-align: center" class="text-center">Our intelligent services include:</h6>
                            <ul style="list-style: none">
                                <li>✔️ AI-optimized packing and loading/unloading systems</li>
                                <li>✔️ Smart domestic and international relocation planning</li>
                                <li>✔️ Automated furniture assembly and setup services</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services-area-end -->

</main>
<!-- main-area-end -->

@endsection