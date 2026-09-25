@extends('layoutmodule::front.main')

@php
    $page_title = $article->title;

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'المقالات الطبية', 'url' => '/مقالات-طبية'];
    $breadcrumb[] = ['title' => $article->title, 'url' => url()->current()];

    $page_meta['title'] = $article->title;
    $page_meta['description'] = \Illuminate\Support\Str::limit(
        html_entity_decode(strip_tags($article->content), ENT_QUOTES, 'UTF-8'),
        160,
    );

    // Several thousand legacy-migrated `pic` filenames don't have a
// matching file under public/uploads/articles (never migrated) —
// check on disk rather than rendering a guaranteed-broken <img>.
$egdArticlePicPath = $article->pic ? public_path('uploads/articles/' . $article->pic) : null;
    $egdArticleHasPic = $egdArticlePicPath && file_exists($egdArticlePicPath);
@endphp

@section('content')
    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: the article itself --}}
                <div class="col-lg-7">
                    <div class="egd-doctor-part">
                        <article class="egd-article-detail-card">
                            <h1>{{ $article->title }}</h1>

                            <div class="egd-article-detail-meta">
                                <span><i class="fas fa-user-md"></i>
                                    {{ $article->doctor?->name ?? 'فريق إيجي دكتور' }}</span>
                                <span><i class="far fa-clock"></i> {{ $article->created_at?->format('d/m/Y') }}</span>
                            </div>

                            @if ($egdArticleHasPic)
                                <img src="{{ asset('uploads/articles/' . $article->pic) }}" alt="{{ $article->title }}"
                                    class="img-fluid rounded mb-4" loading="lazy">
                            @endif

                            <div class="egd-article-detail-body">
                                {!! $article->content !!}
                            </div>
                        </article>

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            {{-- <span class="egd-ad-tag">إعلان</span> --}}
                            <p>
                                <!-- Eg-Doctor - Article - In-article  -->
                                <ins class="adsbygoogle" style="display:block; text-align:center;"
                                    data-ad-layout="in-article" data-ad-format="fluid"
                                    data-ad-client="ca-pub-0462453958685277" data-ad-slot="4174286908"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </p>
                        </div>

                        <div>
                            <div class="egd-title egd-title-start">
                                <h2>مقالات أخرى</h2>
                            </div>

                            <div class="row g-3">
                                @forelse ($otherArticles as $egdOtherArticle)
                                    @php
                                        $egdOtherUrl = $egdOtherArticle->seo?->slug
                                            ? url($egdOtherArticle->seo->slug)
                                            : '#';
                                        $egdOtherExcerpt = \Illuminate\Support\Str::limit(
                                            html_entity_decode(
                                                strip_tags($egdOtherArticle->content),
                                                ENT_QUOTES,
                                                'UTF-8',
                                            ),
                                            80,
                                        );
                                    @endphp
                                    <div class="col-6 col-md-4">
                                        <article class="egd-article-card wow fadeInUp" data-wow-delay="0.05s">
                                            <div class="egd-article-cover"><i class="fas fa-notes-medical"></i></div>
                                            <div class="egd-article-body">
                                                <h3><a href="{{ $egdOtherUrl }}">{{ $egdOtherArticle->title }}</a></h3>

                                                @if ($egdOtherArticle->doctor)
                                                    <span
                                                        class="egd-article-cat">{{ $egdOtherArticle->doctor->name }}</span>
                                                @else
                                                    <span class="egd-article-cat">-</span>
                                                @endif
                                                <p>{{ $egdOtherExcerpt }}</p>

                                                <div class="egd-article-foot">
                                                    <span><i class="far fa-clock"></i>
                                                        {{ $egdOtherArticle->created_at?->format('d/m/Y') }}</span>
                                                    <a href="{{ $egdOtherUrl }}">اقرأ المزيد</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">لا توجد مقالات أخرى حاليًا.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Left: related content --}}
                <div class="col-lg-5">
                    <div class="egd-doctor-part">
                        <div class="egd-side-block" id="egd-read-also">
                            <h2 class="egd-side-title">اقرأ أيضا</h2>

                            <div class="egd-side-list">
                                @forelse ($readAlso as $egdReadAlsoArticle)
                                    @php
                                        $egdReadAlsoUrl = $egdReadAlsoArticle->seo?->slug
                                            ? url($egdReadAlsoArticle->seo->slug)
                                            : '#';
                                    @endphp
                                    <a href="{{ $egdReadAlsoUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-notes-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $egdReadAlsoArticle->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span><i class="far fa-clock"></i>
                                                    {{ $egdReadAlsoArticle->created_at?->format('d/m/Y') }}</span>
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
