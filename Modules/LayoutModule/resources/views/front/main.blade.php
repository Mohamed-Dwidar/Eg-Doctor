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
    <!-- MeanMenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/meanmenu.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/front/css/style_custom.css') }}">

<script>
    window.adsbygoogle = window.adsbygoogle || [];
</script>

<script async
    src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-0462453958685277"
    crossorigin="anonymous"></script>

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
        <p>
            <!-- Eg-Doctor Ad-Fly (160x600) -->
            <ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px"
                data-ad-client="ca-pub-0462453958685277" data-ad-slot="5102005112"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </p>
    </div>
    <div class="egd-ad-rail egd-ad-rail-end">
        <p>
            <!-- Eg-Doctor Ad-Fly (160x600) -->
            <ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px"
                data-ad-client="ca-pub-0462453958685277" data-ad-slot="5102005112"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </p>
    </div>
    <!-- End Vertical Ad Rails -->

    @include('layoutmodule::front.header')

<!-- Eg-Doctor - Doctor - Display -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-0462453958685277"
     data-ad-slot="9007900471"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
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



    @yield('content')

    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
            <div class="egd-ad-slot">
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Inner - Bottom - Multiplex -->
                    <ins class="adsbygoogle" style="display:block" data-ad-format="autorelaxed"
                        data-ad-client="ca-pub-0462453958685277" data-ad-slot="5607536505"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </p>
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
                        <a
                            href="{{ $department->seo?->slug ? url($department->seo->slug) : '#' }}">{{ $department->name }}</a>
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
    <!-- Bootstrap Min JS -->
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <!-- MeanMenu JS -->
    <script src="{{ asset('assets/front/js/jquery.meanmenu.js') }}"></script>
    <!-- WOW Min JS -->
    <script src="{{ asset('assets/front/js/wow.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
