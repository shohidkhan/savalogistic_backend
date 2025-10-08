@extends('backend.app')

@section('title', 'Sava Operations')

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
                    <li class="breadcrumb-item text-muted">
                        CMS
                    </li>

                    <li class="breadcrumb-item text-muted"> Sava Operations </li>

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
                        <h1 class="mb-4">About us content</h1>
                        <form action="{{ route('admin.cms.sava.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" mt-4">
                                    <label for="offices" class="form-label">Offices</label>
                                    <input name="offices" id="offices" class="form-control @error('offices') is-invalid @enderror"
                                        placeholder="Enter offices" value="{{ old('offices',$data->offices ?? "") }}">
                                    @error('offices')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class=" mt-4">
                                    <label for="countries" class="form-label">Countries</label>
                                    <input name="countries" id="countries" class="form-control @error('countries') is-invalid @enderror"
                                        placeholder="Enter countries" value="{{ old('countries',$data->countries ?? "") }}">
                                    @error('offices')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class=" mt-4">
                                    <label for="employees" class="form-label">Employees</label>
                                    <input name="employees" id="employees" class="form-control @error('employees') is-invalid @enderror"
                                        placeholder="Enter employees" value="{{ old('employees',$data->employees ?? "") }}">
                                    @error('employees')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">

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
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#title'))
            .catch(error => {
                console.error(error);
            });

    </script>
@endpush
