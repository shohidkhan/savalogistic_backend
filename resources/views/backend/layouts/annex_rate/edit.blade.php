@extends('backend.app')
@section('title', 'Edit blog')
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

                    <li class="breadcrumb-item text-muted"> Edit blog </li>

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
                        <h1 class="mb-4">Edit blog</h1>
                        <form action="{{ route('admin.annex_rate.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                 <div class="col-lg-6 mt-4">
                                    <label for="">Country</label>
                                    <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id',$data->country_id) == $country->id ? 'selected': '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                 <div class="col-lg-6 mt-4">
                                    <label for="">Segment</label>
                                    <select name="segment" id="segment" class="form-control @error('segment') is-invalid @enderror">
                                        <option value="">Select Country</option>
                                        <option value="CH" {{ old('segment',$data->segment) == 'CH' ? 'selected' : '' }}>Switzerland</option>
                                        <option value="FR" {{ old('segment',$data->segment) == 'FR' ? 'selected' : '' }}>French</option>
                                    </select>
                                    @error('segment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="week" class="form-label">Week</label>
                                    <input name="week" id="week" class="form-control @error('week') is-invalid @enderror"
                                        placeholder="Enter week" value="{{ old('week',$data->week) }}" >
                                    @error('week')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="price_per_km" class="form-label">Price Per KM</label>
                                    <input name="price_per_km" id="price_per_km" class="form-control @error('price_per_km') is-invalid @enderror"
                                        placeholder="Enter Price Per Km" value="{{ old('price_per_km',$data->price_per_km) }}">
                                    @error('price_per_km')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="margin" class="form-label">Margin</label>
                                    <input name="margin" id="margin" class="form-control @error('margin') is-invalid @enderror"
                                        placeholder="Enter Margin" value="{{ old('margin',$data->margin) }}">
                                    @error('margin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.annex_rate.index') }}" class="btn btn-danger btn-lg">Back</a>
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
