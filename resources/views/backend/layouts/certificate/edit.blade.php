@extends('backend.app')
@section('title', 'Edit history')
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

                    <li class="breadcrumb-item text-muted"> Edit history </li>

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
                        <h1 class="mb-4">Edit history</h1>
                        <form action="{{ route('admin.certificates.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                 <div class="col-lg-4 mt-4">
                                    <label for="title" class="form-label">Title</label>
                                    <input name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title',$data->title) }}" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="issued_by" class="form-label">Issued By</label>
                                    <input name="issued_by" id="issued_by" class="form-control @error('issued_by') is-invalid @enderror"
                                        placeholder="Enter issued by" value="{{ old('issued_by',$data->issued_by) }}">
                                    @error('issued_by')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4 float-right">
                                    <div class="form-check ms-auto" style="margin-top: 35px;">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_verified" id="flexCheckDefault" {{ old('is_verified',$data->is_verified) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Is verified
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="input-style-1">
                                        <label for="image">Image:</label>
                                        <input type="file" class="dropify @error('image') is-invalid @enderror"
                                            name="image" id="image"
                                            data-default-file="@isset($data){{ asset($data->image) }}@endisset" />
                                    </div>
                                    @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                        </div>



                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.certificates.index') }}" class="btn btn-danger btn-lg">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
