@extends('backend.app')
@section('title', 'Add a area')
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <div class=" container-fluid  d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bold my-1 fs-2">
                    Dashboard <small class="text-muted fs-6 fw-normal ms-1"></small>
                </h1>
                <!--end::Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>

                    <li class="breadcrumb-item text-muted"> Add a area </li>

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h1 class="mb-4">Add Zone area</h1>
                        <form action="{{ route('admin.loading_area.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                 <div class="col-lg-4 mt-4">
                                    <label for="">Zones</label>
                                    <select name="loading_zone_id"  class="form-control @error('loading_zone_id') is-invalid @enderror">
                                        <option value="">Select a Zone</option>
                                        @foreach ($zones as $zone)
                                            <option value="{{ $zone->id }}" {{ old('loading_zone_id') == $zone->id ? 'selected': '' }}>{{ $zone->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('loading_zone_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <label for="area_name" class="form-label">Area name</label>
                                    <input name="area_name" id="area_name" class="form-control @error('area_name') is-invalid @enderror"
                                        placeholder="Enter name" value="{{ old('area_name') }}">
                                    @error('area_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="postal_code" class="form-label">Postal code</label>
                                    <input name="postal_code" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror"
                                        placeholder="Enter postal code" value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.loading_area.index') }}" class="btn btn-danger btn-lg">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#long_description'))
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#short_description'))
            .catch(error => {
                console.error(error);
            });

    </script>
@endpush
