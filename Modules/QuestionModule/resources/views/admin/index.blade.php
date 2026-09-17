@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.questions') }}
@endsection



@push('styles')
@endpush

@section('content')

    {{-- Search & Filter --}}
    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('admin.questions') }}" id="filter-form">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">{{ __('messages.search') }}</label>
                    <input type="text" name="title" class="form-control form-control-sm"
                        placeholder="{{ __('messages.title') }}" value="{{ request('title') }}">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="ti ti-search"></i>
                    </button>
                    <a href="{{ route('admin.questions') }}" class="btn btn-secondary btn-sm w-100">
                        <i class="ti ti-x"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body table-border-style">
        <div class="card-header">
            <div class="d-flex justify-content-end gap-2">
                <form action="{{ route('admin.questions.apply-seo') }}" method="POST" id="apply-seo-form">
                    @csrf
                    <button type="button" class="btn btn-outline-primary" id="apply-seo-btn">
                        {{ __('messages.apply_seo_to_all') }}
                    </button>
                </form>
                <a class="btn btn-primary" href="{{ route('admin.questions.add') }}">{{ __('messages.add_new') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="align-middle">{{ __('messages.title') }}</th>
                        <th class="align-middle">{{ __('messages.writer') }}</th>
                        <th class="align-middle">{{ __('messages.answers') }}</th>
                        <th class="align-middle">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($questions as $question)
                        <tr>
                            <td>{{ $question->title }}</td>
                            <td>{{ $question->writer }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-secondary btn-sm view-answers-btn"
                                    data-bs-toggle="modal" data-bs-target="#answersModal"
                                    data-question-id="{{ $question->id }}"
                                    data-question-title="{{ $question->title }}">
                                    {{ $question->answers_count }} {{ __('messages.answers') }}
                                </button>
                            </td>
                            <td style="width: 5%">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.questions.edit', $question->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.questions.delete', $question->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('post')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">{{ __('messages.no_items_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {!! $questions->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </div>
    </div>

    {{-- Answers modal (read-only — answers themselves aren't managed from the admin yet) --}}
    <div class="modal fade" id="answersModal" tabindex="-1" aria-labelledby="answersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="answersModalLabel">{{ __('messages.answers') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="answersModalBody">
                    <div class="text-center text-muted">{{ __('messages.loading') }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Handle delete action
            $(document).on('click', '.delete-btn', function() {
                const form = $(this).closest('.delete-form');
                Swal.fire({
                    title: '{{ __('messages.are_you_sure_to_delete') }}',
                    text: '{{ __('messages.you_will_not_be_able_to_recover_this') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('messages.yes_delete_it') }}',
                    cancelButtonText: '{{ __('messages.no_cancel') }}',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Handle bulk apply-SEO action
            $(document).on('click', '#apply-seo-btn', function() {
                const form = $('#apply-seo-form');
                Swal.fire({
                    title: '{{ __('messages.apply_seo_to_all') }}?',
                    text: '{{ __('messages.apply_seo_confirm_text') }}',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: '{{ __('messages.yes') }}',
                    cancelButtonText: '{{ __('messages.no_cancel') }}',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Load a question's answers into the modal when it's opened
            const answersUrlTemplate = @json(route('admin.questions.answers', ['id' => '__QUESTION_ID__']));

            document.getElementById('answersModal').addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const questionId = button.getAttribute('data-question-id');
                const questionTitle = button.getAttribute('data-question-title');
                const $body = $('#answersModalBody');

                document.getElementById('answersModalLabel').textContent =
                    '{{ __('messages.answers') }} — ' + questionTitle;
                $body.html('<div class="text-center text-muted">{{ __('messages.loading') }}</div>');

                $.get(answersUrlTemplate.replace('__QUESTION_ID__', questionId), function(answers) {
                    if (!answers.length) {
                        $body.html('<div class="text-center text-muted">{{ __('messages.no_answers_found') }}</div>');
                        return;
                    }

                    let html = '<ul class="list-group">';
                    answers.forEach(function(answer) {
                        html += '<li class="list-group-item">' +
                            '<div>' + $('<div>').text(answer.answer).html() + '</div>' +
                            (answer.writer ?
                                '<small class="text-muted">' + $('<div>').text(answer.writer)
                                .html() + '</small>' :
                                '') +
                            '</li>';
                    });
                    html += '</ul>';
                    $body.html(html);
                }).fail(function() {
                    $body.html('<div class="text-center text-danger">{{ __('messages.something_went_wrong') }}</div>');
                });
            });
        });
    </script>
@endpush
