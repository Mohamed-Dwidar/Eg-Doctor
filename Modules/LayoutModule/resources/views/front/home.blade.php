<!doctype html>
<html lang="ar">

<head>
     @include('layoutmodule::front.metas')

    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/animate.min.css') }}">
    <!-- FontAwesome Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome.min.css') }}">
    <!-- FlatIcon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/flaticon.css') }}">
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
    <!-- Image LightBox Min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/imagelightbox.min.css') }}">
    <!-- MeanMenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/meanmenu.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/front/css/style_custom.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/front/img/favicon.png') }}">
</head>

<body>

    <!-- Start Preloader Area -->
    <div class="preloader">
        <div id="global">
            <div id="top" class="mask">
                <div class="plane"></div>
            </div>

            <div id="middle" class="mask">
                <div class="plane"></div>
            </div>

            <div id="bottom" class="mask">
                <div class="plane"></div>
            </div>

            <p><i>LOADING...</i></p>
        </div>
    </div>
    <!-- End Preloader Area -->

    @include('layoutmodule::front.header')

    <!-- Start Main Banner Area -->
    <div class="home-area home-slides owl-carousel owl-theme">
        <div class="main-banner item-bg2"
            style="background-image: url({{ asset('assets/front/img/main-banner1.jpg') }});">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="main-banner-content">
                            <h1>Where Success Begins</h1>

                            <span class="sub-title">The perfect environment for your business to grow</span>
                            {{-- <div class="btn-box">
                                <a href="#" class="default-btn">Book A Room <span></span></a>
                                <a class="optional-btn"
                                    data-ilb2-video='{"controls":"controls", "autoplay":false, "sources":[{"src":"assets/img/video.m4v", "type":"video/mp4"}]}'
                                    data-imagelightbox="video"><i class="flaticon-play-button"></i> Watch Video</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="main-banner item-bg3">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="main-banner-content">
                            <span class="sub-title">The Best Workspace in New York</span>
                            <h1>Professional, Creative, Flexible, Scalable Workspace</h1>

                            <div class="btn-box">
                                <a href="#" class="default-btn">Book A Room <span></span></a>
                                <a class="optional-btn"
                                    data-ilb2-video='{"controls":"controls", "autoplay":false, "sources":[{"src":"assets/img/video.m4v", "type":"video/mp4"}]}'
                                    data-imagelightbox="video"><i class="flaticon-play-button"></i> Watch Video</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- Ens Main Banner Area -->

    <!-- Start Services Boxes Area -->
    <section class="services-boxes-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box">
                        <img src="{{ asset('assets/front/img/services-image/1.jpg') }}" alt="image">

                        <div class="content">
                            <h3><a href="#">Private Offices</a></h3>
                        </div>

                        <div class="hover-content">
                            <h3><a href="#">Private Offices</a></h3>
                            <p>
                                We have different offices with different capacities . It is a great opportunity for
                                freelancers, small business owners and startups. Focus on growing your business and let
                                us help you with the rest.
                            </p>

                            {{-- <a href="#" class="read-more-btn">Learn More</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box">
                        <img src="{{ asset('assets/front/img/services-image/2.jpg') }}" alt="image">

                        <div class="content">
                            <h3><a href="#">Shared Space</a></h3>
                        </div>

                        <div class="hover-content">
                            <h3><a href="#">Shared Space</a></h3>
                            <p>
                                Our shared space is ideal for freelancers, entrepreneurs and students.
                                You no longer need to suffer sitting alone at home or getting distracted in a crowded
                                coffee shop.
                            </p>

                            {{-- <a href="#" class="read-more-btn">Learn More</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                    <div class="single-box">
                        <img src="{{ asset('assets/front/img/services-image/3.jpg') }}" alt="image">

                        <div class="content">
                            <h3><a href="#">Meetings & Events</a></h3>
                        </div>

                        <div class="hover-content">
                            <h3><a href="#">Meetings & Events</a></h3>
                            <p>
                                We would be happy to setup the event room to match with your requirement.
                                With tables, chairs, a projector, WiFi and drinks, you will be ready to make your event
                                a success.
                            </p>

                            {{-- <a href="#" class="read-more-btn">Learn More</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Boxes Area -->

    <!-- Start About Area -->
    <section class="about-area ptb-100" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-title">
                        <span>About Us</span>
                        <h2>Pivot offer creative working environments that suit your business</h2>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-text">
                        <p>
                            Pivot is a coworking space that provides affordable office space with essential work
                            necessities like private offices, meeting rooms, events venues, virtual offices, high-speed
                            internet, and leading technologies to move your business forward. At Pivot, we are more than
                            just a coworking workspace, we are a coworking community for all types of people and
                            businesses. We are excited to offer an inviting and modern workspace to business owners and
                            remote office workers at an affordable rate.
                        </p>

                        {{-- <a href="#" class="read-more-btn">More About Pivot <i class="flaticon-next"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <!-- Start Services Area -->
    <section class="services-area" id="services">
        <div class="container">
            <div class="services-slides owl-carousel owl-theme">
                <div class="single-services-box">
                    <!-- Virtual Offices -->
                    <div class="icon">
                        <i class="flaticon-university"></i>

                        <div class="icon-bg">
                            <img src="{{ asset('assets/front/img/icon-bg1.png') }}" alt="image">
                            <img src="{{ asset('assets/front/img/icon-bg2.png') }}" alt="image">
                        </div>
                    </div>

                    <h3><a href="#">Virtual Offices</a></h3>

                    <p>Pivot provides a virtual office service that enables you to benefit from the services of a
                        physical office without having an office.</p>

                    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

                    <div class="box-shape">
                        <img src="{{ asset('assets/front/img/box-shape1.png') }}" alt="image">
                        <img src="{{ asset('assets/front/img/box-shape2.png') }}" alt="image">
                    </div>
                </div>

                <div class="single-services-box">
                    <!-- Full-Time Offices -->
                    <div class="icon">
                        <i class="flaticon-work"></i>

                        <div class="icon-bg">
                            <img src="{{ asset('assets/front/img/icon-bg1.png') }}" alt="image">
                            <img src="{{ asset('assets/front/img/icon-bg2.png') }}" alt="image">
                        </div>
                    </div>

                    <h3><a href="#">Full-Time Offices</a></h3>

                    <p>
                        Have different offices with different capacities.
                        It is a great opportunity for business owners and startups
                    </p>

                    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

                    {{-- <div class="box-shape">
                        <img src="{{ asset('assets/front/img/box-shape1.png')}}" alt="image">
                        <img src="{{ asset('assets/front/img/box-shape2.png')}}" alt="image">
                    </div> --}}
                </div>

                <div class="single-services-box">
                    <!-- Conference Rooms -->
                    <div class="icon">
                        <i class="flaticon-room"></i>

                        <div class="icon-bg">
                            <img src="{{ asset('assets/front/img/icon-bg1.png') }}" alt="image">
                            <img src="{{ asset('assets/front/img/icon-bg2.png') }}" alt="image">
                        </div>
                    </div>

                    <h3><a href="#">Conference Rooms</a></h3>

                    <p>
                        We would be happy to setup the event room to match with your requirements.
                        With tables, chairs, a projector, WiFi and drinks, you will be ready to make your event a
                        success.
                    </p>

                    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

                    <div class="box-shape">
                        <img src="{{ asset('assets/front/img/box-shape1.png') }}" alt="image">
                        <img src="{{ asset('assets/front/img/box-shape2.png') }}" alt="image">
                    </div>
                </div>

                <div class="single-services-box">
                    <!-- Shared Space -->
                    <div class="icon">
                        <i class="flaticon-location"></i>

                        <div class="icon-bg">
                            <img src="{{ asset('assets/front/img/icon-bg1.png') }}" alt="image">
                            <img src="{{ asset('assets/front/img/icon-bg2.png') }}" alt="image">
                        </div>
                    </div>

                    <h3><a href="#">Shared Space</a></h3>

                    <p>
                        You no longer need to suffer sitting alone at home or getting distracted in a crowded coffee
                        shop! Our shared space can be a daily or monthly basis. Enjoy our beverages and snacks as well.
                    </p>

                    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

                    <div class="box-shape">
                        <img src="{{ asset('assets/front/img/box-shape1.png') }}" alt="image">
                        <img src="{{ asset('assets/front/img/box-shape2.png') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Area -->

    <!-- Start Partner Area -->
    {{-- <section class="partner-area ptb-100 bg-f8f8f8">
        <div class="container">
            <div class="partner-title">
                <h2>Trusted by 20,000 Companies</h2>
            </div>

            <div class="partner-slides owl-carousel owl-theme">
                <div class="single-partner-item">
                    <a href="#">
                        <img src="{{ asset('assets/front/img/partner-image/1.png')}}" alt="image">
                    </a>
                </div>

                <div class="single-partner-item">
                    <a href="#">
                        <img src="{{ asset('assets/front/img/partner-image/2.png')}}" alt="image">
                    </a>
                </div>

                <div class="single-partner-item">
                    <a href="#">
                        <img src="{{ asset('assets/front/img/partner-image/3.png')}}" alt="image">
                    </a>
                </div>

                <div class="single-partner-item">
                    <a href="#">
                        <img src="{{ asset('assets/front/img/partner-image/4.png')}}" alt="image">
                    </a>
                </div>

                <div class="single-partner-item">
                    <a href="#">
                        <img src="{{ asset('assets/front/img/partner-image/5.png')}}" alt="image">
                    </a>
                </div>

                <div class="single-partner-item">
                    <a href="#">
                        <img src="{{ asset('assets/front/img/partner-image/6.png')}}" alt="image">
                    </a>
                </div>

                <div class="single-partner-item">
                    <a href="#">
                        <img src="{{ asset('assets/front/img/partner-image/7.png')}}" alt="image">
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Partner Area -->

    <!-- Start Why Choose Us Area -->
    <section class="why-choose-us-area" id="why-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="why-choose-us-image">
                        <img src="{{ asset('assets/front/img/why-choose-img1.jpg') }}" alt="image">
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="why-choose-us-content">
                        <div class="content">
                            {{-- <span class="sub-title">Your Benefits</span> --}}
                            <h2>Why Choose Pivot</h2>
                            <p>
                                We provide you with countless opportunities to run your business with no hassles.
                                Giving you the opportunity to forgo investment costs, Pivot has created an environment
                                where the only decision you have to deal with is choosing which service would suit you
                                best.
                            </p>

                            <ul class="features-list">

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-wifi"></i>
                                    </div>
                                    <span>High Speed Wifi</span>

                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-location"></i>
                                    </div>
                                    <span>Great Location</span>

                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="fas fa-pray"></i>
                                    </div>
                                    <span>Prayer Room</span>

                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="fas fa-coffee"></i>
                                    </div>
                                    <span>Break Area</span>
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="fas fa-air-freshener"></i>
                                    </div>
                                    <span>Air Conditioner</span>

                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="fas fa-print"></i>
                                    </div>
                                    <span>Printer / Fax / Copy</span>

                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Us Area -->

    <!-- Start Pricing Area -->
    <section class="pricing-area ptb-100" id="packages">
        <div class="container">
            <div class="section-title">
                {{-- <span class="sub-title">Our Plan</span> --}}
                <h2>Pivot Pricing Packages</h2>
                <p>Our packages are tailored to match each and every need. Be assured that at Pivot, you will have
                    something created to match with what you desire.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-pricing-box">
                        <div class="pricing-header bg1">
                            <h3>Shared Space</h3>
                        </div>

                        <div class="price">
                            120<sub>LE/day</sub>
                        </div>

                        <div class="book-now-btn">
                            <a href="#footer-area" class="default-btn">Book Now <span></span></a>
                        </div>

                        <ul class="pricing-features-list">
                            <li><i class="flaticon-check-mark"></i> 24/7 Access</li>
                            <li><i class="flaticon-check-mark"></i> Cleaning Service</li>
                            <li><i class="flaticon-check-mark"></i> High Speed Wifi/ Internet</li>
                            <li><i class="flaticon-check-mark"></i> Opening Hours (9:00am – 12:00am)</li>
                            <li><i class="flaticon-check-mark"></i> Utilities Included</li>
                            <li><i class="flaticon-check-mark"></i> Access to Kitchen Lounge</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                    <div class="single-pricing-box">
                        <div class="pricing-header bg3">
                            <h3>Dedicated Desk</h3>
                        </div>

                        <div class="price">
                            <sub style="text-transform: lowercase">start</sub>1650<sub>LE/month</sub>
                        </div>

                        <div class="book-now-btn">
                            <a href="#footer-area" class="default-btn">Book Now <span></span></a>
                        </div>

                        <ul class="pricing-features-list">
                            <li><i class="flaticon-check-mark"></i> 24/7 Access</li>
                            <li><i class="flaticon-check-mark"></i> Cleaning Service</li>
                            <li><i class="flaticon-check-mark"></i> High Speed Wifi/ Internet</li>
                            <li><i class="flaticon-check-mark"></i> Opening Hours (9:00am – 12:00am)</li>
                            <li><i class="flaticon-check-mark"></i> Utilities Included</li>
                            <li><i class="flaticon-check-mark"></i> Access to Kitchen Lounge</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-pricing-box">
                        <div class="pricing-header bg2">
                            <h3>Virtual Office</h3>
                        </div>

                        <div class="price">
                            <sub style="text-transform: lowercase">start</sub>7000<sub>LE/month</sub>
                        </div>

                        <div class="book-now-btn">
                            <a href="#footer-area" class="default-btn">Book Now <span></span></a>
                        </div>

                        <ul class="pricing-features-list">
                            <li><i class="flaticon-check-mark"></i> Have a reliable address</li>
                            <li><i class="flaticon-check-mark"></i> Establish and document your company
                                on a reliable address</li>
                            <li><i class="flaticon-check-mark"></i> Receive postal mails</li>
                            <li><i class="flaticon-check-mark"></i> Possibility to reserve meeting rooms and halls on
                                an
                                hourly and daily basis</li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Area -->

    <!-- Start Join Area -->
    {{-- <section class="join-area ptb-100 jarallax" data-jarallax='{"speed": 0.3}'>
        <div class="container">
            <div class="join-content">
                <h2>Zash is a community where everyone is welcome.</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                <a href="#" class="default-btn">Join Now <i class="flaticon-right-chevron"></i><span></span></a>
            </div>
        </div>
    </section> --}}
    <!-- End Join Area -->

    <!-- Start Feedback Area -->
    {{-- <div class="feedback-area ptb-100">
        <div class="container">
            <div class="feedback-slides owl-carousel owl-theme">
                <div class="single-feedback-item">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna. Quis ipsum suspendisse ultrices gravida.</p>

                    <div class="client">
                        <img src="{{ asset('assets/front/img/partner-image/1.png')}}" alt="image">
                    </div>
                </div>

                <div class="single-feedback-item">
                    <p>Quis ipsum suspendisse ultrices gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna.</p>

                    <div class="client">
                        <img src="{{ asset('assets/front/img/partner-image/2.png')}}" alt="image">
                    </div>
                </div>

                <div class="single-feedback-item">
                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna, lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Quis ipsum suspendisse ultrices gravida.</p>

                    <div class="client">
                        <img src="{{ asset('assets/front/img/partner-image/3.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Feedback Area -->

    <!-- Start Our Mission Area -->
    {{-- <section class="our-mission-area">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-3 col-md-6 p-0">
                    <div class="mission-image bg-1">
                        <img src="{{ asset('assets/front/img/mission-img1.jpg')}}" alt="image">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 p-0">
                    <div class="mission-text">
                        <div class="icon">
                            <i class="flaticon-target"></i>
                        </div>

                        <h3>Our Mission</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et.</p>

                        <a href="#" class="default-btn">Learn More <span></span></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 p-0">
                    <div class="mission-image bg-2">
                        <img src="{{ asset('assets/front/img/mission-img2.jpg')}}" alt="image">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 p-0">
                    <div class="mission-text">
                        <div class="icon">
                            <i class="flaticon-award"></i>
                        </div>

                        <h3>Our History</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et.</p>

                        <a href="#" class="default-btn">Learn More <span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Our Mission Area -->

    <!-- Start Team Area -->
    {{-- <section class="team-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Our Team</span>
                <h2>Meet Our Experts</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>

            <div class="team-slides owl-carousel owl-theme">
                <div class="single-team-box">
                    <div class="image">
                        <img src="{{ asset('assets/front/img/team-image/2.jpg')}}" alt="image">

                        <ul class="social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>

                    <div class="content">
                        <h3>Lee Munroe</h3>
                        <span>Lead Designer</span>
                    </div>
                </div>

                <div class="single-team-box">
                    <div class="image">
                        <img src="{{ asset('assets/front/img/team-image/3.jpg')}}" alt="image">

                        <ul class="social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>

                    <div class="content">
                        <h3>Calvin Klein</h3>
                        <span>Lead Developer</span>
                    </div>
                </div>

                <div class="single-team-box">
                    <div class="image">
                        <img src="{{ asset('assets/front/img/team-image/4.jpg')}}" alt="image">

                        <ul class="social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>

                    <div class="content">
                        <h3>Sarah Taylor</h3>
                        <span>Lead Architecure</span>
                    </div>
                </div>

                <div class="single-team-box">
                    <div class="image">
                        <img src="{{ asset('assets/front/img/team-image/1.jpg')}}" alt="image">

                        <ul class="social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>

                    <div class="content">
                        <h3>Alastair Cook</h3>
                        <span>Marketing Manager</span>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Team Area -->

    <!-- Start Place Area -->
    {{-- <section class="place-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="place-content">
                        <span class="sub-title">Our Place</span>
                        <h2>Building & Area</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>

                        <ul class="features-list">
                            <li>
                                <div class="icon">
                                    <i class="flaticon-parking"></i>
                                </div>
                                <span>Parking Area</span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit
                            </li>

                            <li>
                                <div class="icon">
                                    <i class="flaticon-breakfast"></i>
                                </div>
                                <span>Restaurants</span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit
                            </li>

                            <li>
                                <div class="icon">
                                    <i class="flaticon-shop"></i>
                                </div>
                                <span>Supermarket</span>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="place-image-slides owl-carousel owl-theme">
                        <div class="single-place-image bg1">
                            <img src="{{ asset('assets/front/img/place-img1.jpg')}}" alt="image">
                        </div>

                        <div class="single-place-image bg2">
                            <img src="{{ asset('assets/front/img/place-img2.jpg')}}" alt="image">
                        </div>

                        <div class="single-place-image bg3">
                            <img src="{{ asset('assets/front/img/place-img3.jpg')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Place Area -->

    <!-- Start Blog Area -->
    {{-- <section class="blog-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Our Blog</span>
                <h2>News and Insights</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-post">
                        <div class="post-image">
                            <a href="#l"><img src="{{ asset('assets/front/img/blog-image/1.jpg')}}" alt="image"></a>

                            <div class="date"><i class="flaticon-calendar"></i> Oct 14, 2021</div>
                        </div>

                        <div class="post-content">
                            <h3><a href="#">Why Business Absolutely Needs a Virtual Office</a></h3>
                            <p>Quis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel
                                facilisis.</p>

                            <a href="#" class="default-btn">Read More <span></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-post">
                        <div class="post-image">
                            <a href="#"><img src="{{ asset('assets/front/img/blog-image/2.jpg')}}" alt="image"></a>

                            <div class="date"><i class="flaticon-calendar"></i> Oct 10, 2021</div>
                        </div>

                        <div class="post-content">
                            <h3><a href="#">6 Design Trends to Look For in Coworking Spaces</a></h3>
                            <p>Quis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel
                                facilisis.</p>

                            <a href="#" class="default-btn">Read More <span></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
                    <div class="single-blog-post">
                        <div class="post-image">
                            <a href="#"><img src="{{ asset('assets/front/img/blog-image/3.jpg')}}" alt="image"></a>

                            <div class="date"><i class="flaticon-calendar"></i> Sep 13, 2021</div>
                        </div>

                        <div class="post-content">
                            <h3><a href="#">5 Ways to Work Remotely Without Being Overlooked</a></h3>
                            <p>Quis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel
                                facilisis.</p>

                            <a href="#" class="default-btn">Read More <span></span></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="blog-notes">
                        <p>Insights to help you do what you do better, faster and more profitably. <a href="#">Read Full
                                Blog</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Blog Area -->


    @include('layoutmodule::front.footer')


    <div class="go-top"><i class="fas fa-chevron-up"></i><i class="fas fa-chevron-up"></i></div>

    <!-- jQuery Min JS -->
    <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <!-- Popper Min JS -->
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <!-- Bootstrap Min JS -->
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <!-- MixItUp Min JS -->
    <script src="{{ asset('assets/front/js/mixitup.min.js') }}"></script>
    <!-- Parallax Min JS -->
    <script src="{{ asset('assets/front/js/parallax.min.js') }}"></script>
    <!-- Owl Carousel Min JS -->
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <!-- MeanMenu JS -->
    <script src="{{ asset('assets/front/js/jquery.meanmenu.js') }}"></script>
    <!-- Image LightBox Min JS -->
    <script src="{{ asset('assets/front/js/imagelightbox.min.js') }}"></script>
    <!-- WOW Min JS -->
    <script src="{{ asset('assets/front/js/wow.min.js') }}"></script>
    <!-- AjaxChimp Min JS -->
    <script src="{{ asset('assets/front/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Form Validator Min JS -->
    <script src="{{ asset('assets/front/js/form-validator.min.js') }}"></script>
    <!-- Contact Form Min JS -->
    <script src="{{ asset('assets/front/js/contact-form-script.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
</body>

</html>
