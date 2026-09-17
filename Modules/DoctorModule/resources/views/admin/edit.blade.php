@extends('layoutmodule::admin.main')

@section('title')
    {{ __('messages.doctors') }}
@endsection

@push('styles')
@endpush

@section('content')
    <div class="card-header">
        <h4>{{ __('messages.update_doctor') }}</h4>
    </div>
    <form method="POST" action='{{ route('admin.doctors.update', $doctor->id) }}' enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $doctor->id }}">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="name">{{ __('messages.name') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $doctor->name) }}" placeholder="{{ __('messages.name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="degree_id">{{ __('messages.degree') }} <span
                            class="text-danger">*</span></label>
                    <select class="form-select" id="degree_id" name="degree_id">
                        <option value="">{{ __('messages.select_degree') }}</option>
                        @foreach ($degrees as $degree)
                            <option value="{{ $degree->id }}" @selected(old('degree_id', $doctor->degree_id) == $degree->id)>
                                {{ $degree->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('degree_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-4">
                    <label class="form-label" for="city_id">{{ __('messages.city') }} <span
                            class="text-danger">*</span></label>
                    <select class="form-select" id="city_id" name="city_id">
                        <option value="">{{ __('messages.city') }}</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @selected(old('city_id', $doctor->city_id) == $city->id)>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="zone_id">{{ __('messages.zone') }} <span
                            class="text-danger">*</span></label>
                    <select class="form-select" id="zone_id" name="zone_id">
                        <option value="">{{ __('messages.select_zone') }}</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" @selected(old('zone_id', $doctor->zone_id) == $zone->id)>
                                {{ $zone->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('zone_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="pic">{{ __('messages.pic') }}</label>
                    <input type="file" class="form-control" id="pic" name="pic" accept="image/*">
                    @if ($doctor->pic)
                        <img src="{{ asset('uploads/doctors/' . $doctor->pic) }}" alt="{{ $doctor->name }}"
                            class="img-fluid mt-2" style="max-width: 90px; max-height: 90px;">
                    @endif
                    @error('pic')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="address">{{ __('messages.address') }}</label>
                    <textarea class="form-control" id="address" name="address" rows="2">{{ old('address', $doctor->address) }}</textarea>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-4">
                    <label class="form-label" for="address_latitude">{{ __('messages.address_latitude') }}</label>
                    <input type="number" step="any" class="form-control" id="address_latitude" name="address_latitude"
                        value="{{ old('address_latitude', $doctor->address_latitude) }}">
                    @error('address_latitude')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="address_longitude">{{ __('messages.address_longitude') }}</label>
                    <input type="number" step="any" class="form-control" id="address_longitude"
                        name="address_longitude" value="{{ old('address_longitude', $doctor->address_longitude) }}">
                    @error('address_longitude')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <label class="form-label" for="address_map_zoom">{{ __('messages.address_map_zoom') }}</label>
                    <input type="number" class="form-control" id="address_map_zoom" name="address_map_zoom"
                        value="{{ old('address_map_zoom', $doctor->address_map_zoom) }}">
                    @error('address_map_zoom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-3">
                    <label class="form-label" for="phone">{{ __('messages.phone') }}</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $doctor->phone) }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <label class="form-label" for="mobile">{{ __('messages.mobile') }}</label>
                    <input type="text" class="form-control" id="mobile" name="mobile"
                        value="{{ old('mobile', $doctor->mobile) }}">
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <label class="form-label" for="email">{{ __('messages.email') }}</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $doctor->email) }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <label class="form-label" for="website">{{ __('messages.website') }}</label>
                    <input type="text" class="form-control" id="website" name="website"
                        value="{{ old('website', $doctor->website) }}">
                    @error('website')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="working_time">{{ __('messages.working_time') }}</label>
                    <input type="text" class="form-control" id="working_time" name="working_time"
                        value="{{ old('working_time', $doctor->working_time) }}">
                    @error('working_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="found_us">{{ __('messages.found_us') }}</label>
                    <input type="text" class="form-control" id="found_us" name="found_us"
                        value="{{ old('found_us', $doctor->found_us) }}">
                    @error('found_us')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="more_info">{{ __('messages.more_info') }}</label>
                    <textarea class="form-control" id="more_info" name="more_info" rows="3">{{ old('more_info', $doctor->more_info) }}</textarea>
                    @error('more_info')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">{{ __('messages.select_departments') }}</label>
                    @php
                        $selectedDepartments = collect(old('departments', $doctor->departments->pluck('id')->all()));
                    @endphp
                    <div class="border rounded p-3" style="max-height: 260px; overflow-y: auto;">
                        <div class="row">
                            @foreach ($departments as $department)
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="departments[]"
                                            id="department_{{ $department->id }}" value="{{ $department->id }}"
                                            @checked($selectedDepartments->contains($department->id))>
                                        <label class="form-check-label" for="department_{{ $department->id }}">
                                            {{ $department->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('departments')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="slug">{{ __('messages.slug') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug"
                        value="{{ old('slug', $doctor->seo?->slug) }}" placeholder="{{ __('messages.slug') }}">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_title">{{ __('messages.meta_title') }}</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $doctor->seo?->meta_title) }}" placeholder="{{ __('messages.meta_title') }}">
                    @error('meta_title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_description">{{ __('messages.meta_description') }}</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $doctor->seo?->meta_description) }}</textarea>
                    @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" for="meta_tag">{{ __('messages.meta_tag') }}</label>
                    <textarea class="form-control" id="meta_tag" name="meta_tag" rows="3">{{ old('meta_tag', $doctor->seo?->meta_tag) }}</textarea>
                    @error('meta_tag')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label" for="header_script">{{ __('messages.header_script') }}</label>
                    <textarea class="form-control" id="header_script" name="header_script" rows="3">{{ old('header_script', $doctor->seo?->header_script) }}</textarea>
                    @error('header_script')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="footer_script">{{ __('messages.footer_script') }}</label>
                    <textarea class="form-control" id="footer_script" name="footer_script" rows="3">{{ old('footer_script', $doctor->seo?->footer_script) }}</textarea>
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
        <script>
            $(document).ready(function() {
                const zonesUrlTemplate = @json(route('admin.doctors.zones-by-city', ['city' => '__CITY_ID__']));

                $('#city_id').on('change', function() {
                    const cityId = $(this).val();
                    const $zoneSelect = $('#zone_id');

                    $zoneSelect.html('<option value="">{{ __('messages.select_zone') }}</option>');

                    if (!cityId) {
                        return;
                    }

                    $.get(zonesUrlTemplate.replace('__CITY_ID__', cityId), function(zones) {
                        zones.forEach(function(zone) {
                            $zoneSelect.append(new Option(zone.name, zone.id));
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
