<!doctype html>
<html lang="ar" dir="rtl">

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
</head>

<body class="egd-home">

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

            <p><i>جاري التحميل...</i></p>
        </div>
    </div>
    <!-- End Preloader Area -->

    <!-- Start Vertical Ad Rails (visible on wide desktop screens only) -->
    {{-- Google AdSense placement — swap each placeholder for your real <ins class="adsbygoogle"> unit --}}
    <div class="egd-ad-rail egd-ad-rail-start">
        <span class="egd-ad-tag">إعلان</span>
        <p>مساحة إعلانية عمودية<br>(160×600)</p>
    </div>
    <div class="egd-ad-rail egd-ad-rail-end">
        <span class="egd-ad-tag">إعلان</span>
        <p>مساحة إعلانية عمودية<br>(160×600)</p>
    </div>
    <!-- End Vertical Ad Rails -->

    @include('layoutmodule::front.header')

    <!-- Start Page Hero -->
    <section class="egd-page-hero">
        <div class="container">
            <div class="egd-page-hero-content">
                <h1>{{ $page_title ?? '' }}</h1>
                @if ($breadcrumb ?? false)
                    <ul class="egd-breadcrumb">
                        @foreach ($breadcrumb as $item)
                            <li><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
    <!-- End Page Hero -->

    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
            <div class="egd-ad-slot">
                <span class="egd-ad-tag">إعلان</span>
                <p>مساحة إعلانية (728×90 على الشاشات الكبيرة / 320×50 على الجوال)</p>
            </div>
        </div>
    </div>
    <!-- End Ad Slot -->

    @yield('content')

    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
            <div class="egd-ad-slot">
                <span class="egd-ad-tag">إعلان</span>
                <p>مساحة إعلانية (728×90 على الشاشات الكبيرة / 320×50 على الجوال)</p>
            </div>
        </div>
    </div>
    <!-- End Ad Slot -->

    <!-- Start Departments Search -->
    @if (($departments ?? collect())->isNotEmpty())
        <section class="egd-section egd-section-soft egd-dept-search-section">
            <div class="container">
                <div class="egd-title">
                    <h2>ابحث فى الاقسام الطبية عن</h2>
                </div>
                <div class="egd-dept-search">
                    @foreach ($departments as $department)
                        <a href="{{ $department->seo?->slug ? url($department->seo->slug) : '#' }}">{{ $department->name }}</a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- End Departments Search -->

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
