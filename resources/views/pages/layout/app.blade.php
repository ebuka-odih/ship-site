<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from shiphublogistics.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Oct 2025 12:48:50 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ \App\Models\Setting::get('company_name', config('app.name')) }}</title>
    <meta name="description" content="{{ \App\Models\Setting::get('company_name', config('app.name')) }} - Transport & Logistics Solutions">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/odometer.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/default-icons.css">
    <link rel="stylesheet" href="assets/css/main.css">

   @if(\App\Models\Setting::get('livechat_script'))
       {!! \App\Models\Setting::get('livechat_script') !!}
   @endif

   <style>
   /* Fix for fixed navigation menu spacing */
   .tg-header__area {
       position: fixed !important;
       top: 0;
       left: 0;
       right: 0;
       z-index: 999;
       background: rgba(0, 0, 0, 0.95);
       backdrop-filter: blur(10px);
       box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
   }

   /* Hide header top section */
   .tg-header__top {
       display: none !important;
   }

   .tg-header__top .container {
       max-width: none;
       padding: 0 20px;
   }

   /* Style header top info */
   .tg-header__top-info {
       display: flex;
       flex-wrap: nowrap;
       align-items: center;
       justify-content: space-between;
       gap: 15px;
       margin: 0;
       padding: 0;
       list-style: none;
       white-space: nowrap;
       width: 100%;
   }

   .tg-header__top-info li {
       display: flex;
       align-items: center;
       gap: 5px;
       font-size: 12px;
       color: #ffffff;
       white-space: nowrap;
       flex: 1;
       justify-content: center;
   }

   .tg-header__top-info li:first-child {
       justify-content: flex-start;
   }

   .tg-header__top-info li:last-child {
       justify-content: flex-end;
   }

   .tg-header__top-info li i {
       font-size: 13px;
       color: #ff6b35;
       flex-shrink: 0;
   }

   .tg-header__top-info li a {
       color: #ffffff;
       text-decoration: none;
       white-space: nowrap;
   }

   .tg-header__top-info li a:hover {
       color: #ff6b35;
   }

   /* Add separators between items */
   .tg-header__top-info li:not(:last-child)::after {
       content: "|";
       color: rgba(255, 255, 255, 0.3);
       margin-left: 15px;
       font-size: 12px;
   }

   /* Add top padding to body to account for fixed header */
   body {
       padding-top: 0;
   }

   /* Fix homepage banner spacing - eliminate white space */
   .slider__area {
       margin-top: 0 !important;
       padding-top: 0 !important;
   }

   .slider__area .container {
       padding-top: 120px !important;
   }

   /* Adjust banner sections to account for fixed header */
   .breadcrumb__area {
       padding-top: 0 !important;
       margin-top: 0 !important;
       margin-bottom: 0 !important;
   }

   /* Fix breadcrumb area background to start immediately below header */
   .breadcrumb__bg {
       background-position: center top !important;
       background-size: cover !important;
   }

   /* Ensure breadcrumb content is positioned correctly */
   .breadcrumb__area .container {
       padding-top: 120px !important;
       padding-bottom: 60px !important;
   }

   /* Fix header text collision with navigation menu */
   .breadcrumb__content {
       max-width: 60%;
       padding-right: 2rem;
       margin-top: 20px;
   }

   .breadcrumb__content .title {
       font-size: 2.5rem;
       line-height: 1.2;
       margin-bottom: 1rem;
       word-wrap: break-word;
   }

   /* Ensure proper spacing on mobile */
   @media (max-width: 768px) {
       body {
           padding-top: 0;
       }
       
             /* Fix homepage banner on mobile */
             .slider__area .container {
                 padding-top: 100px !important;
             }
       
       /* Adjust header top on mobile */
       .tg-header__top {
           padding: 8px 0;
           min-height: 40px;
       }
       
       .tg-header__top .container {
           padding: 0 15px;
       }
       
       .tg-header__top-info {
           gap: 10px;
           justify-content: space-between;
           flex-wrap: wrap;
       }
       
       .tg-header__top-info li {
           font-size: 10px;
           flex: 1;
           min-width: 120px;
           justify-content: center;
       }
       
       .tg-header__top-info li:first-child {
           justify-content: flex-start;
       }
       
       .tg-header__top-info li:last-child {
           justify-content: flex-end;
       }
       
       .tg-header__top-info li i {
           font-size: 11px;
       }
       
       .tg-header__top-info li:not(:last-child)::after {
           margin-left: 8px;
           font-size: 10px;
       }
       
       .breadcrumb__area {
           padding-top: 0 !important;
       }
       
             /* Fix breadcrumb container on mobile */
             .breadcrumb__area .container {
                 padding-top: 100px !important;
                 padding-bottom: 40px !important;
             }
       
       .breadcrumb__content {
           max-width: 100%;
           padding-right: 1rem;
           text-align: center;
           margin-top: 15px;
       }
       
       .breadcrumb__content .title {
           font-size: 2rem;
       }
   }

   /* Fix for tablet screens */
   @media (min-width: 769px) and (max-width: 1024px) {
       body {
           padding-top: 0;
       }
       
             /* Fix homepage banner on tablet */
             .slider__area .container {
                 padding-top: 110px !important;
             }
       
       .breadcrumb__area {
           padding-top: 0 !important;
       }
       
             /* Fix breadcrumb container on tablet */
             .breadcrumb__area .container {
                 padding-top: 110px !important;
                 padding-bottom: 50px !important;
             }
       
       .breadcrumb__content {
           max-width: 70%;
       }
   }

   /* Ensure header stays on top */
   .tg-header__top {
       position: relative;
       z-index: 1000;
   }

   /* Smooth scrolling for anchor links */
   html {
       scroll-behavior: smooth;
   }


   /* Mobile Menu Styling */
   .tgmobile__menu {
       position: fixed;
       top: 0;
       right: -100%;
       width: 70%;
       max-width: 300px;
       height: 100vh;
       background: #ffffff;
       z-index: 9999;
       transition: right 0.3s ease-in-out;
       box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
   }

   .tgmobile__menu.active {
       right: 0;
   }

   .tgmobile__menu-box {
       padding: 20px;
       height: 100%;
       display: flex;
       flex-direction: column;
   }

   .tgmobile__menu-box .close-btn {
       position: absolute;
       top: 15px;
       right: 15px;
       cursor: pointer;
       color: #ff6b35;
       font-size: 24px;
       z-index: 10000;
   }

   .tgmobile__menu-box .nav-logo {
       margin-bottom: 30px;
       padding-top: 10px;
   }

   .tgmobile__menu-box .nav-logo h3 {
       color: #000;
       font-size: 18px;
       font-weight: bold;
       margin: 0;
   }

   .tgmobile__menu-box .nav-logo a {
       text-decoration: none;
       color: #000;
   }

   .tgmobile__search {
       margin-bottom: 30px;
   }

   .tgmobile__search form {
       display: flex;
       border: 1px solid #ddd;
       border-radius: 5px;
       overflow: hidden;
   }

   .tgmobile__search input {
       flex: 1;
       padding: 10px;
       border: none;
       outline: none;
   }

   .tgmobile__search button {
       background: #ff6b35;
       color: white;
       border: none;
       padding: 10px 15px;
       cursor: pointer;
   }

   .tgmobile__menu-outer-custom {
       flex: 1;
   }

   .tgmobile__menu-outer-custom ul {
       list-style: none;
       padding: 0;
       margin: 0;
   }

   .tgmobile__menu-outer-custom li {
       border-bottom: 1px solid #eee;
   }

   .tgmobile__menu-outer-custom li:last-child {
       border-bottom: none;
   }

   .tgmobile__menu-outer-custom a {
       display: block;
       padding: 15px 0;
       color: #333;
       text-decoration: none;
       font-size: 16px;
       transition: color 0.3s ease;
   }

   .tgmobile__menu-outer-custom a:hover {
       color: #ff6b35;
   }

   .tgmobile__menu-backdrop {
       position: fixed;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background: rgba(0, 0, 0, 0.5);
       z-index: 9998;
       opacity: 0;
       visibility: hidden;
       transition: all 0.3s ease-in-out;
   }

   .tgmobile__menu-backdrop.active {
       opacity: 1;
       visibility: visible;
   }

   /* Mobile menu toggle button */
   .mobile-nav-toggler {
       cursor: pointer;
       padding: 5px;
   }

   .mobile-nav-toggler i {
       font-size: 24px;
       color: #ff6b35;
   }

   /* Responsive adjustments */
   @media (max-width: 768px) {
       .tgmobile__menu {
           width: 80%;
           max-width: 280px;
       }
   }

   @media (max-width: 480px) {
       .tgmobile__menu {
           width: 85%;
           max-width: 250px;
       }
   }
   </style>

</head>

<body class="theme-red">

<!--Preloader-->
<div id="preloader">
    <div class="tg-preloader-block">
        <div class="tg-spinner-eff">
            <div class="tg-bar tg-bar-top"></div>
            <div class="tg-bar tg-bar-right"></div>
            <div class="tg-bar tg-bar-bottom"></div>
            <div class="tg-bar tg-bar-left"></div>
        </div>
    </div>
</div>
<!--Preloader-end -->

<!-- Scroll-top -->
<button class="scroll__top scroll-to-target" data-target="html">
    <i class="fas fa-angle-up"></i>
</button>
<!-- Scroll-top-end-->

<!-- header-area -->
<header class="transparent-header">
    <div class="tg-header__top tg-header__top-three">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7">
                    <ul class="tg-header__top-info tg-header__top-info-three left-side list-wrap">
                        <li><i class="flaticon-location-1"></i>514 Kingsway Business Park, Manchester, M19 3WH, United Kingdom</li>
                        <li><i class="flaticon-envelope"></i><a
                                href="mailto:support@shiphublogistics.com">support@shiphublogistics.com</a></li>
                        <li><i class="flaticon-time"></i>Mon – Sun: 9.00 am – 8.00pm</li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-header" class="tg-header__area tg-header__area-three">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tgmenu__wrap">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <h3 class="text-white">{{ \App\Models\Setting::get('company_name', config('app.name')) }}</h3>
                            </a>
                        </div>
                        <div class="logo d-none">
                            <a href="{{ route('home') }}">
                                <h3 class="text-white">{{ \App\Models\Setting::get('company_name', config('app.name')) }}</h3>
                            </a>
                        </div>
                        <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                            <ul class="navigation">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('services') }}">Our Services</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('contact') }}">Contacts</a></li>
                            </ul>
                        </div>
                        <div class="tgmenu__action tgmenu__action-three d-none d-md-flex">
                            <ul class="list-wrap">

                                <li class="header-btn">
                                    <a href="{{ route('contact') }}" class="btn btn-three">Get A Quote <img
                                            src="assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="mobile-nav-toggler mobile-nav-toggler-two">
                            <i style="color: red" class="tg-flaticon-menu-1"></i>
                        </div>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn"><i class="fas fa-times"></i></div>
                            <div class="nav-logo">
                                <a href="{{ route('home') }}">
                                    <h3>{{ \App\Models\Setting::get('company_name', config('app.name')) }}</h3>
                                </a>
                            </div>
                            <div class="tgmobile__search d-none">
                                <form action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                            <div class="tgmobile__menu-outer-custom">
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('services') }}">Our Services</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('contact') }}">Contacts</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                    <!-- End Mobile Menu -->

                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->

@yield('content')

<!-- footer-area -->
<footer class="footer__area-two fix">
    <div class="container">
        <div class="footer__top">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="footer__widget">
                        <div class="footer__logo">
                            <a href="{{ route('home') }}">
                                <h3 class="text-white">{{ \App\Models\Setting::get('company_name', config('app.name')) }}</h3>
                            </a>
                        </div>
                        <div class="footer__content footer__content-two">
                            <p>Delivering efficiency, speed, and reliability in global freight and warehousing solutions. From air freight to road transport, we ensure your goods reach their destination on time and intact.</p>
                        </div>
                        <div class="copyright-text copyright-text-two">
                            <p>Copyright <a href="{{ route('home') }}">©{{ \App\Models\Setting::get('company_name', config('app.name')) }}</a> | All Right Reserved</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h4 class="footer__widget-title footer__widget-title-two">Our Services</h4>
                        <div class="footer__link footer__link-two">
                            <ul class="list-wrap">
                                <li><a href="{{ route('services') }}">Air Freight</a></li>
                                <li><a href="{{ route('services') }}">Smart Warehousing</a></li>
                                <li><a href="{{ route('services') }}">Train Freight</a></li>
                                <li><a href="{{ route('services') }}">Ocean Freight</a></li>
                                <li><a href="{{ route('services') }}">Road Freight</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h4 class="footer__widget-title footer__widget-title-two">Quick Links</h4>
                        <div class="footer__link footer__link-two">
                            <ul class="list-wrap">
                                <li><a href="{{ route('about') }}">How it's Work</a></li>
                                <li><a href="#contact">Contact Us</a></li>
                                <li><a href="#contact">Get a Quote</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer__widget">
                        <h4 class="footer__widget-title footer__widget-title-two">Information</h4>
                        <div class="footer__info-wrap footer__info-wrap-two">
                            <ul class="list-wrap">
                                <li>
                                    <i class="flaticon-location-1"></i>
                                    <p>514 Kingsway Business Park, Manchester, M19 3WH, <br>United Kingdom</p>
                                </li>
                                <li>
                                    <i class="flaticon-envelope"></i>
                                    <a href="mailto:support@shiphublogistics.com">support@shiphublogistics.com</a>
                                </li>
                                <li>
                                    <i class="flaticon-time"></i>
                                    <p>Mon – Sat: 8 am – 5 pm, <br> Sunday: <span>CLOSED</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__shape footer__shape-two">
        <img src="assets/img/images/inner_footer_shape01.svg" alt="shape" data-aos="fade-down" data-aos-delay="400">
        <img src="assets/img/images/inner_footer_shape02.svg" alt="shape" data-aos="fade-left" data-aos-delay="400">
    </div>
</footer>
<!-- footer-area-end -->


<!-- JS here -->
<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/jquery.appear.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/svg-inject.min.js"></script>
<script src="assets/js/ajax-form.js"></script>
<script src="assets/js/jquery.marquee.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/main.js"></script>

<script>
    SVGInject(document.querySelectorAll("img.injectable"));

    // Mobile Menu Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.querySelector('.mobile-nav-toggler');
        const mobileMenu = document.querySelector('.tgmobile__menu');
        const mobileMenuBackdrop = document.querySelector('.tgmobile__menu-backdrop');
        const closeBtn = document.querySelector('.tgmobile__menu .close-btn');

        // Open mobile menu
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.add('active');
                mobileMenuBackdrop.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        // Close mobile menu
        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileMenuBackdrop.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeMobileMenu);
        }

        if (mobileMenuBackdrop) {
            mobileMenuBackdrop.addEventListener('click', closeMobileMenu);
        }

        // Close menu when clicking on menu links
        const mobileMenuLinks = document.querySelectorAll('.tgmobile__menu-outer-custom a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    });
</script>
</body>


<!-- Mirrored from themeadapt.com/tf/logistex/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Mar 2025 16:31:56 GMT -->

<!-- Mirrored from shiphublogistics.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Oct 2025 12:49:47 GMT -->
</html>
