@extends('layoutmodule::front.main')

@php
    $page_title = 'الاستشارات و الأسئلة الطبية';

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'الاستشارات الطبية', 'url' => url()->current()];

    $page_meta['title'] = 'الاستشارات و الأسئلة الطبية';
    $page_meta['description'] = 'تصفح أسئلة طرحها مرضى آخرون وأجاب عليها أطباء متخصصون على إيجي دكتور.';
@endphp

@section('content')
    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: questions list --}}
                <div class="col-lg-7">
                    <div class="egd-title egd-title-start">
                        <h2>الاستشارات و الأسئلة الطبية</h2>
                    </div>

                    <div class="egd-article-list">
                        @forelse ($questions as $question)
                            @php
                                $egdQuestionUrl = $question->seo?->slug ? url($question->seo->slug) : '#';
                                $egdQuestionExcerpt = \Illuminate\Support\Str::limit(
                                    strip_tags($question->question),
                                    130,
                                );
                            @endphp
                            <article class="egd-article-list-item wow fadeInUp" data-wow-delay="0.05s">
                                <div class="egd-article-list-cover"><i class="fas fa-comment-medical"></i></div>

                                <div class="egd-article-list-body">
                                    <h3><a href="{{ $egdQuestionUrl }}">{{ $question->title }}</a></h3>
                                    <span class="egd-specialty-tag">{{ $question->writer ?: 'زائر' }}</span>

                                    <p>{{ $egdQuestionExcerpt }}</p>

                                    <div class="egd-article-list-meta">
                                        <span><i class="fas fa-comment-medical"></i> {{ $question->answers_count }}
                                            إجابة</span>
                                        <a href="{{ $egdQuestionUrl }}" class="egd-btn-outline">عرض الإجابات</a>
                                    </div>
                                </div>
                            </article>

                            @if ($loop->index === 2)
                                {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                                <div class="egd-ad-slot">
                                    {{-- <span class="egd-ad-tag">إعلان</span> --}}
                                    <p>
                                        <!-- Eg-Doctor - Question - In-feed -->
                                        <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"
                                            data-ad-layout-key="-gw-3+1f-3d+2z" data-ad-client="ca-pub-0462453958685277"
                                            data-ad-slot="5523951030"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || [])
                                            .push({});
                                        </script>
                                    </p>
                                </div>
                            @endif
                        @empty
                            <p class="text-center text-muted">لا توجد استشارات حاليًا.</p>
                        @endforelse
                    </div>

                    {{ $questions->links('questionmodule::guest.partials.egd-pagination') }}
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
                                <!-- Eg-Doctor - Question - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="6425794157" data-ad-format="auto" data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
                        </div>

                        <div class="egd-side-block" id="egd-videos">
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
                                <!-- Eg-Doctor - Question - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="6425794157" data-ad-format="auto" data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
                        </div>

                        <div class="egd-side-block" id="egd-related-consultations">
                            <h2 class="egd-side-title">استشارات الزوار</h2>

                            <div class="egd-side-list">
                                @forelse ($latestQuestions as $latestQuestion)
                                    @php
                                        $egdLatestQuestionUrl = $latestQuestion->seo?->slug
                                            ? url($latestQuestion->seo->slug)
                                            : '#';
                                    @endphp
                                    <a href="{{ $egdLatestQuestionUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-comment-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $latestQuestion->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span>{{ $latestQuestion->writer ?: 'زائر' }}</span>
                                                <span>{{ $latestQuestion->answers_count }} إجابة</span>
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
                                <!-- Eg-Doctor - Question - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="6425794157" data-ad-format="auto" data-full-width-responsive="true"></ins>
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
