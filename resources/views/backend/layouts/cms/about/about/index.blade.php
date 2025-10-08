@extends('backend.app')

@section('title', 'ABout Us')

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

                    <li class="breadcrumb-item text-muted"> About </li>

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
                        <form action="{{ route('admin.cms.about.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class=" mt-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter Description" rows="7">{{ old('description',$data->description ?? "") }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="input-style-1">
                                        <label for="image_url">Image:</label>
                                        <input type="file" class="dropify @error('image_url') is-invalid @enderror"
                                            name="image_url" id="image_url	"
                                            data-default-file="@isset($data){{ asset($data->image_url) }}@endisset" />
                                    </div>
                                    @error('image_url')
                                        <span class="text-danger" role="alert">
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
