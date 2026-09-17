@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.pages') }}
@endsection



@push('styles')
@endpush

@section('content')

    <div class="card-header">
        <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('admin.pages.add') }}">{{ __('messages.add_new') }}</a>
        </div>
    </div>

    <div class="card-body table-border-style">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th class="align-middle">{{ __('messages.page_number') }}</th> --}}
                        <th class="align-middle">{{ __('messages.page_title') }}</th>
                        <th class="align-middle">{{ __('messages.slug') }}</th>
                        <th class="align-middle">{{ __('messages.parent_page') }}</th>
                        <th class="align-middle">{{ __('messages.image') }}</th>
                        <th class="align-middle">{{ __('messages.status') }}</th>
                        <th class="align-middle">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($pages))
                        @foreach ($pages as $page)
                            <tr>
                                {{-- <td>{{ $page->id }}</td> --}}
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>
                                    @if ($page->parent)
                                        {{ $page->parent->title }}
                                    @else
                                        {{ __('messages.no_parent') }}
                                    @endif
                                </td>
                                <td>
                                    <img src="{{ $page->imagePath }}" alt="{{ $page->name }}" class="img-fluid"
                                        style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        @if ($page->is_active)
                                            <i class="ti ti-check text-success" title="{{ __('messages.active') }}"></i>
                                        @else
                                            <i class="ti ti-x text-danger" title="{{ __('messages.inactive') }}"></i>
                                        @endif
                                    </div>
                                </td>

                                <td style="width: 5%">
                                    <!-- Actions: Edit & Delete -->
                                    <div class="d-flex gap-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.pages.edit', $page->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="ti ti-pencil"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.pages.delete', $page->id) }}" method="POST"
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
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {!! $pages->links('pagination::bootstrap-4') !!}
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
        });
    </script>
    <script>
        $('.switch__input').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var page_id = $(this).data('id');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: '/admin/pages/changePageActivity/' + page_id,
                data: {
                    'is_active': status,
                    'page_id': page_id
                },
                success: function(data) {

                },
                beforeSend: () => {
                    $(this).parent().find('#loader').show();
                    $(this).parent().find('.switch__input').hide();
                },
                complete: () => {
                    $(this).parent().find('#loader').hide();
                    $(this).parent().show();
                },
            });

        });

        $(document).ajaxComplete(function() {
            // Hide image container
            //$("#loader").hide();
        });
    </script>
@endpush
