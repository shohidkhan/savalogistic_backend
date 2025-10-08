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
                        <form action="{{ route('admin.our_history.update',$data->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="type" class="form-label">Type</label>

                                    <select name="type" id="type" class="form-control @error('date') is-invalid @enderror">
                                        <option value="Beginning" {{ $data->type == 'Beginning' ? 'selected' :'' }}>Beginning</option>
                                        <option value="Expansion" {{ $data->type == 'Expansion' ? 'selected' :'' }}>Expansion</option>
                                        <option value="Crossing borders" {{ $data->type == 'Crossing borders' ? 'selected' :'' }}>Crossing borders</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="date" class="form-label">History Date</label>
                                    <input name="date" id="date" type="date" class="form-control @error('date') is-invalid @enderror"
                                        placeholder="Enter date" value="{{ old('date',$data->date) }}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter description" rows="5">{{ old('description',$data->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
