@extends('layoutmodule::front.main')

@php
    $page_title = $question->title;

    $breadcrumb[] = ['title' => 'الرئيسية', 'url' => route('home_page')];
    $breadcrumb[] = ['title' => 'الاستشارات الطبية', 'url' => '/استشارات-و-اسئلة-طبية'];
    $breadcrumb[] = ['title' => $question->title, 'url' => url()->current()];

    $page_meta['title'] = $question->title;
    $page_meta['description'] = \Illuminate\Support\Str::limit(strip_tags($question->question), 160);

    // Placeholder video grid — there's no VideoModule/data source yet.
    // Swap each entry for a real YouTube video (id + title) once
    // available; url stays "#" until then.
    $egdPlaceholderVideos = [
        ['title' => 'فيديو تجريبي 1', 'url' => '#'],
        ['title' => 'فيديو تجريبي 2', 'url' => '#'],
        ['title' => 'فيديو تجريبي 3', 'url' => '#'],
        ['title' => 'فيديو تجريبي 4', 'url' => '#'],
    ];
@endphp

@section('content')

    <section class="egd-section">
        <div class="container">
            <div class="row g-4">
                {{-- Right: the question, its answers, and the answer form --}}
                <div class="col-lg-7">
                    <div class="egd-doctor-part">
                        <article class="egd-article-detail-card egd-question-detail-card">
                            <h1>{{ $question->title }}</h1>

                            <div class="egd-article-detail-meta">
                                <span><i class="fas fa-user"></i> {{ $question->writer ?: 'زائر' }}</span>
                                <span><i class="far fa-clock"></i> {{ $question->created_at?->format('d/m/Y') }}</span>
                            </div>

                            <div class="egd-question-detail-body">{{ $question->question }}</div>

                            <a href="#answer-form" class="egd-btn"><i class="fas fa-reply"></i> اضف رد علي السؤال</a>
                        </article>

                        {{-- Google AdSense placement — swap this placeholder for your real <ins class="adsbygoogle"> unit --}}
                        <div class="egd-ad-slot">
                            <span class="egd-ad-tag">إعلان</span>
                            <p>مساحة إعلانية (728×90 على الشاشات الكبيرة / 320×50 على الجوال)</p>
                        </div>

                        <div class="answers-list">
                            <div class="egd-title egd-title-start">
                                <h2 id="egd-answers-count">الإجابات ({{ $answers->total() }})</h2>
                            </div>

                            <div id="egd-answers-list">
                                @forelse ($answers as $answer)
                                    <div class="egd-answer-card">
                                        <div class="egd-answer-meta">
                                            <i class="fas fa-user-md"></i> {{ $answer->writer ?: 'زائر' }}
                                            <span class="text-muted">&middot; {{ $answer->created?->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <p>{{ $answer->answer }}</p>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0" id="egd-answers-empty">لا توجد ردود حتى الآن، كن أول من يرد.</p>
                                @endforelse
                            </div>

                            {{ $answers->links('questionmodule::guest.partials.egd-pagination') }}
                        </div>

                        <div id="answer-form">
                            <div class="egd-title egd-title-start">
                                <h2>أضف ردك</h2>
                            </div>

                            <div class="egd-article-detail-card">
                                <div id="egd-answer-result">
                                    @if (session('success'))
                                        <div class="egd-alert-success">{{ session('success') }}</div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="egd-alert-danger">
                                            <strong>يرجى تصحيح الآتي:</strong>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <div id="egd-answer-loading" class="egd-form-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i> جاري إرسال ردك...
                                </div>

                                <div id="egd-answer-form-wrapper">
                                    <form method="POST" action="{{ route('questions.answer.store', $question->id) }}" id="egd-answer-form" novalidate>
                                        @csrf

                                        <div class="egd-form-group">
                                            <label for="writer">الاسم</label>
                                            <input type="text" id="writer" name="writer" value="{{ old('writer') }}" placeholder="اسمك">
                                            <span class="egd-form-error" data-error-for="writer"></span>
                                        </div>

                                        <div class="egd-form-group">
                                            <label for="answer">الرد</label>
                                            <textarea id="answer" name="answer" rows="4" maxlength="300" placeholder="اكتب ردك هنا">{{ old('answer') }}</textarea>
                                            <span class="egd-char-count" id="egd-answer-char-count">0 / 300</span>
                                            <span class="egd-form-error" data-error-for="answer"></span>
                                        </div>

                                        <button type="submit" class="egd-btn" id="egd-answer-submit"><i class="fas fa-paper-plane"></i> إرسال الرد</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="egd-title egd-title-start">
                                <h2>استشارات طبية أخرى</h2>
                            </div>

                            <div class="row g-4">
                                @forelse ($otherQuestions as $otherQuestion)
                                    @php
                                        $egdOtherQuestionUrl = $otherQuestion->seo?->slug ? url($otherQuestion->seo->slug) : '#';
                                    @endphp
                                    <div class="col-md-6 col-lg-4">
                                        <a href="{{ $egdOtherQuestionUrl }}" class="egd-consult-card wow fadeInUp" data-wow-delay="0.05s">
                                            <div class="egd-consult-q">
                                                <i class="fas fa-comment-medical"></i>
                                                <h3>{{ $otherQuestion->title }}</h3>
                                            </div>
                                            <div class="egd-consult-meta">
                                                <span>{{ $otherQuestion->writer ?: 'زائر' }}</span>
                                                <span>{{ $otherQuestion->answers_count }} إجابة</span>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">لا توجد استشارات أخرى حاليًا.</p>
                                @endforelse
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

                        <div class="egd-side-block" id="egd-videos">
                            <h2 class="egd-side-title">فيديوهات طبية</h2>

                            <div class="egd-video-grid">
                                @foreach ($egdPlaceholderVideos as $egdVideo)
                                    <a href="{{ $egdVideo['url'] }}" class="egd-video-item">
                                        <span class="egd-video-thumb"><i class="fab fa-youtube"></i></span>
                                        <h3>{{ $egdVideo['title'] }}</h3>
                                    </a>
                                @endforeach
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
                                @forelse ($latestQuestions as $latestQuestion)
                                    @php
                                        $egdLatestQuestionUrl = $latestQuestion->seo?->slug ? url($latestQuestion->seo->slug) : '#';
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        $(function () {
            const $wrapper = $('#egd-answer-form-wrapper');
            const $loading = $('#egd-answer-loading');
            const $result = $('#egd-answer-result');
            const $form = $('#egd-answer-form');
            const $answer = $('#answer');
            const $charCount = $('#egd-answer-char-count');
            const ANSWER_MAX_LENGTH = 300;

            function egdEscape(text) {
                return $('<div>').text(text ?? '').html();
            }

            function egdUpdateCharCount() {
                const length = $answer.val().length;
                $charCount.text(length + ' / ' + ANSWER_MAX_LENGTH);
                $charCount.toggleClass('egd-char-count-limit', length >= ANSWER_MAX_LENGTH);
            }

            egdUpdateCharCount();
            $answer.on('input', egdUpdateCharCount);

            function egdClearErrors() {
                $form.find('.egd-form-error').text('');
                $form.find('.egd-form-group input, .egd-form-group textarea').removeClass('egd-input-invalid');
            }

            function egdShowFieldError(field, message) {
                $form.find('[data-error-for="' + field + '"]').text(message);
                $form.find('#' + field).addClass('egd-input-invalid');
            }

            function egdPrependAnswer(answer) {
                $('#egd-answers-empty').remove();

                const $card = $(
                    '<div class="egd-answer-card">' +
                        '<div class="egd-answer-meta">' +
                            '<i class="fas fa-user-md"></i> ' + egdEscape(answer.writer) +
                            ' <span class="text-muted">&middot; ' + egdEscape(answer.date) + '</span>' +
                        '</div>' +
                        '<p></p>' +
                    '</div>'
                );
                $card.find('p').text(answer.answer);
                $('#egd-answers-list').prepend($card);

                const $count = $('#egd-answers-count');
                const total = parseInt(($count.text().match(/\d+/) || [0])[0], 10) + 1;
                $count.text('الإجابات (' + total + ')');
            }

            $form.on('submit', function (e) {
                e.preventDefault();

                egdClearErrors();
                $result.empty();

                const writer = $.trim($('#writer').val());
                const answer = $.trim($('#answer').val());
                let hasError = false;

                if (!writer) {
                    egdShowFieldError('writer', 'الاسم مطلوب.');
                    hasError = true;
                }

                if (!answer) {
                    egdShowFieldError('answer', 'الرد مطلوب.');
                    hasError = true;
                } else if (answer.length < 5) {
                    egdShowFieldError('answer', 'الرد قصير جدًا.');
                    hasError = true;
                } else if (answer.length > ANSWER_MAX_LENGTH) {
                    egdShowFieldError('answer', 'الرد يتجاوز الحد الأقصى المسموح به (' + ANSWER_MAX_LENGTH + ' حرف).');
                    hasError = true;
                }

                if (hasError) {
                    return;
                }

                $wrapper.hide();
                $loading.show();

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    dataType: 'json',
                    data: $form.serialize(),
                }).done(function (response) {
                    $loading.hide();
                    $wrapper.show();
                    $result.html('<div class="egd-alert-success">' + egdEscape(response.message) + '</div>');
                    $form[0].reset();
                    egdUpdateCharCount();

                    if (response.answer) {
                        egdPrependAnswer(response.answer);
                    }
                }).fail(function (xhr) {
                    $loading.hide();
                    $wrapper.show();

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, messages) {
                            egdShowFieldError(field, messages[0]);
                        });
                        $result.html('<div class="egd-alert-danger">يرجى تصحيح الأخطاء الموضحة أدناه.</div>');
                    } else {
                        $result.html('<div class="egd-alert-danger">حدث خطأ غير متوقع، برجاء المحاولة مرة أخرى.</div>');
                    }
                });
            });
        });
    </script>
    @endpush

@endsection
