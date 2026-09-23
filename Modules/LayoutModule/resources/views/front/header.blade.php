    <!-- Start Top Bar -->
    <div class="egd-topbar d-none d-md-block">
        <div class="container">
            <div class="egd-topbar-info">
                <span><i class="fas fa-map-marker-alt"></i> الدليل الطبي للأطباء في جميع محافظات مصر</span>
            </div>
            <div class="egd-topbar-social">
                <a href="http://www.facebook.com/EgyptianDoctorsGuide" aria-label="فيسبوك"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="تويتر"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="انستقرام"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="يوتيوب"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->

    <!-- Start Header -->
    <header class="egd-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand egd-logo" href="{{ route('home_page') }}">
                    <img src="{{ asset('assets/front/img/logo_main.png') }}" alt="إيجي دكتور - دليل الأطباء المصري"
                        width="200" height="80">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="egdNavbarContent">
                    <ul class="navbar-nav mx-lg-auto">
                        <li class="nav-item @if (request()->is('/')) active @endif">
                            <a href="{{ route('home_page') }}" class="nav-link">الرئيسية</a>
                        </li>
                        <li class="nav-item"><a href="/الأطباء" class="nav-link">الأطباء</a></li>
                        <li class="nav-item"><a href="/المجالات-و-التخصصات-الطبية" class="nav-link">التخصصات</a></li>
                        <li class="nav-item"><a href="/مقالات-طبية" class="nav-link">المقالات الطبية</a></li>
                        <li class="nav-item"><a href="/استشارات-و-اسئلة-طبية" class="nav-link">الاستشارات الطبية</a></li>
                        <li class="nav-item"><a href="/معلومات-طبية-سريعة" class="nav-link">معلومات طبية</a></li>
                    </ul>

                    <div class="egd-header-actions">
                        <a href="#" class="egd-btn-outline"><i class="fas fa-user"></i> تسجيل الدخول</a>
                        <a href="{{ route('home_page') }}#egd-doctor-cta" class="egd-btn"><i class="fas fa-user-md"></i> سجل كطبيب</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Header -->
