@extends('layoutmodule::admin.main')

@section('title')
    Blogs
@endsection

@push('styles')
@endpush

@section('content')

    <div class="card-header">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('admin.blogs.add') }}">{{ __('messages.add_new') }}</a>
        </div>
    </div>

    <div class="card-body table-border-style">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="align-middle">{{ __('messages.image') }}</th>
                        <th class="align-middle">Title (AR)</th>
                        <th class="align-middle">Title (EN)</th>
                        <th class="align-middle">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($blogs))
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>
                                    <img src="{{ $blog->imageFullPath }}" alt="{{ $blog->img_alt }}" class="img-fluid"
                                        style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>{{ $blog->name_ar }}</td>
                                <td>{{ $blog->name_en }}</td>
                                <td style="width: 5%">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <a href="{{ route('admin.blogs.delete', $blog->id) }}"
                                            class="btn btn-danger btn-sm delete-btn">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {!! $blogs->links('pagination::bootstrap-4') !!}
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
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
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
@endpush
