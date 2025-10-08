@extends('backend.app')
@section('title', 'Edit Member')
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

                    <li class="breadcrumb-item text-muted"> Edit Member </li>

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
                        <h1 class="mb-4">Edit Member</h1>
                        <form action="{{ route('admin.teams.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Enter name" value="{{ old('name',$data->name) }}" >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <label for="position" class="form-label">Position</label>
                                    <input name="position" id="position" class="form-control @error('position') is-invalid @enderror"
                                        placeholder="Enter position" value="{{ old('position',$data->position) }}">
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror"
                                        placeholder="Enter twitter link" value="{{ old('twitter',$data->twitter) }}">
                                    @error('twitter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="linkedin" class="form-label">Linkedin</label>
                                    <input name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror"
                                        placeholder="Enter linkedin link" value="{{ old('linkedin',$data->linkedin) }}">
                                    @error('linkedin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input name="instagram" id="instagram" class="form-control @error('instagram',$data->instagram) is-invalid @enderror"
                                        placeholder="Enter instagram link" value="{{ old('instagram',$data->instagram) }}">
                                    @error('instagram')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 mt-4">
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

                            <div class="col-lg-6 mt-4">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror"
                                    placeholder="Enter bio"  rows="8">{{ old('bio',$data->bio) }}</textarea>
                                @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.teams.index') }}" class="btn btn-danger btn-lg">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
