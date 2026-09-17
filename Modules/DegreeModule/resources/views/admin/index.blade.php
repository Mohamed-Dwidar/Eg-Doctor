@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.degrees') }}
@endsection



@push('styles')
@endpush

@section('content')

    {{-- Search & Filter --}}
    <div class="card-body border-bottom pb-3">
        <form method="GET" action="{{ route('admin.degrees') }}" id="filter-form">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">{{ __('messages.search') }}</label>
                    <input type="text" name="name" class="form-control form-control-sm"
                        placeholder="{{ __('messages.search_by_name') }}" value="{{ request('name') }}">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="ti ti-search"></i>
                    </button>
                    <a href="{{ route('admin.degrees') }}" class="btn btn-secondary btn-sm w-100">
                        <i class="ti ti-x"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="card-body table-border-style">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a class="btn btn-primary" href="{{ route('admin.degrees.add') }}">{{ __('messages.add_new') }}</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="align-middle">{{ __('messages.name') }}</th>
                        <th class="align-middle">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($degrees as $degree)
                        <tr>
                            <td>{{ $degree->name }}</td>
                            <td style="width: 5%">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.degrees.edit', $degree->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.degrees.delete', $degree->id) }}" method="POST"
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
                            <td colspan="2" class="text-center">{{ __('messages.no_items_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {!! $degrees->appends(request()->query())->links('pagination::bootstrap-4') !!}
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
@endpush
