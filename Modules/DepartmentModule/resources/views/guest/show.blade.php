@extends('layoutmodule::front.main')

@php
    $page_title = $department->name;

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'التخصصات', 'url' => '/المجالات-و-التخصصات-الطبية'];
    $breadcrumb[] = ['title' => $department->name, 'url' => url()->current()];

    $page_meta['title'] = 'أطباء ' . $department->name;
    $page_meta['description'] = \Illuminate\Support\Str::limit(
        trim($department->seo?->meta_description ?: ($department->description ?: 'أطباء ' . $department->name)),
        160,
    );
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
            <div class="row g-4">
                {{-- Right: doctors in this department --}}
                <div class="col-lg-7">
                    <div class="egd-title egd-title-start">
                        <h2>أطباء {{ $department->name }}</h2>
                        {{-- <p>{{ $doctors->total() }} طبيب متاح في تخصص {{ $department->name }}</p> --}}
                    </div>

                    <div class="egd-doctor-list">
                        @forelse ($doctors as $doctor)
                            @php
                                $egdDoctorUrl = $doctor->seo?->slug ? url($doctor->seo->slug) : '#';
                                $egdDoctorDept = $doctor->departments->first(fn($d) => $d->id !== $department->id)
                                    ?->name;
                            @endphp
                            <article class="egd-doctor-list-item wow fadeInUp" data-wow-delay="0.05s">
                                <div class="egd-doctor-list-avatar">
                                    @if ($doctor->pic)
                                        <img src="{{ asset('uploads/doctors/' . $doctor->pic) }}" alt="{{ $doctor->name }}">
                                    @else
                                        {{ mb_substr(trim($doctor->name), 0, 2) }}
                                    @endif
                                </div>

                                <div class="egd-doctor-list-body">
                                    <h3><a href="{{ $egdDoctorUrl }}">{{ $doctor->name }}</a></h3>
                                    <span class="egd-specialty-tag">
                                        {{ $doctor->degree?->name }}
                                        @if ($egdDoctorDept)
                                            - {{ $egdDoctorDept }}
                                        @endif
                                    </span>

                                    <div class="egd-doctor-list-meta">
                                        @if ($doctor->city || $doctor->zone)
                                            <span><i class="fas fa-map-marker-alt"></i>
                                                {{ $doctor->city?->name }}
                                                @if ($doctor->zone)
                                                    - {{ $doctor->zone->name }}
                                                @endif
                                            </span>
                                        @endif
                                        @if ($doctor->working_time)
                                            <span><i class="far fa-clock"></i> {{ $doctor->working_time }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="egd-doctor-list-action">
                                    <a href="{{ $egdDoctorUrl }}" class="egd-btn-outline">عرض الملف</a>
                                </div>
                            </article>

                            @if ($loop->index === 2)
                                {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                                <div class="egd-ad-slot">
                                    {{-- <span class="egd-ad-tag">إعلان</span> --}}
                                    <p>
                                        <!-- Eg-Doctor - Doctor - In-feed Ad -->
                                        <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"
                                            data-ad-layout-key="-gw-3+1f-3d+2z" data-ad-client="ca-pub-0462453958685277"
                                            data-ad-slot="9714477485"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || [])
                                            .push({});
                                        </script>
                                    </p>
                                </div>
                            @endif
                        @empty
                            <p class="text-center text-muted">لا يوجد أطباء مسجلون في هذا التخصص حاليًا.</p>
                        @endforelse
                    </div>

                    {{ $doctors->links('departmentmodule::guest.partials.egd-pagination') }}
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
                                                <span><i class="far fa-clock"></i>
                                                    {{ $article->created_at?->format('d/m/Y') }}</span>
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
                            {{-- <span class="egd-ad-tag">إعلان</span> --}}
                            <p>
                                <!-- Eg-Doctor - Doctor - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="9007900471" data-ad-format="auto" data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
                        </div>

                        <div class="egd-side-block" id="egd-related-videos">
                            <h2 class="egd-side-title">فيديوهات طبية</h2>

                            <div class="egd-video-grid">
                                @forelse ($randomVideos as $video)
                                    @php
                                        $egdVideoUrl = $video->seo?->slug ? url($video->seo->slug) : '#';
                                        $egdVideoThumb =
                                            $video->img_url ?:
                                            ($video->youtube_code
                                                ? 'https://img.youtube.com/vi/' .
                                                    $video->youtube_code .
                                                    '/hqdefault.jpg'
                                                : null);
                                    @endphp
                                    <a href="{{ $egdVideoUrl }}" class="egd-video-item">
                                        <span class="egd-video-thumb">
                                            @if ($egdVideoThumb)
                                                <img src="{{ $egdVideoThumb }}" alt="{{ $video->title }}" loading="lazy">
                                            @else
                                                <i class="fab fa-youtube"></i>
                                            @endif
                                        </span>
                                        <h3>{{ $video->title }}</h3>
                                    </a>
                                @empty
                                    <p class="text-muted mb-0">لا توجد فيديوهات حاليًا.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            {{-- <span class="egd-ad-tag">إعلان</span> --}}
                            <p>
                                <!-- Eg-Doctor - Doctor - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="9007900471" data-ad-format="auto" data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
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
                            {{-- <span class="egd-ad-tag">إعلان</span> --}}
                           <p>
                                <!-- Eg-Doctor - Doctor - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="9007900471" data-ad-format="auto" data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
                        </div>

                        <div class="egd-side-block" id="egd-related-informations">
                            <h2 class="egd-side-title">معلومات طبية سريعة</h2>

                            <div class="egd-side-list">
                                @forelse ($randomInformations as $information)
                                    @php
                                        $egdInfoUrl = $information->seo?->slug ? url($information->seo->slug) : '#';
                                    @endphp
                                    <a href="{{ $egdInfoUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-notes-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $information->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span><i class="far fa-clock"></i>
                                                    {{ $information->created_at?->format('d/m/Y') }}</span>
                                            </span>
                                        </span>
                                    </a>
                                @empty
                                    <p class="text-muted mb-0">لا توجد معلومات طبية حاليًا.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
