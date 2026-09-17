@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.degrees') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>{{ __('messages.update_degree') }}</h4>
    </div>
    <form class="" method="POST" action='{{ route('admin.degrees.update', $degree->id) }}' enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $degree->id }}">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="name">{{ __('messages.name') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $degree->name) }}"
                        placeholder="{{ __('messages.name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary me-2"> {{ __('messages.save') }} </button>
            {{-- <button class="btn btn-secondary">Clear</button> --}}
        </div>
    </form>
    @push('scripts')
    @endpush
@endsection
