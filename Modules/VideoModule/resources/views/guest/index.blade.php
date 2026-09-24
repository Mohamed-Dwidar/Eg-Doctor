@extends('layoutmodule::front.main')

@php
    $page_title = 'المقالات الطبية';

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'المقالات الطبية', 'url' => url()->current()];

    $page_meta['title'] = 'المقالات الطبية';
    $page_meta['description'] = 'تصفح أحدث المقالات الطبية على إيجي دكتور، محتوى طبي مبسط يساعدك على فهم صحتك بشكل أفضل.';
@endphp

@section('content')

    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: videos list --}}
                <div class="col-lg-7">
                    <div class="egd-title egd-title-start">
                        <h2>المقالات الطبية</h2>
                    </div>

                    <div class="egd-video-list">
                        @forelse ($videos as $video)
                            @php
                                $egdVideoUrl = $video->seo?->slug ? url($video->seo->slug) : '#';
                                $egdVideoExcerpt = \Illuminate\Support\Str::limit(
                                    html_entity_decode(strip_tags($video->description), ENT_QUOTES, 'UTF-8'),
                                    130
                                );
                            @endphp
                            <article class="egd-video-list-item wow fadeInUp" data-wow-delay="0.05s">
                                <div class="egd-video-list-cover">
                                    @if ($video->img_url)
                                        <img src="{{ $video->img_url }}" alt="{{ $video->title }}" loading="lazy">
                                    @else
                                        <i class="fas fa-play-circle"></i>
                                    @endif
                                </div>

                                <div class="egd-video-list-body">
                                    <h3><a href="{{ $egdVideoUrl }}">{{ $video->title }}</a></h3>

                                    <p>{{ $egdVideoExcerpt }}</p>

                                    <div class="egd-video-list-meta">
                                        <span><i class="far fa-clock"></i> {{ $video->created_at?->format('d/m/Y') }}</span>
                                        <a href="{{ $egdVideoUrl }}" class="egd-btn-outline">شاهد الفيديو</a>
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
                            <p class="text-center text-muted">لا توجد مقالات حاليًا.</p>
                        @endforelse
                    </div>

                    {{ $videos->links('videomodule::guest.partials.egd-pagination') }}
                </div>

                {{-- Left: related content --}}
                <div class="col-lg-5">
                    <div class="egd-doctor-part">
                        <div class="egd-side-block" id="egd-read-also">
                            <h2 class="egd-side-title">اقرأ أيضا</h2>

                            <div class="egd-side-list">
                                @forelse ($readAlso as $video)
                                    @php
                                        $egdReadAlsoUrl = $video->seo?->slug ? url($video->seo->slug) : '#';
                                    @endphp
                                    <a href="{{ $egdReadAlsoUrl }}" class="egd-side-item">
                                        <span class="egd-side-item-icon"><i class="fas fa-notes-medical"></i></span>
                                        <span class="egd-side-item-body">
                                            <h3>{{ $video->title }}</h3>
                                            <span class="egd-side-item-meta">
                                                <span><i class="far fa-clock"></i> {{ $video->created_at?->format('d/m/Y') }}</span>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
