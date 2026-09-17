@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.articles') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>{{ __('messages.add_new_article') }}</h4>
    </div>

    <form class="" method="POST" action='{{ route('admin.articles.store') }}' enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-lg-8">
                    <label class="form-label" for="title">{{ __('messages.title') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                        placeholder="{{ __('messages.title') }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="doctor_id">{{ __('messages.doctor') }}</label>
                    <select class="form-select" id="doctor_id" name="doctor_id">
                        <option value="">{{ __('messages.select_doctor') }}</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="content">{{ __('messages.content') }} <span
                            class="text-danger">*</span></label>
                    <textarea class="form-control tinymce" id="content" name="content" rows="8">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="pic">{{ __('messages.pic') }}</label>
                    <input type="file" class="form-control" id="pic" name="pic" accept="image/*">
                    @error('pic')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 d-flex align-items-end">
                    <div class="form-check">
                        <input type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                            @checked(old('status'))>
                        <label class="form-check-label" for="status">{{ __('messages.status_published') }}</label>
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
            {{-- <button class="btn btn-secondary">Clear</button> --}}
        </div>
    </form>
    @push('scripts')
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/init-tinymce.js') }}"></script>
    @endpush
@endsection
