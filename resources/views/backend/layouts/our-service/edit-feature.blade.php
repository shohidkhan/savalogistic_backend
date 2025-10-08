@extends('backend.app')
@section('title', 'Edit Service Feature')
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

                    <li class="breadcrumb-item text-muted">Edit Service Feature </li>

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->

    <section>
        <div class="container-fluid">
            <form action="{{ route('admin.services-feature.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <h1 class="mb-4">Edit Service Feature
                            </h1>
                            <div class="card" id="appendServiceFeature">
                                <div class="card-body border singel-service-feature">
                                    <div class="mt-4">
                                        <label for="feature_title" class="form-label">Feature Title</label>
                                        <input type="text" name="feature_title" id="feature_title"
                                            class="form-control @error('feature_title') is-invalid @enderror"
                                            placeholder="Enter Feature Title" value="{{ old('feature_title') ?? $data->feature_title }}">
                                        @error('feature_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <label for="feature_description" class="form-label">Feature Description</label>
                                        <textarea name="feature_description" id="feature_description"
                                            class="form-control @error('feature_description') is-invalid @enderror" placeholder="Enter Feature Description"
                                            value="{{ old('feature_description') }}" rows="3">{{ old('feature_description') ?? $data->feature_description }}</textarea>
                                        @error('feature_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <label for="feature_image" class="form-label">Icon</label>
                                        <input type="file" name="feature_image" id="feature_image"
                                            class="form-control @error('feature_image') is-invalid @enderror">
                                            <img src="{{ asset($data->feature_image) }}" class="img-fluid mt-4" alt="" width="100" style="border-radius: 20%; background-color: #000000;">
                                        @error('feature_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                        <a href="{{ route('admin.services.edit', $data->id) }}" class="btn btn-danger btn-lg">Back</a>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('script')
   
@endpush
