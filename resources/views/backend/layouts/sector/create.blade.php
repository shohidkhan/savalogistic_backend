@extends('backend.app')
@section('title', 'Our sector')
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

                    <li class="breadcrumb-item text-muted"> Create  sector </li>

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->

    <section>
        <div class="container-fluid">
            <form action="{{ route('admin.sector.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-body">
                            <h1 class="mb-4">Add sector</h1>

                            <div class="mt-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter title"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="sub_title" class="form-label">Sub Title</label>
                                <input type="text" name="sub_title" id="sub_title"
                                    class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter sub title"
                                    value="{{ old('sub_title') }}">
                                @error('sub_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                          <div class=" mt-4">
                                    <div class="input-style-1">
                                        <label for="icon">Image:</label>
                                        <input type="file" class="dropify @error('icon') is-invalid @enderror"
                                            name="icon" id="icon"
                                            data-default-file="@isset($data){{ asset($data->icon) }}@endisset" />
                                    </div>
                                    @error('icon')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.faqs.index') }}" class="btn btn-danger btn-lg">Back</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-body">
                            <h1 class="mb-4">Add Sector Company
                                <button type="button" class="btn btn-primary btn-sm float-end"
                                    id="addMoresectorFeature">Add Company</button>
                            </h1>
                            <div class="card" id="appendsectorFeature">
                                <div class="card-body border singel-sector-feature">


                                    <div class="mt-4">
                                        <label for="logo" class="form-label">Company Logo</label>
                                        <input type="file" multiple name="logo[]" id="logo"
                                            class="form-control @error('logo') is-invalid @enderror">
                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
    <script>

    </script>
@endpush
