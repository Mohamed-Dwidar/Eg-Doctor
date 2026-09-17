<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <title>إيج دكتور | دليلك الطبي للبحث عن أطباء مصر حسب التخصص والمحافظة</title>
    <meta name="description"
        content="إيج دكتور دليل طبي شامل يساعدك على البحث عن أفضل الأطباء في مصر حسب التخصص والمحافظة والمنطقة، مع معلومات موثوقة عن الأطباء والعيادات ومقالات واستشارات طبية.">
    <meta name="keywords" content="دليل أطباء مصر, بحث عن طبيب, تخصصات طبية, عيادات, استشارات طبية, إيج دكتور">

    <meta property="og:title" content="إيج دكتور | دليلك الطبي للبحث عن أطباء مصر" />
    <meta property="og:description" content="ابحث عن طبيبك المناسب حسب التخصص والمحافظة والمنطقة مع إيج دكتور." />
    <meta property="og:type" content="website">
    <meta property="og:locale" content="ar_EG">
    <meta name="robots" content="index, follow" />

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

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/front/img/favicon.ico') }}">

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

    <!-- Start Top Bar -->
    <div class="egd-topbar d-none d-md-block">
        <div class="container">
            <div class="egd-topbar-info">
                <span><i class="fas fa-phone"></i> اتصل بنا: 19XXX</span>
                <span><i class="fas fa-envelope"></i> info@egdoctor.com</span>
                <span><i class="fas fa-map-marker-alt"></i> خدمة تغطي جميع محافظات مصر</span>
            </div>
            <div class="egd-topbar-social">
                <a href="#" aria-label="فيسبوك"><i class="fab fa-facebook-f"></i></a>
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
                <a class="navbar-brand egd-logo" href="{{ url('/') }}">
                    <img src="{{ asset('assets/front/img/logo_main.png') }}" alt="إيج دكتور - دليل الأطباء المصري"
                        width="200" height="80">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="egdNavbarContent">
                    <ul class="navbar-nav mx-lg-auto">
                        <li class="nav-item active"><a href="#" class="nav-link">الرئيسية</a></li>
                        <li class="nav-item"><a href="#egd-doctors" class="nav-link">الأطباء</a></li>
                        <li class="nav-item"><a href="#egd-specialties" class="nav-link">التخصصات</a></li>
                        <li class="nav-item"><a href="#egd-articles" class="nav-link">المقالات الطبية</a></li>
                        <li class="nav-item"><a href="#egd-consultations" class="nav-link">الاستشارات الطبية</a></li>
                        <li class="nav-item"><a href="#egd-info" class="nav-link">معلومات طبية</a></li>
                    </ul>

                    <div class="egd-header-actions">
                        <a href="#" class="egd-btn-outline"><i class="fas fa-user"></i> تسجيل الدخول</a>
                        <a href="#egd-doctor-cta" class="egd-btn"><i class="fas fa-user-md"></i> سجل كطبيب</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <!-- Start Hero / Search -->
    <section class="egd-hero">
        <div class="container">
            <div class="egd-hero-inner">
                <h1>ابحث عن طبيبك بسهولة وثقة</h1>
                <p>
                    أكبر دليل طبي في مصر يساعدك على الوصول لأفضل الأطباء في جميع التخصصات
                    والمحافظات، مع بيانات واضحة عن الأطباء والعيادات لتختار على أساس سليم.
                </p>
            </div>

            <div class="egd-hero-stats">
                <div class="egd-stat">
                    <strong>+5,000</strong>
                    <span>طبيب مسجل</span>
                </div>
                <div class="egd-stat">
                    <strong>+50</strong>
                    <span>تخصص طبي</span>
                </div>
                <div class="egd-stat">
                    <strong>27</strong>
                    <span>محافظة</span>
                </div>
                <div class="egd-stat">
                    <strong>+200,000</strong>
                    <span>زيارة بحث شهريًا</span>
                </div>
            </div>
        </div>

        <div class="container egd-search-wrap">
            <div class="egd-search-card">
                <form action="#" method="get" role="search" aria-label="نموذج البحث عن طبيب">
                    <div class="egd-search-field">
                        <label for="egd-specialty">التخصص</label>
                        <div class="egd-input-icon">
                            <select id="egd-specialty" name="specialty">
                                <option value="">كل التخصصات</option>
                                <option>باطنة</option>
                                <option>أطفال</option>
                                <option>نساء وتوليد</option>
                                <option>جلدية</option>
                                <option>أسنان</option>
                                <option>قلب وأوعية دموية</option>
                                <option>عظام</option>
                                <option>أنف وأذن وحنجرة</option>
                                <option>عيون</option>
                                <option>مخ وأعصاب</option>
                            </select>
                            <i class="fas fa-stethoscope"></i>
                        </div>
                    </div>

                    <div class="egd-search-field">
                        <label for="egd-governorate">المحافظة</label>
                        <div class="egd-input-icon">
                            <select id="egd-governorate" name="governorate">
                                <option value="">كل المحافظات</option>
                                <option>القاهرة</option>
                                <option>الجيزة</option>
                                <option>الإسكندرية</option>
                                <option>الدقهلية</option>
                                <option>الشرقية</option>
                                <option>الغربية</option>
                            </select>
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    </div>

                    <div class="egd-search-field">
                        <label for="egd-area">المنطقة</label>
                        <div class="egd-input-icon">
                            <select id="egd-area" name="area">
                                <option value="">كل المناطق</option>
                                <option>المهندسين</option>
                                <option>مدينة نصر</option>
                                <option>المعادي</option>
                                <option>سموحة</option>
                                <option>رشدي</option>
                            </select>
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                    </div>

                    <div class="egd-search-field">
                        <label for="egd-doctor-name">اسم الطبيب</label>
                        <div class="egd-input-icon">
                            <input type="text" id="egd-doctor-name" name="doctor_name" placeholder="اكتب اسم الطبيب">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>

                    <div class="egd-search-submit">
                        <button type="submit"><i class="fas fa-search"></i> بحث</button>
                    </div>
                </form>

                <div class="egd-search-tags">
                    <span>الأكثر بحثًا:</span>
                    <a href="#">أطفال</a>
                    <a href="#">أسنان</a>
                    <a href="#">جلدية</a>
                    <a href="#">نساء وتوليد</a>
                    <a href="#">عظام</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero / Search -->

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

    <!-- Start Specialties -->
    <section class="egd-section" id="egd-specialties">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">التخصصات الطبية</span>
                <h2>ابحث حسب التخصص</h2>
                <p>اختر التخصص المناسب لحالتك من بين أكثر من 50 تخصصًا طبيًا متاحًا على إيج دكتور.</p>
            </div>

            <div class="row g-4">
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.05s">
                        <span class="egd-specialty-icon"><i class="fas fa-stethoscope"></i></span>
                        <h3>باطنة</h3>
                        <span>أمراض الجهاز الهضمي والباطنة العامة</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.1s">
                        <span class="egd-specialty-icon"><i class="fas fa-baby"></i></span>
                        <h3>أطفال</h3>
                        <span>رعاية الأطفال وحديثي الولادة</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.15s">
                        <span class="egd-specialty-icon"><i class="fas fa-female"></i></span>
                        <h3>نساء وتوليد</h3>
                        <span>متابعة الحمل وأمراض النساء</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.2s">
                        <span class="egd-specialty-icon"><i class="fas fa-allergies"></i></span>
                        <h3>جلدية</h3>
                        <span>الأمراض الجلدية والتجميل</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.25s">
                        <span class="egd-specialty-icon"><i class="fas fa-tooth"></i></span>
                        <h3>أسنان</h3>
                        <span>علاج وتجميل الأسنان</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.3s">
                        <span class="egd-specialty-icon"><i class="fas fa-heartbeat"></i></span>
                        <h3>قلب وأوعية دموية</h3>
                        <span>أمراض القلب والشرايين</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.05s">
                        <span class="egd-specialty-icon"><i class="fas fa-bone"></i></span>
                        <h3>عظام</h3>
                        <span>جراحة العظام والمفاصل</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.1s">
                        <span class="egd-specialty-icon"><i class="fas fa-deaf"></i></span>
                        <h3>أنف وأذن وحنجرة</h3>
                        <span>أمراض السمع والتنفس</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.15s">
                        <span class="egd-specialty-icon"><i class="fas fa-eye"></i></span>
                        <h3>عيون</h3>
                        <span>فحص وعلاج أمراض العيون</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.2s">
                        <span class="egd-specialty-icon"><i class="fas fa-brain"></i></span>
                        <h3>مخ وأعصاب</h3>
                        <span>أمراض الجهاز العصبي</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.25s">
                        <span class="egd-specialty-icon"><i class="fas fa-syringe"></i></span>
                        <h3>مسالك بولية</h3>
                        <span>أمراض الكلى والمسالك البولية</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <a href="#" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.3s">
                        <span class="egd-specialty-icon"><i class="fas fa-user-md"></i></span>
                        <h3>جراحة عامة</h3>
                        <span>العمليات الجراحية العامة</span>
                    </a>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="egd-btn-outline">عرض جميع التخصصات <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>
    <!-- End Specialties -->

    <!-- Start Featured Doctors -->
    <section class="egd-section egd-section-soft" id="egd-doctors">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">نخبة الأطباء</span>
                <h2>أطباء مميزون</h2>
                <p>تعرف على نخبة من الأطباء الأعلى تقييمًا على إيج دكتور في مختلف التخصصات والمحافظات.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <article class="egd-doctor-card wow fadeInUp" data-wow-delay="0.05s">
                        <div class="egd-doctor-top">
                            <div class="egd-doctor-avatar" aria-hidden="true">أس</div>
                            <div>
                                <h3>د. أحمد السيد محمود</h3>
                                <span class="egd-specialty-tag">استشاري الباطنة والجهاز الهضمي</span>
                            </div>
                        </div>
                        <div class="egd-doctor-body">
                            <div class="egd-doc-meta"><i class="fas fa-graduation-cap"></i> أستاذ مساعد بكلية طب القصر
                                العيني</div>
                            <div class="egd-doc-meta"><i class="fas fa-map-marker-alt"></i> القاهرة - المهندسين</div>
                            <div class="egd-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                <span>4.9 (128 تقييم)</span>
                            </div>
                            <a href="#" class="egd-btn-outline">عرض الملف</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="egd-doctor-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="egd-doctor-top">
                            <div class="egd-doctor-avatar" aria-hidden="true">من</div>
                            <div>
                                <h3>د. منى عبد الرحمن</h3>
                                <span class="egd-specialty-tag">أخصائية أمراض جلدية وتجميل</span>
                            </div>
                        </div>
                        <div class="egd-doctor-body">
                            <div class="egd-doc-meta"><i class="fas fa-graduation-cap"></i> دكتوراه في الأمراض
                                الجلدية</div>
                            <div class="egd-doc-meta"><i class="fas fa-map-marker-alt"></i> الإسكندرية - سموحة</div>
                            <div class="egd-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.8 (96 تقييم)</span>
                            </div>
                            <a href="#" class="egd-btn-outline">عرض الملف</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="egd-doctor-card wow fadeInUp" data-wow-delay="0.15s">
                        <div class="egd-doctor-top">
                            <div class="egd-doctor-avatar" aria-hidden="true">كف</div>
                            <div>
                                <h3>د. كريم فتحي</h3>
                                <span class="egd-specialty-tag">استشاري جراحة العظام والمفاصل</span>
                            </div>
                        </div>
                        <div class="egd-doctor-body">
                            <div class="egd-doc-meta"><i class="fas fa-graduation-cap"></i> عضو الجمعية المصرية لجراحة
                                العظام</div>
                            <div class="egd-doc-meta"><i class="fas fa-map-marker-alt"></i> الجيزة - الدقي</div>
                            <div class="egd-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="far fa-star"></i>
                                <span>4.7 (74 تقييم)</span>
                            </div>
                            <a href="#" class="egd-btn-outline">عرض الملف</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="egd-doctor-card wow fadeInUp" data-wow-delay="0.05s">
                        <div class="egd-doctor-top">
                            <div class="egd-doctor-avatar" aria-hidden="true">سي</div>
                            <div>
                                <h3>د. سارة يوسف</h3>
                                <span class="egd-specialty-tag">أخصائية طب الأطفال وحديثي الولادة</span>
                            </div>
                        </div>
                        <div class="egd-doctor-body">
                            <div class="egd-doc-meta"><i class="fas fa-graduation-cap"></i> ماجستير طب الأطفال</div>
                            <div class="egd-doc-meta"><i class="fas fa-map-marker-alt"></i> القاهرة - مدينة نصر</div>
                            <div class="egd-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (150 تقييم)</span>
                            </div>
                            <a href="#" class="egd-btn-outline">عرض الملف</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="egd-doctor-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="egd-doctor-top">
                            <div class="egd-doctor-avatar" aria-hidden="true">مع</div>
                            <div>
                                <h3>د. محمد عبد الله</h3>
                                <span class="egd-specialty-tag">استشاري القلب والأوعية الدموية</span>
                            </div>
                        </div>
                        <div class="egd-doctor-body">
                            <div class="egd-doc-meta"><i class="fas fa-graduation-cap"></i> زميل الكلية الملكية
                                للأطباء</div>
                            <div class="egd-doc-meta"><i class="fas fa-map-marker-alt"></i> القاهرة - المعادي</div>
                            <div class="egd-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                <span>4.8 (110 تقييم)</span>
                            </div>
                            <a href="#" class="egd-btn-outline">عرض الملف</a>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-4">
                    <article class="egd-doctor-card wow fadeInUp" data-wow-delay="0.15s">
                        <div class="egd-doctor-top">
                            <div class="egd-doctor-avatar" aria-hidden="true">هش</div>
                            <div>
                                <h3>د. هبة الشريف</h3>
                                <span class="egd-specialty-tag">استشارية النساء والتوليد</span>
                            </div>
                        </div>
                        <div class="egd-doctor-body">
                            <div class="egd-doc-meta"><i class="fas fa-graduation-cap"></i> دكتوراه أمراض النساء
                                والتوليد</div>
                            <div class="egd-doc-meta"><i class="fas fa-map-marker-alt"></i> الإسكندرية - رشدي</div>
                            <div class="egd-rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span>4.9 (135 تقييم)</span>
                            </div>
                            <a href="#" class="egd-btn-outline">عرض الملف</a>
                        </div>
                    </article>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="egd-btn">عرض جميع الأطباء <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>
    <!-- End Featured Doctors -->

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

    <!-- Start Search by Location -->
    <section class="egd-section">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">البحث بالموقع</span>
                <h2>ابحث عن طبيب في منطقتك</h2>
                <p>تصفح الأطباء المتاحين في محافظتك مباشرة واختر الأقرب إليك.</p>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.05s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>القاهرة</h3>
                            <span>+1,850 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.1s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>الجيزة</h3>
                            <span>+980 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.15s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>الإسكندرية</h3>
                            <span>+760 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.2s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>البحيرة</h3>
                            <span>+210 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.25s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>الدقهلية</h3>
                            <span>+340 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.05s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>الشرقية</h3>
                            <span>+295 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.1s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>الغربية</h3>
                            <span>+260 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.15s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>المنوفية</h3>
                            <span>+180 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.2s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>بورسعيد</h3>
                            <span>+95 طبيب</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="egd-location-card wow fadeInUp" data-wow-delay="0.25s">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>الإسماعيلية</h3>
                            <span>+88 طبيب</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="egd-btn-outline">عرض جميع المحافظات <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>
    <!-- End Search by Location -->

    <!-- Start Why EgDoctor -->
    <section class="egd-section egd-section-soft">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">لماذا نحن</span>
                <h2>لماذا إيج دكتور؟</h2>
                <p>نساعدك على اتخاذ قرار صحي وواثق عند اختيار طبيبك.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="egd-why-card wow fadeInUp" data-wow-delay="0.05s">
                        <span class="egd-why-icon"><i class="fas fa-hospital-alt"></i></span>
                        <div>
                            <h3>دليل شامل للأطباء</h3>
                            <p>قاعدة بيانات واسعة تضم آلاف الأطباء في مختلف التخصصات الطبية بجميع محافظات مصر.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="egd-why-card wow fadeInUp" data-wow-delay="0.1s">
                        <span class="egd-why-icon"><i class="fas fa-search-location"></i></span>
                        <div>
                            <h3>بحث دقيق حسب التخصص والموقع</h3>
                            <p>اعثر على الطبيب المناسب بسرعة عبر تصفية النتائج حسب التخصص والمحافظة والمنطقة.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="egd-why-card wow fadeInUp" data-wow-delay="0.15s">
                        <span class="egd-why-icon"><i class="fas fa-shield-alt"></i></span>
                        <div>
                            <h3>معلومات واضحة وموثوقة</h3>
                            <p>بيانات مراجعة عن كل طبيب تشمل المؤهلات والخبرات ومواعيد العمل.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="egd-why-card wow fadeInUp" data-wow-delay="0.2s">
                        <span class="egd-why-icon"><i class="fas fa-headset"></i></span>
                        <div>
                            <h3>وصول سهل لبيانات العيادات</h3>
                            <p>أرقام هواتف وعناوين ومواعيد العيادات في مكان واحد لتوفير وقتك.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why EgDoctor -->

    <!-- Start Medical Articles -->
    <section class="egd-section" id="egd-articles">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">المدونة الطبية</span>
                <h2>أحدث المقالات الطبية</h2>
                <p>محتوى طبي مبسط يساعدك على فهم صحتك بشكل أفضل، دون أن يغني عن استشارة طبيبك.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <article class="egd-article-card wow fadeInUp" data-wow-delay="0.05s">
                        <div class="egd-article-cover"><i class="fas fa-battery-quarter"></i></div>
                        <div class="egd-article-body">
                            <span class="egd-article-cat">صحة عامة</span>
                            <h3><a href="#">أسباب الشعور بالإرهاق المستمر وطرق التغلب عليه</a></h3>
                            <p>تعرف على أبرز الأسباب الشائعة للإرهاق اليومي وبعض النصائح العامة لتحسين مستوى
                                طاقتك.</p>
                            <div class="egd-article-foot">
                                <span><i class="far fa-clock"></i> 10 سبتمبر 2026</span>
                                <a href="#">اقرأ المزيد</a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-3">
                    <article class="egd-article-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="egd-article-cover"><i class="fas fa-heartbeat"></i></div>
                        <div class="egd-article-body">
                            <span class="egd-article-cat">القلب والأوعية الدموية</span>
                            <h3><a href="#">دليلك المبسط للتعامل مع ارتفاع ضغط الدم</a></h3>
                            <p>خطوات عامة يمكن أن تساعد في متابعة ضغط الدم ضمن خطة يحددها الطبيب المعالج.</p>
                            <div class="egd-article-foot">
                                <span><i class="far fa-clock"></i> 6 سبتمبر 2026</span>
                                <a href="#">اقرأ المزيد</a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-3">
                    <article class="egd-article-card wow fadeInUp" data-wow-delay="0.15s">
                        <div class="egd-article-cover"><i class="fas fa-tooth"></i></div>
                        <div class="egd-article-body">
                            <span class="egd-article-cat">طب الأسنان</span>
                            <h3><a href="#">نصائح للحفاظ على صحة أسنان أطفالك</a></h3>
                            <p>عادات يومية بسيطة تساعد على حماية أسنان الأطفال من التسوس المبكر.</p>
                            <div class="egd-article-foot">
                                <span><i class="far fa-clock"></i> 2 سبتمبر 2026</span>
                                <a href="#">اقرأ المزيد</a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-md-6 col-lg-3">
                    <article class="egd-article-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="egd-article-cover"><i class="fas fa-female"></i></div>
                        <div class="egd-article-body">
                            <span class="egd-article-cat">نساء وتوليد</span>
                            <h3><a href="#">كل ما تحتاجين معرفته عن متابعة الحمل الدورية</a></h3>
                            <p>نظرة عامة على أهمية الفحوصات الدورية أثناء الحمل بالتنسيق مع طبيبك.</p>
                            <div class="egd-article-foot">
                                <span><i class="far fa-clock"></i> 28 أغسطس 2026</span>
                                <a href="#">اقرأ المزيد</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="egd-btn-outline">عرض جميع المقالات <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>
    <!-- End Medical Articles -->

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

    <!-- Start Consultations -->
    <section class="egd-section egd-section-soft" id="egd-consultations">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">اسأل طبيب</span>
                <h2>الاستشارات الطبية</h2>
                <p>تصفح أسئلة طرحها مرضى آخرون وأجاب عليها أطباء متخصصون على إيج دكتور.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="egd-consult-card wow fadeInUp" data-wow-delay="0.05s">
                        <div class="egd-consult-q">
                            <i class="fas fa-comment-medical"></i>
                            <h3>ما أسباب آلام المعدة المتكررة؟</h3>
                        </div>
                        <div class="egd-consult-meta">
                            <span>باطنة</span>
                            <span>3 إجابات</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="egd-consult-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="egd-consult-q">
                            <i class="fas fa-comment-medical"></i>
                            <h3>متى يحتاج الطفل إلى زيارة طبيب الأطفال؟</h3>
                        </div>
                        <div class="egd-consult-meta">
                            <span>أطفال</span>
                            <span>5 إجابات</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="egd-consult-card wow fadeInUp" data-wow-delay="0.15s">
                        <div class="egd-consult-q">
                            <i class="fas fa-comment-medical"></i>
                            <h3>هل ألم أسفل الظهر يستدعي زيارة طبيب عظام؟</h3>
                        </div>
                        <div class="egd-consult-meta">
                            <span>عظام</span>
                            <span>2 إجابة</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="egd-consult-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="egd-consult-q">
                            <i class="fas fa-comment-medical"></i>
                            <h3>ما الفرق بين حساسية الجيوب الأنفية ونزلة البرد؟</h3>
                        </div>
                        <div class="egd-consult-meta">
                            <span>أنف وأذن وحنجرة</span>
                            <span>4 إجابات</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="egd-btn">شاهد جميع الاستشارات <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>
    <!-- End Consultations -->

    <!-- Start Medical Information -->
    <section class="egd-section" id="egd-info">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">مرجع طبي</span>
                <h2>معلومات طبية</h2>
                <p>مرجع مبسط يشرح الأمراض والأعراض والأدوية بلغة سهلة الفهم.</p>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-4">
                    <a href="#" class="egd-info-card wow fadeInUp" data-wow-delay="0.05s">
                        <i class="fas fa-notes-medical"></i>
                        <h3>الأمراض</h3>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="#" class="egd-info-card wow fadeInUp" data-wow-delay="0.1s">
                        <i class="fas fa-thermometer-half"></i>
                        <h3>الأعراض</h3>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="#" class="egd-info-card wow fadeInUp" data-wow-delay="0.15s">
                        <i class="fas fa-pills"></i>
                        <h3>الأدوية</h3>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="#" class="egd-info-card wow fadeInUp" data-wow-delay="0.2s">
                        <i class="fas fa-vial"></i>
                        <h3>التحاليل الطبية</h3>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="#" class="egd-info-card wow fadeInUp" data-wow-delay="0.25s">
                        <i class="fas fa-x-ray"></i>
                        <h3>الفحوصات</h3>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="#" class="egd-info-card wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fas fa-book-medical"></i>
                        <h3>المصطلحات الطبية</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Medical Information -->

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

    <!-- Start Doctor Registration CTA -->
    <section class="egd-section egd-section-soft" id="egd-doctor-cta">
        <div class="container">
            <div class="egd-doctor-cta wow fadeInUp">
                <div>
                    <h2>هل أنت طبيب؟</h2>
                    <p>أنشئ ملفك الطبي على إيج دكتور وسهّل على المرضى الوصول إلى بياناتك والتواصل مع عيادتك.</p>
                    <div class="egd-doctor-cta-points">
                        <span><i class="fas fa-check-circle"></i> ملف طبي احترافي</span>
                        <span><i class="fas fa-check-circle"></i> ظهور ضمن نتائج البحث</span>
                        <span><i class="fas fa-check-circle"></i> تواصل مباشر مع المرضى</span>
                    </div>
                </div>
                <a href="#" class="egd-btn-light"><i class="fas fa-user-md"></i> سجل كطبيب</a>
            </div>
        </div>
    </section>
    <!-- End Doctor Registration CTA -->

    <!-- Start Footer -->
    <footer class="egd-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ url('/') }}" class="egd-logo">
                        <img src="{{ asset('assets/front/img/Logo_dark.png') }}" alt="إيج دكتور - دليل الأطباء المصري"
                            width="200" height="80">
                    </a>
                    <p>
                        إيج دكتور هو دليل طبي إلكتروني يساعد المرضى في مصر على البحث عن الأطباء
                        والعيادات حسب التخصص والمحافظة، والاطلاع على مقالات واستشارات طبية موثوقة.
                    </p>
                    <div class="egd-footer-social">
                        <a href="#" aria-label="فيسبوك"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="تويتر"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="انستقرام"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="يوتيوب"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h3>روابط مهمة</h3>
                    <ul class="egd-footer-links">
                        <li><a href="#">الرئيسية</a></li>
                        <li><a href="#egd-doctors">الأطباء</a></li>
                        <li><a href="#egd-specialties">التخصصات</a></li>
                        <li><a href="#egd-articles">المقالات الطبية</a></li>
                        <li><a href="#egd-consultations">الاستشارات الطبية</a></li>
                        <li><a href="#egd-info">معلومات طبية</a></li>
                        <li><a href="#egd-doctor-cta">سجل كطبيب</a></li>
                        <li><a href="#">اتصل بنا</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h3>تواصل معنا</h3>
                    <ul class="egd-footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> القاهرة، جمهورية مصر العربية</li>
                        <li><i class="fas fa-phone"></i> 19XXX</li>
                        <li><i class="fas fa-envelope"></i> info@egdoctor.com</li>
                        <li><i class="far fa-clock"></i> خدمة العملاء متاحة يوميًا من 9 صباحًا حتى 10 مساءً</li>
                    </ul>
                </div>
            </div>

            <div class="egd-copyright">
                <p>© 2026 إيج دكتور. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div class="go-top"><i class="fas fa-chevron-up"></i><i class="fas fa-chevron-up"></i></div>

    <!-- jQuery Min JS -->
    <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <!-- Popper Min JS -->
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <!-- Bootstrap Min JS -->
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <!-- MixItUp Min JS -->
    <script src="{{ asset('assets/front/js/mixitup.min.js') }}"></script>
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
    <!-- Main JS -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
</body>

</html>
