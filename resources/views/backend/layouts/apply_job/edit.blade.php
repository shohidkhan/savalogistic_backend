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

                        <h1 class="mb-4">Applicant Details</h1>
                          <form action="{{ route('admin.apply_job.update',$data->id) }}" method="POST">
                            @csrf
                              <div class="row">
                                <div class="col-lg-4 mt-4">
                                    <label for="title" class="form-label">First Name</label>
                                    <input name="title" readonly id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title',$data->first_name) }}" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <label for="title" class="form-label">Last Name</label>
                                    <input name="title" readonly id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title',$data->last_name) }}" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="title" class="form-label">Position</label>
                                    <input name="title" readonly id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title',$data->position) }}" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" readonly id="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter email" value="{{ old('email',$data->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                 <div class="col-lg-4 mt-4">
                                    <label for="title" class="form-label">job title</label>
                                    <input name="title" readonly id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title',$data->jobPlaceMent->title) }}" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                 <div class="col-lg-4 mt-4">
                                    <label for="title" class="form-label"> Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $data->status == 'pending' ?'selected':'' }}>Pending</option>
                                        <option value="shortlisted" {{ $data->status == 'shortlisted' ?'selected':'' }}>Short list</option>
                                        <option value="reject" {{ $data->status == 'reject' ?'selected':'' }}>Reject</option>
                                        <option value="confirm" {{ $data->status == 'confirm' ?'selected':'' }}>Confirm</option>
                                    </select>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mt-4">
                                    <label for="long_description" class="form-label">Description</label>
                                    <textarea readonly name="long_description" id="long_description" class="form-control @error('long_description') is-invalid @enderror"
                                        placeholder="Enter Short Description" rows="7">{{ old('long_description',$data->jobPlaceMent->description) }}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                              <div class="d-flex justify-content-start mt-5">
                                <button type="submit" class="btn btn-info me-3">Update</button>

                                <a href="{{ route('admin.contact.index') }}" class="btn btn-primary">Back</a>
                            </div>

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
