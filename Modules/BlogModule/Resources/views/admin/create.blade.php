@extends('layoutmodule::admin.main')

@section('title')
    Add New Blog
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>Add New Blog</h4>
    </div>

    <form class="" method="POST" action='{{ route('admin.blogs.store') }}' enctype="multipart/form-data">
        @csrf
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="name_ar">Blog Title (AR) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                        value="{{ old('name_ar') }}" placeholder="Blog Title (AR)">
                    @error('name_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="name_en">Blog Title (EN) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name_en" name="name_en"
                        value="{{ old('name_en') }}" placeholder="Blog Title (EN)">
                    @error('name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="description_ar">Blog Content (AR) <span class="text-danger">*</span></label>
                    <textarea class="form-control tinymce" id="description_ar" name="description_ar" rows="5">{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="description_en">Blog Content (EN) <span class="text-danger">*</span></label>
                    <textarea class="form-control tinymce" id="description_en" name="description_en" rows="5">{{ old('description_en') }}</textarea>
                    @error('description_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-3">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <label class="form-label" for="img_alt">Image Alt</label>
                    <input type="text" class="form-control" id="img_alt" name="img_alt"
                        value="{{ old('img_alt') }}" placeholder="Image Alt">
                    @error('img_alt')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ old('meta_title') }}" placeholder="Meta Title">
                    @error('meta_title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_description">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_tag">Meta Tags</label>
                    <textarea class="form-control" id="meta_tag" name="meta_tag" rows="3">{{ old('meta_tag') }}</textarea>
                    @error('meta_tag')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="header_script">Header Script</label>
                    <textarea class="form-control" id="header_script" name="header_script" rows="3">{{ old('header_script') }}</textarea>
                    @error('header_script')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="footer_script">Footer Script</label>
                    <textarea class="form-control" id="footer_script" name="footer_script" rows="3">{{ old('footer_script') }}</textarea>
                    @error('footer_script')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary me-2">{{ __('messages.save') }}</button>
        </div>
    </form>
    @push('scripts')
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tinymce/plugin/tinymce/init-tinymce.js') }}"></script>
    @endpush
@endsection
