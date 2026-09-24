@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.videos') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>{{ __('messages.add_new_video') }}</h4>
    </div>

    <form method="POST" action='{{ route('admin.videos.store') }}'>
        @csrf
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="title">{{ __('messages.title') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                        placeholder="{{ __('messages.title') }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="description">{{ __('messages.description') }} <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control tinymce" id="description" name="description" rows="8">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-4">
                    <label class="form-label" for="youtube_code">{{ __('messages.youtube_code') }}</label>
                    <input type="text" class="form-control" id="youtube_code" name="youtube_code"
                        value="{{ old('youtube_code') }}" placeholder="dQw4w9WgXcQ">
                    @error('youtube_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="video_code">{{ __('messages.video_code') }}</label>
                    <input type="text" class="form-control" id="video_code" name="video_code"
                        value="{{ old('video_code') }}">
                    @error('video_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="img_url">{{ __('messages.img_url') }}</label>
                    <input type="text" class="form-control" id="img_url" name="img_url"
                        value="{{ old('img_url') }}" placeholder="https://...">
                    @error('img_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            @checked(old('is_active'))>
                        <label class="form-check-label" for="is_active">{{ __('messages.status_published') }}</label>
                    </div>
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
                    <label class="form-label" for="meta_tag">{{ __('messages.meta_tag') }}</label>
                    <textarea class="form-control" id="meta_tag" name="meta_tag" rows="3">{{ old('meta_tag') }}</textarea>
                    @error('meta_tag')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="header_script">{{ __('messages.header_script') }}</label>
                    <textarea class="form-control" id="header_script" name="header_script" rows="3">{{ old('header_script') }}</textarea>
                    @error('header_script')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="footer_script">{{ __('messages.footer_script') }}</label>
                    <textarea class="form-control" id="footer_script" name="footer_script" rows="3">{{ old('footer_script') }}</textarea>
                    @error('footer_script')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary me-2"> {{ __('messages.save') }} </button>
        </div>
    </form>
    @push('scripts')
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/init-tinymce.js') }}"></script>
    @endpush
@endsection
