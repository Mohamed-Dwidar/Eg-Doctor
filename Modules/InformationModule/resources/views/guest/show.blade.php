@extends('layoutmodule::front.main')

@php
    $page_title = $information->title;

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'معلومات طبية سريعة', 'url' => '/معلومات-طبية-سريعة'];
    $breadcrumb[] = ['title' => $information->title, 'url' => url()->current()];

    $page_meta['title'] = $information->title;
    $page_meta['description'] = \Illuminate\Support\Str::limit(
        html_entity_decode(strip_tags($information->content ?: $information->title), ENT_QUOTES, 'UTF-8'),
        160,
    );
@endphp

@section('content')
    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: the information itself --}}
                <div class="col-lg-7">
                    <div class="egd-doctor-part">
                        <article class="egd-article-detail-card">
                            <h1>{{ $information->title }}</h1>

                            <div class="egd-article-detail-meta">
                                <span><i class="fas fa-user-md"></i> فريق إيجي دكتور</span>
                                <span><i class="far fa-clock"></i> {{ $information->created_at?->format('d/m/Y') }}</span>
                            </div>

                            @if ($information->content)
                                <div class="egd-article-detail-body">
                                    {!! $information->content !!}
                                </div>
                            @endif
                        </article>

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            {{-- <span class="egd-ad-tag">إعلان</span> --}}
                            <p>
                                <!-- Eg-Doctor - Information - in-article -->
                                <ins class="adsbygoogle" style="display:block; text-align:center;"
                                    data-ad-layout="in-article" data-ad-format="fluid"
                                    data-ad-client="ca-pub-0462453958685277" data-ad-slot="1548123561"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
                        </div>

                        <div>
                            <div class="egd-title egd-title-start">
                                <h2>معلومات طبية سريعة أخرى</h2>
                            </div>

                            <div class="row g-3">
                                @forelse ($otherInformations as $egdOtherInfo)
                                    @php
                                        $egdOtherUrl = $egdOtherInfo->seo?->slug ? url($egdOtherInfo->seo->slug) : '#';
                                        $egdOtherExcerpt = $egdOtherInfo->content
                                            ? \Illuminate\Support\Str::limit(
                                                html_entity_decode(
                                                    strip_tags($egdOtherInfo->content),
                                                    ENT_QUOTES,
                                                    'UTF-8',
                                                ),
                                                80,
                                            )
                                            : null;
                                    @endphp
                                    <div class="col-6 col-md-4">
                                        <article class="egd-article-card wow fadeInUp" data-wow-delay="0.05s">
                                            <div class="egd-article-cover"><i class="fas fa-notes-medical"></i></div>
                                            <div class="egd-article-body">
                                                <h3><a href="{{ $egdOtherUrl }}">{{ $egdOtherInfo->title }}</a></h3>

                                                @if ($egdOtherExcerpt)
                                                    <p>{{ $egdOtherExcerpt }}</p>
                                                @endif

                                                <div class="egd-article-foot">
                                                    <span><i class="far fa-clock"></i>
                                                        {{ $egdOtherInfo->created_at?->format('d/m/Y') }}</span>
                                                    <a href="{{ $egdOtherUrl }}">اقرأ المزيد</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">لا توجد معلومات أخرى حاليًا.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Left: related content --}}
                <div class="col-lg-5">
                    <div class="egd-doctor-part">
                        <div class="egd-side-block" id="egd-read-also">
                            <h2 class="egd-side-title">معلومات طبية سريعة</h2>

                            <div class="egd-side-list">
                                @forelse ($readAlso as $egdReadAlsoInfo)
                                    @php
                                        $egdReadAlsoUrl = $egdReadAlsoInfo->seo?->slug
                                            ? url($egdReadAlsoInfo->seo->slug)
                                            : '#';
                                    @endphp
                                    <a href="{{ $egdReadAlsoUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-notes-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $egdReadAlsoInfo->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span><i class="far fa-clock"></i>
                                                    {{ $egdReadAlsoInfo->created_at?->format('d/m/Y') }}</span>
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
                            {{-- <span class="egd-ad-tag">إعلان</span> --}}
                            <p>
                                <!-- Eg-Doctor - Information - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="4266709682" data-ad-format="auto" data-full-width-responsive="true"></ins>
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
                                <!-- Eg-Doctor - Information - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="4266709682" data-ad-format="auto" data-full-width-responsive="true"></ins>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
