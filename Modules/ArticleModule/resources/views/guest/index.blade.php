@extends('layoutmodule::front.main')

@php
    $page_title = 'المقالات الطبية';

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'المقالات الطبية', 'url' => url()->current()];

    $page_meta['title'] = 'المقالات الطبية';
    $page_meta['description'] =
        'تصفح أحدث المقالات الطبية على إيجي دكتور، محتوى طبي مبسط يساعدك على فهم صحتك بشكل أفضل.';
@endphp

@section('content')
    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: articles list --}}
                <div class="col-lg-7">
                    <div class="egd-title egd-title-start">
                        <h2>المقالات الطبية</h2>
                    </div>

                    <div class="egd-article-list">
                        @forelse ($articles as $article)
                            @php
                                $egdArticleUrl = $article->seo?->slug ? url($article->seo->slug) : '#';
                                $egdArticleExcerpt = \Illuminate\Support\Str::limit(
                                    html_entity_decode(strip_tags($article->content), ENT_QUOTES, 'UTF-8'),
                                    130,
                                );
                            @endphp
                            <article class="egd-article-list-item wow fadeInUp" data-wow-delay="0.05s">
                                <div class="egd-article-list-cover"><i class="fas fa-notes-medical"></i></div>

                                <div class="egd-article-list-body">
                                    <h3><a href="{{ $egdArticleUrl }}">{{ $article->title }}</a></h3>

                                    @if ($article->doctor)
                                        <span class="egd-specialty-tag">{{ $article->doctor->name }}</span>
                                    @else
                                        <span class="egd-specialty-tag">-</span>
                                    @endif

                                    <p>{{ $egdArticleExcerpt }}</p>

                                    <div class="egd-article-list-meta">
                                        <span><i class="far fa-clock"></i>
                                            {{ $article->created_at?->format('d/m/Y') }}</span>
                                        <a href="{{ $egdArticleUrl }}" class="egd-btn-outline">اقرأ المزيد</a>
                                    </div>
                                </div>
                            </article>

                            @if ($loop->index === 2)
                                {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                                <div class="egd-ad-slot">
                                    {{-- <span class="egd-ad-tag">إعلان</span> --}}
                                    <p>
                                        <!-- Eg-Doctor - Article - In-feed  -->
                                        <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"
                                            data-ad-layout-key="-gw-3+1f-3d+2z" data-ad-client="ca-pub-0462453958685277"
                                            data-ad-slot="4365858592"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || [])
                                            .push({});
                                        </script>
                                    </p>
                                </div>
                            @endif
                        @empty
                            <p class="text-center text-muted">لا توجد مقالات حاليًا.</p>
                        @endforelse
                    </div>

                    {{ $articles->links('articlemodule::guest.partials.egd-pagination') }}
                </div>

                {{-- Left: related content --}}
                <div class="col-lg-5">
                    <div class="egd-doctor-part">
                        <div class="egd-side-block" id="egd-read-also">
                            <h2 class="egd-side-title">اقرأ أيضا</h2>

                            <div class="egd-side-list">
                                @forelse ($readAlso as $article)
                                    @php
                                        $egdReadAlsoUrl = $article->seo?->slug ? url($article->seo->slug) : '#';
                                    @endphp
                                    <a href="{{ $egdReadAlsoUrl }}" class="egd-side-item">
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
                                <!-- Eg-Doctor - Article - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="8533257756" data-ad-format="auto" data-full-width-responsive="true"></ins>
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
                                <!-- Eg-Doctor - Article - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="8533257756" data-ad-format="auto" data-full-width-responsive="true"></ins>
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
                                <!-- Eg-Doctor - Article - Display -->
                                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-0462453958685277"
                                    data-ad-slot="8533257756" data-ad-format="auto" data-full-width-responsive="true"></ins>
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
