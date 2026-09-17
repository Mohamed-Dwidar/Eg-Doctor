@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.questions') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>{{ __('messages.add_new_question') }}</h4>
    </div>

    <form class="" method="POST" action='{{ route('admin.questions.store') }}' enctype="multipart/form-data">
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
                    <label class="form-label" for="question">{{ __('messages.question') }} <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" id="question" name="question" rows="4">{{ old('question') }}</textarea>
                    @error('question')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="writer">{{ __('messages.writer') }}</label>
                    <input type="text" class="form-control" id="writer" name="writer" value="{{ old('writer') }}">
                    @error('writer')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="email">{{ __('messages.email') }}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
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
            {{-- <button class="btn btn-secondary">Clear</button> --}}
        </div>
    </form>
    @push('scripts')
    @endpush
@endsection
