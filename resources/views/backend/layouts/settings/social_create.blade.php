@extends('backend.app')
@section('title', 'Add Social Media')
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

                    <li class="breadcrumb-item text-muted"> Add Social Media </li>

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
                        <h1 class="mb-4">Add  Social Media</h1>
                        <form action="{{ route('social.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <label for="social_media" class="form-label">Social Media Name</label>
                                    <input name="social_media" id="social_media" class="form-control @error('social_media') is-invalid @enderror"
                                        placeholder="Enter social media name" value="{{ old('social_media') }}" >
                                    @error('social_media')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <label for="profile_link" class="form-label">Profile Link</label>
                                    <input name="profile_link" id="profile_link" class="form-control @error('profile_link') is-invalid @enderror"
                                        placeholder="Enter profile link" value="{{ old('profile_link') }}">
                                    @error('profile_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="input-style-1">
                                        <label for="social_media_icon">Social Media Icon:</label>
                                        <input type="file" class="dropify @error('social_media_icon') is-invalid @enderror"
                                            name="social_media_icon" id="social_media_icon"
                                            data-default-file="@isset($data){{ asset($data->social_media_icon) }}@endisset" />
                                    </div>
                                    @error('social_media_icon')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('social.index') }}" class="btn btn-danger btn-lg">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
