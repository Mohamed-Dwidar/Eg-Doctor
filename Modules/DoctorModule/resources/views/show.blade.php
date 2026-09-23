@extends('layoutmodule::front.main')

@php
    $page_title = $doctor->name;

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'الأطباء', 'url' => '/الأطباء'];
    $breadcrumb[] = ['title' => $doctor->name, 'url' => url()->current()];

    $page_meta['title'] = $doctor->name . ($doctor->degree?->name ? ' - ' . $doctor->degree->name : '');
    $page_meta['description'] = \Illuminate\Support\Str::limit(
        trim($doctor->more_info ?: ($doctor->name . ' ' . ($doctor->degree?->name ?? '') . ' ' . ($doctor->city?->name ?? ''))),
        160
    );
@endphp

@php
    $egdPrimaryDepartment = $doctor->departments->first(fn($department) => filled($department->description))
        ?? $doctor->departments->first();
@endphp

@section('content')

    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: the doctor's own content --}}
                <div class="col-lg-7">
                    <div class="egd-doctor-part">
                        <div class="egd-doctor-profile-card">
                            <div class="egd-doctor-profile-avatar">
                                @if ($doctor->pic)
                                    <img src="{{ asset('uploads/doctors/' . $doctor->pic) }}" alt="{{ $doctor->name }}">
                                @else
                                    {{ mb_substr(trim($doctor->name), 0, 2) }}
                                @endif
                            </div>

                            <h1>{{ $doctor->name }}</h1>

                            @if ($doctor->degree)
                                <span class="egd-doctor-profile-degree">{{ $doctor->degree->name }}</span>
                            @endif

                            @if ($doctor->departments->isNotEmpty())
                                <div class="egd-doctor-profile-tags">
                                    @foreach ($doctor->departments as $department)
                                        <a href="{{ $department->seo?->slug ? url($department->seo->slug) : '#' }}">{{ $department->name }}</a>
                                    @endforeach
                                </div>
                            @endif

                            @if ($doctor->more_info)
                                <p class="egd-doctor-profile-bio">{{ $doctor->more_info }}</p>
                            @endif
                        </div>



                        @if ($egdPrimaryDepartment && $egdPrimaryDepartment->description)
                            <div class="egd-doctor-profile-about">
                                <h2>عن تخصص {{ $egdPrimaryDepartment->name }}</h2>
                                <p>{{ $egdPrimaryDepartment->description }}</p>
                            </div>
                        @endif

                         {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            <span class="egd-ad-tag">إعلان</span>
                            <p>مساحة إعلانية (728×90 على الشاشات الكبيرة / 320×50 على الجوال)</p>
                        </div>

                        <div class="egd-doctor-profile-card egd-doctor-contact-card">
                            <h2>بيانات التواصل</h2>

                            <ul class="egd-doctor-profile-contact">
                                @if ($doctor->city || $doctor->zone)
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>
                                            {{ $doctor->city?->name }}
                                            @if ($doctor->zone)
                                                - {{ $doctor->zone->name }}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if ($doctor->address)
                                    <li><i class="fas fa-location-arrow"></i> <span>{{ $doctor->address }}</span></li>
                                @endif
                                @if ($doctor->working_time)
                                    <li><i class="far fa-clock"></i> <span>{{ $doctor->working_time }}</span></li>
                                @endif
                            </ul>

                            <div class="egd-doctor-profile-actions">
                                @if ($doctor->mobile)
                                    <a href="tel:{{ $doctor->mobile }}" class="egd-btn"><i class="fas fa-phone"></i> {{ $doctor->mobile }}</a>
                                @elseif ($doctor->phone)
                                    <a href="tel:{{ $doctor->phone }}" class="egd-btn"><i class="fas fa-phone"></i> {{ $doctor->phone }}</a>
                                @endif

                                @if ($doctor->email)
                                    <a href="mailto:{{ $doctor->email }}" class="egd-btn-outline"><i class="fas fa-envelope"></i> راسل الطبيب</a>
                                @endif

                                @if ($doctor->website)
                                    <a href="{{ $doctor->website }}" target="_blank" rel="noopener" class="egd-btn-outline"><i class="fas fa-globe"></i> الموقع الإلكتروني</a>
                                @endif

                                @if ($doctor->address_latitude && $doctor->address_longitude)
                                    <a href="https://www.google.com/maps?q={{ $doctor->address_latitude }},{{ $doctor->address_longitude }}"
                                        target="_blank" rel="noopener" class="egd-btn-outline">
                                        <i class="fas fa-map-marked-alt"></i> عرض الموقع على الخريطة
                                    </a>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>

                {{-- Left: related content --}}
                <div class="col-lg-5">
                    <div class="egd-doctor-part">
                        <div class="egd-side-block" id="egd-related-articles">
                            <h2 class="egd-side-title">مقالات قد تهمك</h2>

                            <div class="egd-side-list">
                                @forelse ($relatedArticles as $article)
                                    @php
                                        $egdArticleUrl = $article->seo?->slug ? url($article->seo->slug) : '#';
                                    @endphp
                                    <a href="{{ $egdArticleUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-notes-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $article->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span><i class="far fa-clock"></i> {{ $article->created_at?->format('d/m/Y') }}</span>
                                            </span>
                                        </span>
                                    </a>
                                @empty
                                    <p class="text-muted mb-0">لا توجد مقالات حاليًا.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            <span class="egd-ad-tag">إعلان</span>
                            <p>مساحة إعلانية (300×250)</p>
                        </div>

                        <div class="egd-side-block" id="egd-related-consultations">
                            <h2 class="egd-side-title">استشارات الزوار</h2>

                            <div class="egd-side-list">
                                @forelse ($latestQuestions as $question)
                                    @php
                                        $egdQuestionUrl = $question->seo?->slug ? url($question->seo->slug) : '#';
                                    @endphp
                                    <a href="{{ $egdQuestionUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-comment-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $question->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span>{{ $question->writer ?: 'زائر' }}</span>
                                                <span>{{ $question->answers_count }} إجابة</span>
                                            </span>
                                        </span>
                                    </a>
                                @empty
                                    <p class="text-muted mb-0">لا توجد استشارات حاليًا.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            <span class="egd-ad-tag">إعلان</span>
                            <p>مساحة إعلانية (300×250)</p>
                        </div>

                        <div class="egd-side-block" id="egd-related-videos">
                            <h2 class="egd-side-title">فيديوهات طبية</h2>

                            <div class="egd-related-videos-placeholder">
                                <i class="fas fa-video"></i>
                                <p>قسم الفيديوهات الطبية قريبًا على إيجي دكتور.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
