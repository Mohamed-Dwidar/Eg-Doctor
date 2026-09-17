@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.pages') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>{{ __('messages.add_new_page') }}</h4>
    </div>

    <form class="" method="POST" action='{{ route('admin.pages.store') }}' enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="title">{{ __('messages.title') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title') }}" placeholder="{{ __('messages.title') }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="slug">{{ __('messages.slug') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug"
                        value="{{ old('slug') }}" placeholder="{{ __('messages.slug') }}">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="parent_id">{{ __('messages.parent_page') }}</label>
                    <select class="form-select" id="parent_id" name="parent_id">
                        <option value="">{{ __('messages.select_parent_page') }}</option>
                        @foreach ($top_page as $top_page)
                            <option value="{{ $top_page->id }}" {{ old('parent_id') == $top_page->id ? 'selected' : '' }}>
                                {{ $top_page->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="is_active">{{ __('messages.is_active') }}</label>
                    <select class="form-select" id="is_active" name="is_active">
                        <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>{{ __('messages.yes') }}</option>
                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>{{ __('messages.no') }}</option>
                    </select>
                    @error('is_active')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="content">{{ __('messages.content') }} <span class="text-danger">*</span></label>
                    <textarea class="form-control tinymce" id="content" name="content" rows="5">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_title">{{ __('messages.meta_title') }}</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ old('meta_title') }}" placeholder="{{ __('messages.meta_title') }}">
                    @error('meta_title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_description">{{ __('messages.meta_description') }}</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_keywords">{{ __('messages.meta_keywords') }}</label>
                    <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3">{{ old('meta_keywords') }}</textarea>
                    @error('meta_keywords')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            

            <div class="row mb-3">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="image">{{ __('messages.image') }} <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image"
                            value="{{ old('image') }}">
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary me-2"> {{ __('messages.save') }} </button>
            {{-- <button class="btn btn-secondary">Clear</button> --}}
        </div>
    </form>
    @push('scripts')
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/init-tinymce.js') }}"></script>
    @endpush
@endsection
