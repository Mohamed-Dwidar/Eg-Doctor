@extends('layoutmodule::front.main')

@php
    $page_title = $video->title;

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'فيديوهات طبية', 'url' => route('videos')];
    $breadcrumb[] = ['title' => $video->title, 'url' => url()->current()];

    $page_meta['title'] = $video->title;
    $page_meta['description'] = \Illuminate\Support\Str::limit(
        html_entity_decode(strip_tags($video->description), ENT_QUOTES, 'UTF-8'),
        160
    );
@endphp

@section('content')

    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: the video itself --}}
                <div class="col-lg-7">
                    <div class="egd-doctor-part">
                        <article class="egd-video-detail-card">
                            <h1>{{ $video->title }}</h1>

                            <div class="egd-video-detail-meta">
                                <span><i class="fas fa-user-md"></i> فريق إيجي دكتور</span>
                                <span><i class="far fa-clock"></i> {{ $video->created_at?->format('d/m/Y') }}</span>
                                <span><i class="far fa-eye"></i> {{ $video->views_nu }} مشاهدة</span>
                            </div>

                            @if ($video->youtube_code)
                                <div class="egd-video-embed ratio ratio-16x9 mb-4">
                                    <iframe src="https://www.youtube.com/embed/{{ $video->youtube_code }}"
                                        title="{{ $video->title }}" allowfullscreen
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                                </div>
                            @elseif ($video->video_code)
                                <div class="egd-video-embed ratio ratio-16x9 mb-4">
                                    {!! $video->video_code !!}
                                </div>
                            @elseif ($video->img_url)
                                <img src="{{ $video->img_url }}" alt="{{ $video->title }}"
                                    class="img-fluid rounded mb-4" loading="lazy">
                            @endif

                            <div class="egd-video-detail-body">
                                {!! $video->description !!}
                            </div>
                        </article>

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            <span class="egd-ad-tag">إعلان</span>
                            <p>مساحة إعلانية (728×90 على الشاشات الكبيرة / 320×50 على الجوال)</p>
                        </div>

                        <div>
                            <div class="egd-title egd-title-start">
                                <h2>فيديوهات أخرى</h2>
                            </div>

                            <div class="row g-3">
                                @forelse ($otherVideos as $egdOtherVideo)
                                    @php
                                        $egdOtherUrl = $egdOtherVideo->seo?->slug ? url($egdOtherVideo->seo->slug) : '#';
                                        $egdOtherExcerpt = \Illuminate\Support\Str::limit(
                                            html_entity_decode(strip_tags($egdOtherVideo->description), ENT_QUOTES, 'UTF-8'),
                                            80
                                        );
                                        $egdOtherThumb = $egdOtherVideo->img_url
                                            ?: ($egdOtherVideo->youtube_code ? 'https://img.youtube.com/vi/' . $egdOtherVideo->youtube_code . '/hqdefault.jpg' : null);
                                    @endphp
                                    <div class="col-6 col-md-4">
                                        <article class="egd-video-card wow fadeInUp" data-wow-delay="0.05s">
                                            <div class="egd-video-cover">
                                                @if ($egdOtherThumb)
                                                    <img src="{{ $egdOtherThumb }}" alt="{{ $egdOtherVideo->title }}" loading="lazy">
                                                @else
                                                    <i class="fas fa-play-circle"></i>
                                                @endif
                                            </div>
                                            <div class="egd-video-body">
                                                <h3><a href="{{ $egdOtherUrl }}">{{ $egdOtherVideo->title }}</a></h3>

                                                <p>{{ $egdOtherExcerpt }}</p>

                                                <div class="egd-video-foot">
                                                    <span><i class="far fa-clock"></i> {{ $egdOtherVideo->created_at?->format('d/m/Y') }}</span>
                                                    <a href="{{ $egdOtherUrl }}">شاهد الفيديو</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">لا توجد فيديوهات أخرى حاليًا.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Left: related content --}}
                <div class="col-lg-5">
                    <div class="egd-doctor-part">
                        <div class="egd-side-block" id="egd-read-also">
                            <h2 class="egd-side-title">شاهد أيضا</h2>

                            <div class="egd-side-list">
                                @forelse ($readAlso as $egdReadAlsoVideo)
                                    @php
                                        $egdReadAlsoUrl = $egdReadAlsoVideo->seo?->slug ? url($egdReadAlsoVideo->seo->slug) : '#';
                                    @endphp
                                    <a href="{{ $egdReadAlsoUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-play-circle"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $egdReadAlsoVideo->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span><i class="far fa-clock"></i> {{ $egdReadAlsoVideo->created_at?->format('d/m/Y') }}</span>
                                            </span>
                                        </span>
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

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            <span class="egd-ad-tag">إعلان</span>
                            <p>مساحة إعلانية (300×250)</p>
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
                                                <span><i class="far fa-clock"></i> {{ $information->created_at?->format('d/m/Y') }}</span>
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
