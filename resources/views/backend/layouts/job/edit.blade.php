@extends('backend.app')
@section('title', 'Edit job')
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

                    <li class="breadcrumb-item text-muted"> Edit job </li>

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
                        <h1 class="mb-4">Edit job</h1>
                        <form action="{{ route('admin.job.update',$data->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="department" class="form-label">Department</label>
                                    <input name="department" id="department" class="form-control @error('department') is-invalid @enderror"
                                        placeholder="Enter job department" value="{{ old('department',$data->department) }}" >
                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="location" class="form-label">Location</label>
                                    <input name="location" id="location" class="form-control @error('location') is-invalid @enderror"
                                        placeholder="Enter location" value="{{ old('location',$data->location) }}">
                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="deadline" class="form-label">Deadline</label>
                                    <input name="deadline" id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror"
                                        placeholder="Enter deadline" value="{{ old('deadline',$data->deadline) }}">
                                    @error('deadline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="">Career level</label>
                                    <select name="career_level" id="career_level" class="form-control @error('career_level') is-invalid @enderror">
                                        <option value="">Select Career Level</option>
                                        <option value="Graduate" {{ $data->career_level == 'Graduate' ? 'selected' : '' }}>Graduate</option>
                                        <option value="Professional" {{ $data->career_level == 'Professional' ? 'selected' : '' }}>Professional</option>
                                        <option value="Academic" {{ $data->career_level == 'Academic' ? 'selected' : '' }}>Academic</option>
                                    </select>
                                    @error('career_level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="">Employment Status</label>
                                    <select name="employment_status" id="employment_status" class="form-control @error('employment_status') is-invalid @enderror">
                                        <option value="">Select Career Level</option>
                                        <option value="Part Time" {{ $data->employment_status == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                        <option value="Full Time" {{ $data->employment_status == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                    </select>
                                    @error('employment_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 mt-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter Job Description" rows="7">{{ old('description',$data->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.job.index') }}" class="btn btn-danger btn-lg">Back</a>
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
            .create(document.querySelector('#short_description'))
            .catch(error => {
                console.error(error);
            });

    </script>
@endpush
