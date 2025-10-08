@extends('backend.app')
@section('title', 'Add Blog')
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

                    <li class="breadcrumb-item text-muted"> Add Blog </li>

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
                        <h1 class="mb-4">Add Blog</h1>
                        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-lg-4 mt-4">
                                    <label for="title" class="form-label">Title</label>
                                    <input name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter title" value="{{ old('title') }}" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="author" class="form-label">Author</label>
                                    <input name="author" id="author" class="form-control @error('author') is-invalid @enderror"
                                        placeholder="Enter author" value="{{ old('author') }}">
                                    @error('author')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="">Category</label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected': '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea name="short_description"  class="form-control @error('short_description') is-invalid @enderror"
                                        placeholder="Enter Short Description" rows="7">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <label for="long_description" class="form-label">Description</label>
                                    <textarea name="long_description" id="long_description" class="form-control @error('long_description') is-invalid @enderror"
                                        placeholder="Enter Short Description" rows="7">{{ old('long_description') }}</textarea>
                                    @error('long_description')
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
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-danger btn-lg">Back</a>
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
