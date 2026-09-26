<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <title>ايجي دكتور | دليلك الطبي للبحث عن أطباء مصر حسب التخصص والمحافظة الاستشارات الطبية</title>
    <meta name="description"
        content="إيجي دكتور دليل طبي شامل يساعدك على البحث عن أفضل الأطباء في مصر حسب التخصص والمحافظة والمنطقة، مع معلومات موثوقة عن الأطباء والعيادات ومقالات واستشارات طبية.">
    <meta name="keywords" content="دليل أطباء مصر, بحث عن طبيب, تخصصات طبية, عيادات, استشارات طبية, إيجي دكتور">

    <meta property="og:title" content="إيجي دكتور | دليلك الطبي للبحث عن أطباء مصر" />
    <meta property="og:description" content="ابحث عن طبيبك المناسب حسب التخصص والمحافظة والمنطقة مع إيجي دكتور." />
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
    <!-- MeanMenu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/meanmenu.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/front/css/style_custom.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/front/img/favicon.ico') }}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-0462453958685277"
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
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-0462453958685277"
                crossorigin="anonymous"></script>
            <!-- Eg-Doctor - Home - Ad-Fly (160x600) -->
            <ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px"
                data-ad-client="ca-pub-0462453958685277" data-ad-slot="5102005112"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </p>
    </div>
    <div class="egd-ad-rail egd-ad-rail-end">
        <p>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-0462453958685277"
                crossorigin="anonymous"></script>
            <!-- Eg-Doctor - Home - Ad-Fly (160x600) -->
            <ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px"
                data-ad-client="ca-pub-0462453958685277" data-ad-slot="5102005112"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </p>
    </div>
    <!-- End Vertical Ad Rails -->

    @include('layoutmodule::front.header')

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
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-stethoscope"></i>
                        </div>
                    </div>

                    <div class="egd-search-field">
                        <label for="egd-governorate">المحافظة</label>
                        <div class="egd-input-icon">
                            <select id="egd-governorate" name="governorate">
                                <option value="">كل المحافظات</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @selected($defaultCity && $city->id === $defaultCity->id)>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                    </div>

                    <div class="egd-search-field">
                        <label for="egd-area">المنطقة</label>
                        <div class="egd-input-icon">
                            <select id="egd-area" name="area">
                                <option value="">كل المناطق</option>
                                @foreach ($defaultCityZones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                    </div>

                    <div class="egd-search-field">
                        <label for="egd-doctor-name">اسم الطبيب</label>
                        <div class="egd-input-icon">
                            <input type="text" id="egd-doctor-name" name="doctor_name"
                                placeholder="اكتب اسم الطبيب">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>

                    <div class="egd-search-submit">
                        <button type="submit"><i class="fas fa-search"></i> بحث</button>
                    </div>
                </form>

                <div class="egd-search-tags">
                    <span>الأكثر بحثًا:</span>
                    @foreach ($departments->take(5) as $department)
                        <a
                            href="{{ $department->seo?->slug ? url($department->seo->slug) : '#' }}">{{ $department->name }}</a>
                    @endforeach
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
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Home - Horizontal -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                        data-ad-slot="9119491826" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </p>
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
                <p>اختر التخصص المناسب لحالتك من بين أكثر من 50 تخصصًا طبيًا متاحًا على إيجي دكتور.</p>
            </div>

            @php
                // Best-effort icon per real department name; anything
                // not listed here falls back to a generic icon rather
                // than needing a schema change to store one per row.
                $egdSpecialtyIcons = [
                    'الأنف والأذن والحنجرة' => 'fa-deaf',
                    'الاطفال' => 'fa-baby',
                    'الباطنة' => 'fa-stethoscope',
                    'الجلدية والتناسلية' => 'fa-allergies',
                    'الجهاز الهضمي والكبد' => 'fa-notes-medical',
                    'الروماتيزم والمفاصل' => 'fa-bone',
                    'الصدر والحساسية' => 'fa-wind',
                    'الطب الطبيعي' => 'fa-procedures',
                    'الطب النفسى' => 'fa-comment-medical',
                    'العيون' => 'fa-eye',
                    'الغدد الصماء والسكر' => 'fa-syringe',
                    'الفم والأسنان' => 'fa-tooth',
                    'القلب والأوعية الدموية' => 'fa-heartbeat',
                    'الكلى' => 'fa-vial',
                    'المخ والاعصاب' => 'fa-brain',
                    'النساء و الولادة' => 'fa-female',
                    'تحاليل طبيه' => 'fa-flask',
                    'تخدير' => 'fa-syringe',
                    'تنظيم الاسرة' => 'fa-venus',
                    'جراحة عامة' => 'fa-user-md',
                    'جراحه أطفال' => 'fa-child',
                    'خصوبة و عقم' => 'fa-venus',
                    'ريجيم وعلاج السمنة و النحافة' => 'fa-weight',
                    'سمع وتخاطب' => 'fa-deaf',
                    'صحة عامة و تغذيه' => 'fa-first-aid',
                    'طب الاورام' => 'fa-microscope',
                    'طوارئ' => 'fa-ambulance',
                    'غسيل كلوي' => 'fa-vial',
                    'مناظير' => 'fa-x-ray',
                ];
            @endphp

            <div class="row g-4">
                @foreach ($departments->take(12) as $department)
                    @php
                        $egdIcon =
                            $egdSpecialtyIcons[$department->name] ??
                            (str_contains($department->name, 'جراحة') || str_contains($department->name, 'جراحه')
                                ? 'fa-user-md'
                                : 'fa-stethoscope');
                        $egdSpecialtyUrl = $department->seo?->slug ? url($department->seo->slug) : '#';
                        $egdSpecialtyBlurb =
                            \Illuminate\Support\Str::limit(
                                trim(
                                    str_replace($department->name, '', $department->seo?->meta_description ?? ''),
                                    " -\n",
                                ),
                                40,
                            ) ?:
                            $department->name;
                    @endphp
                    <div class="col-6 col-sm-4 col-lg-2">
                        <a href="{{ $egdSpecialtyUrl }}" class="egd-specialty-card wow fadeInUp"
                            data-wow-delay="0.05s">
                            <span class="egd-specialty-icon"><i class="fas {{ $egdIcon }}"></i></span>
                            <h3>{{ $department->name }}</h3>
                            <span>{{ $egdSpecialtyBlurb }}</span>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="/المجالات-و-التخصصات-الطبية" class="egd-btn-outline">عرض جميع التخصصات <i
                        class="fas fa-arrow-left"></i></a>
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
                <p>تعرف على نخبة من الأطباء الأعلى تقييمًا على إيجي دكتور في مختلف التخصصات والمحافظات.</p>
            </div>

            <div class="row g-4">
                @forelse ($featuredDoctors as $doctor)
                    @php
                        $egdDoctorUrl = $doctor->seo?->slug ? url($doctor->seo->slug) : '#';
                        $egdDoctorDept = $doctor->departments->first()?->name;
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <article class="egd-doctor-card wow fadeInUp" data-wow-delay="0.05s">
                            <div class="egd-doctor-top">
                                <div class="egd-doctor-avatar" aria-hidden="true">
                                    {{ mb_substr(trim($doctor->name), 0, 2) }}</div>
                                <div>
                                    <h3>{{ $doctor->name }}</h3>
                                    <span class="egd-specialty-tag">
                                        {{ $doctor->degree?->name }}
                                        @if ($egdDoctorDept)
                                            - {{ $egdDoctorDept }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="egd-doctor-body">
                                @if ($doctor->more_info)
                                    <div class="egd-doc-meta"><i class="fas fa-graduation-cap"></i>
                                        {{ $doctor->more_info }}</div>
                                @endif
                                @if ($doctor->city || $doctor->zone)
                                    <div class="egd-doc-meta"><i class="fas fa-map-marker-alt"></i>
                                        {{ $doctor->city?->name }}
                                        @if ($doctor->zone)
                                            - {{ $doctor->zone->name }}
                                        @endif
                                    </div>
                                @endif
                                <a href="{{ $egdDoctorUrl }}" class="egd-btn-outline">عرض الملف</a>
                            </div>
                        </article>
                    </div>
                @empty
                    <p class="text-center text-muted">لا يوجد أطباء مسجلون حاليًا.</p>
                @endforelse
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
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Home - Horizontal -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                        data-ad-slot="9119491826" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </p>
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
                <h2>لماذا إيجي دكتور؟</h2>
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
                @forelse ($randomArticles as $article)
                    @php
                        $egdArticleUrl = $article->seo?->slug ? url($article->seo->slug) : '#';
                        $egdArticleExcerpt = \Illuminate\Support\Str::limit(strip_tags($article->content), 110);
                    @endphp
                    <div class="col-md-6 col-lg-3">
                        <article class="egd-article-card wow fadeInUp" data-wow-delay="0.05s">
                            <div class="egd-article-cover"><i class="fas fa-notes-medical"></i></div>
                            <div class="egd-article-body">
                                <h3><a href="{{ $egdArticleUrl }}">{{ $article->title }}</a></h3>

                                @if ($article->doctor)
                                    <span class="egd-article-cat">{{ $article->doctor->name }}</span>
                                @else
                                    <span class="egd-article-cat">-</span>
                                @endif
                                <p>{{ $egdArticleExcerpt }}</p>

                                <div class="egd-article-foot">
                                    <span><i class="far fa-clock"></i>
                                        {{ $article->created_at?->format('d/m/Y') }}</span>
                                    <a href="{{ $egdArticleUrl }}">اقرأ المزيد</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <p class="text-center text-muted">لا توجد مقالات حاليًا.</p>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="/مقالات-طبية" class="egd-btn-outline">عرض جميع المقالات <i
                        class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>
    <!-- End Medical Articles -->

    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
            <div class="egd-ad-slot">
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Home - Horizontal -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                        data-ad-slot="9119491826" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </p>
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
                <p>تصفح أسئلة طرحها مرضى آخرون وأجاب عليها أطباء متخصصون على إيجي دكتور.</p>
            </div>

            <div class="row g-4">
                @forelse ($latestQuestions as $question)
                    @php
                        $egdQuestionUrl = $question->seo?->slug ? url($question->seo->slug) : '#';
                    @endphp
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ $egdQuestionUrl }}" class="egd-consult-card wow fadeInUp"
                            data-wow-delay="0.05s">
                            <div class="egd-consult-q">
                                <i class="fas fa-comment-medical"></i>
                                <h3>{{ $question->title }}</h3>
                            </div>
                            <div class="egd-consult-meta">
                                <span>{{ $question->writer ?: 'زائر' }}</span>
                                <span>{{ $question->answers_count }} إجابة</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-muted">لا توجد استشارات حاليًا.</p>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="/استشارات-و-اسئلة-طبية" class="egd-btn">شاهد جميع الاستشارات <i
                        class="fas fa-arrow-left"></i></a>
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

            @php
                // Cycled purely for visual variety — these tiles show
                // real random information rows, not fixed categories.
                $egdInfoIcons = [
                    'fa-notes-medical',
                    'fa-thermometer-half',
                    'fa-pills',
                    'fa-vial',
                    'fa-x-ray',
                    'fa-book-medical',
                ];
            @endphp

            <div class="row g-3">
                @forelse ($randomInformations as $egdInfoIndex => $information)
                    @php
                        $egdInfoUrl = $information->seo?->slug ? url($information->seo->slug) : '#';
                    @endphp
                    <div class="col-6 col-md-4">
                        <a href="{{ $egdInfoUrl }}" class="egd-info-card wow fadeInUp" data-wow-delay="0.05s">
                            <i class="fas {{ $egdInfoIcons[$egdInfoIndex % count($egdInfoIcons)] }}"></i>
                            <h3>{{ $information->title }}</h3>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-muted">لا توجد معلومات طبية حاليًا.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- End Medical Information -->

    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
            <div class="egd-ad-slot">
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Home - Horizontal -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                        data-ad-slot="9119491826" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </p>
            </div>
        </div>
    </div>
    <!-- End Ad Slot -->

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

    <script>
        $(document).ready(function() {
            const zonesUrlTemplate = @json(route('zones-by-city', ['city' => '__CITY_ID__']));

            $('#egd-governorate').on('change', function() {
                const cityId = $(this).val();
                const $zoneSelect = $('#egd-area');

                if (!cityId) {
                    $zoneSelect.prop('disabled', false).html('<option value="">كل المناطق</option>');
                    return;
                }

                $zoneSelect.prop('disabled', true).html('<option value="">جاري التحميل...</option>');

                $.get(zonesUrlTemplate.replace('__CITY_ID__', cityId))
                    .done(function(zones) {
                        $zoneSelect.empty().append('<option value="">كل المناطق</option>');
                        zones.forEach(function(zone) {
                            $zoneSelect.append(new Option(zone.name, zone.id));
                        });
                    })
                    .fail(function() {
                        $zoneSelect.html('<option value="">تعذر تحميل المناطق</option>');
                    })
                    .always(function() {
                        $zoneSelect.prop('disabled', false);
                    });
            });
        });
    </script>
</body>

</html>
