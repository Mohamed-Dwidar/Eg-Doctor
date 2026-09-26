@extends('layoutmodule::front.main')

@php
    $page_title = 'ابحث عن طبيب';

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'ابحث عن طبيب', 'url' => url()->current()];

    $page_meta['title'] = 'ابحث عن طبيب - إيجي دكتور';
    $page_meta['description'] = 'ابحث عن طبيبك حسب التخصص والمحافظة والمنطقة، أو باسم الطبيب مباشرة، على أكبر دليل طبي في مصر.';
@endphp

@section('content')
    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
            <div class="egd-ad-slot">
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Search Page - Top -->
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
                <h2>ابحث عن طبيبك بسهولة وثقة</h2>
                <p>اختر التخصص والمحافظة والمنطقة، أو اكتب اسم الطبيب مباشرة، للوصول لأفضل الأطباء في مصر.</p>
            </div>

            <div class="egd-search-card">
                <form action="{{ route('doctors.search') }}" method="get" role="search"
                    aria-label="نموذج البحث عن طبيب">
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

    <!-- Start Ad Slot -->
    <div class="egd-ad-section">
        <div class="container">
            {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
            <div class="egd-ad-slot">
                {{-- <span class="egd-ad-tag">إعلان</span> --}}
                <p>
                    <!-- Eg-Doctor - Search Page - Bottom -->
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
@endsection

@push('scripts')
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
@endpush
