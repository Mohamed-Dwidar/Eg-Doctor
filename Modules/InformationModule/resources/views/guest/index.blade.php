@extends('layoutmodule::front.main')

@php
    $page_title = 'معلومات طبية سريعة';

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'معلومات طبية سريعة', 'url' => url()->current()];

    $page_meta['title'] = 'معلومات طبية سريعة';
    $page_meta['description'] = 'تصفح معلومات ونصائح طبية سريعة على إيجي دكتور، محتوى مبسط يساعدك على فهم صحتك بشكل أفضل.';
@endphp

@section('content')

    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: quick-info list --}}
                <div class="col-lg-7">
                    <div class="egd-title egd-title-start">
                        <h2>معلومات طبية سريعة</h2>
                    </div>

                    <div class="egd-article-list">
                        @forelse ($informations as $information)
                            @php
                                $egdInfoUrl = $information->seo?->slug ? url($information->seo->slug) : '#';
                                $egdInfoExcerpt = $information->content
                                    ? \Illuminate\Support\Str::limit(
                                        html_entity_decode(strip_tags($information->content), ENT_QUOTES, 'UTF-8'),
                                        130
                                    )
                                    : null;
                            @endphp
                            <article class="egd-article-list-item wow fadeInUp" data-wow-delay="0.05s">
                                <div class="egd-article-list-cover"><i class="fas fa-notes-medical"></i></div>

                                <div class="egd-article-list-body">
                                    <h3><a href="{{ $egdInfoUrl }}">{{ $information->title }}</a></h3>

                                    @if ($egdInfoExcerpt)
                                        <p>{{ $egdInfoExcerpt }}</p>
                                    @endif

                                    <div class="egd-article-list-meta">
                                        <span><i class="far fa-clock"></i> {{ $information->created_at?->format('d/m/Y') }}</span>
                                        <a href="{{ $egdInfoUrl }}" class="egd-btn-outline">اقرأ المزيد</a>
                                    </div>
                                </div>
                            </article>

                            @if ($loop->index === 2)
                                {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                                <div class="egd-ad-slot">
                                    <span class="egd-ad-tag">إعلان</span>
                                    <p>مساحة إعلانية (728×90 على الشاشات الكبيرة / 320×50 على الجوال)</p>
                                </div>
                            @endif
                        @empty
                            <p class="text-center text-muted">لا توجد معلومات طبية حاليًا.</p>
                        @endforelse
                    </div>

                    {{ $informations->links('informationmodule::guest.partials.egd-pagination') }}
                </div>

                {{-- Left: related content --}}
                <div class="col-lg-5">
                    <div class="egd-doctor-part">
                        <div class="egd-side-block" id="egd-read-also">
                            <h2 class="egd-side-title">معلومات طبية سريعة</h2>

                            <div class="egd-side-list">
                                @forelse ($readAlso as $information)
                                    @php
                                        $egdReadAlsoUrl = $information->seo?->slug ? url($information->seo->slug) : '#';
                                    @endphp
                                    <a href="{{ $egdReadAlsoUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-notes-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $information->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span><i class="far fa-clock"></i> {{ $information->created_at?->format('d/m/Y') }}</span>
                                            </span>
                                        </span>
                                    </a>
                                @empty
                                    <p class="text-muted mb-0">لا توجد معلومات طبية حاليًا.</p>
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

                            <div class="egd-video-grid">
                                @forelse ($randomVideos as $video)
                                    @php
                                        $egdVideoUrl = $video->seo?->slug ? url($video->seo->slug) : '#';
                                        $egdVideoThumb = $video->img_url
                                            ?: ($video->youtube_code ? 'https://img.youtube.com/vi/' . $video->youtube_code . '/hqdefault.jpg' : null);
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
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
