@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.manual_seo') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>{{ __('messages.update_manual_seo') }}</h4>
    </div>

    <form method="POST" action='{{ route('admin.seo.manual.update') }}'>
        @csrf
        <input type="hidden" name="id" value="{{ $seo->id }}">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="slug">{{ __('messages.slug') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug"
                        value="{{ old('slug', $seo->slug) }}">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="target_path">{{ __('messages.target_path') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="target_path" name="target_path"
                        value="{{ old('target_path', $seo->target_path) }}">
                    @error('target_path')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_title">{{ __('messages.meta_title') }}</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $seo->meta_title) }}" placeholder="{{ __('messages.meta_title') }}">
                    @error('meta_title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_description">{{ __('messages.meta_description') }}</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $seo->meta_description) }}</textarea>
                    @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_tag">{{ __('messages.meta_tag') }}</label>
                    <textarea class="form-control" id="meta_tag" name="meta_tag" rows="3">{{ old('meta_tag', $seo->meta_tag) }}</textarea>
                    @error('meta_tag')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="header_script">{{ __('messages.header_script') }}</label>
                    <textarea class="form-control" id="header_script" name="header_script" rows="3">{{ old('header_script', $seo->header_script) }}</textarea>
                    @error('header_script')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="footer_script">{{ __('messages.footer_script') }}</label>
                    <textarea class="form-control" id="footer_script" name="footer_script" rows="3">{{ old('footer_script', $seo->footer_script) }}</textarea>
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
@endsection
