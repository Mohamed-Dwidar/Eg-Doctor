@extends('layoutmodule::front.main')

@php
    $page_title = 'المجالات و التخصصات الطبية';

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'التخصصات', 'url' => url()->current()];

    $page_meta['title'] = 'المجالات و التخصصات الطبية';
    $page_meta['description'] =
        'تصفح جميع التخصصات الطبية المتاحة على إيجي دكتور واختر التخصص المناسب لحالتك للوصول لأفضل الأطباء في مصر.';

    // Best-effort icon per real department name; anything not listed
    // here falls back to a generic icon rather than needing a schema
    // change to store one per row. (Kept identical to the homepage's
// specialties section so the same department always gets the
// same icon across the site.)
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

    // One ad slot after every 12 department cards.
    $egdDepartmentChunks = $departments->chunk(12);
@endphp

@section('content')
    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            <div class="egd-ad-slot">
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Department - Top Horizontal -->
                    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                        data-ad-slot="3723784204" data-ad-format="auto" data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </p>
            </div>
        </div>
    </div>
    <!-- End Ad Slot -->

    <section class="egd-section">
        <div class="container">
            <div class="egd-title">
                <span class="egd-eyebrow">دليل التخصصات</span>
                <h2>جميع التخصصات الطبية</h2>
                <p>تصفح كل التخصصات المتاحة على إيجي دكتور واختر التخصص المناسب لحالتك.</p>
            </div>

            @forelse ($egdDepartmentChunks as $egdChunkIndex => $egdChunk)
                <div class="row g-4">
                    @foreach ($egdChunk as $department)
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
                            <a href="{{ $egdSpecialtyUrl }}" class="egd-specialty-card wow fadeInUp" data-wow-delay="0.05s">
                                <span class="egd-specialty-icon"><i class="fas {{ $egdIcon }}"></i></span>
                                <h3>{{ $department->name }}</h3>
                                <span>{{ $egdSpecialtyBlurb }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>

                @unless ($loop->last)
                    {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                    <div class="egd-ad-slot my-4">
                        {{-- <span class="egd-ad-tag">إعلان</span> --}}
                        <p>
                            <!-- Eg-Doctor - Department - In-feed Ad -->
                            <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"
                                data-ad-layout-key="-gw-3+1f-3d+2z" data-ad-client="ca-pub-0462453958685277"
                                data-ad-slot="7375165313"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </p>
                    </div>
                @endunless
            @empty
                <p class="text-center text-muted">لا توجد تخصصات حاليًا.</p>
            @endforelse
        </div>
    </section>

@endsection
