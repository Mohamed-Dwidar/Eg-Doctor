@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.manual_seo') }}
@endsection

@push('styles')
@endpush

@section('content')

    {{-- Search & Filter --}}
    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('admin.seo.manual') }}" id="filter-form">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">{{ __('messages.search') }}</label>
                    <input type="text" name="slug" class="form-control form-control-sm"
                        placeholder="{{ __('messages.slug') }}" value="{{ request('slug') }}">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="ti ti-search"></i>
                    </button>
                    <a href="{{ route('admin.seo.manual') }}" class="btn btn-secondary btn-sm w-100">
                        <i class="ti ti-x"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body table-border-style">
        <div class="card-header">
            <div class="d-flex justify-content-end gap-2">
                <a class="btn btn-primary" href="{{ route('admin.seo.manual.add') }}">{{ __('messages.add_new') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="align-middle">{{ __('messages.slug') }}</th>
                        <th class="align-middle">{{ __('messages.target_path') }}</th>
                        <th class="align-middle">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($seos as $seo)
                        <tr>
                            <td>{{ $seo->slug }}</td>
                            <td>
                                <a href="{{ url($seo->target_path) }}" target="_blank">
                                    /{{ $seo->target_path }}
                                </a>
                            </td>
                            <td style="width: 5%">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.seo.manual.edit', $seo->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.seo.manual.delete', $seo->id) }}" method="POST"
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
                            <td colspan="3" class="text-center">{{ __('messages.no_items_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {!! $seos->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
@endpush
