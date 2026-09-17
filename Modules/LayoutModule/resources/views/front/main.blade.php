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


    <!-- Start Page Title Area -->
    <div class="page-title-area item-bg3">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h1>{{ $page_title }}</h1>
                        @if ($breadcrumb)
                            <ul>
                                @foreach ($breadcrumb as $item)
                                    <li><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->



    @yield('content')



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
