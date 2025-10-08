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

                        <h1 class="mb-4">Message Details</h1>
                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <label for="title" class="form-label">Name</label>
                                    <input name="title" readonly id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title',$data->name) }}" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <label for="author" class="form-label">Email</label>
                                    <input name="author" readonly id="author" class="form-control @error('author') is-invalid @enderror"
                                        placeholder="Enter author" value="{{ old('author',$data->email) }}">
                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mt-4">
                                    <label for="long_description" class="form-label">Description</label>
                                    <textarea readonly name="long_description" id="" class="form-control @error('long_description') is-invalid @enderror"
                                        placeholder="Enter Short Description" rows="7">{{ old('long_description',$data->message) }}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                              <div class="d-flex justify-content-start mt-5">
                                <a href="{{ route('admin.contact.index') }}" class="btn btn-primary">Back</a>
                            </div>

                            </div>
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
