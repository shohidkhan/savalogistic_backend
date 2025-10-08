@extends('backend.app')
@section('title', 'Our sector')
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

                    <li class="breadcrumb-item text-muted"> Edit service sector </li>

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->

    <section>
        <div class="container-fluid">
            <form action="{{ route('admin.sector.update', $serviceSector->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                   <div class="col-md-7">
                        <div class="card card-body">
                            <h1 class="mb-4">Edit service sector</h1>

                            <div class="mt-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter title"
                                    value="{{ old('title',$serviceSector->title) }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="sub_title" class="form-label">Sub Title</label>
                                <input type="text" name="sub_title" id="sub_title"
                                    class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter sub title"
                                    value="{{ old('sub_title',$serviceSector->sub_title) }}">
                                @error('sub_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                          <div class=" mt-4">
                                    <div class="input-style-1">
                                        <label for="icon">Service Icon:</label>
                                        <input type="file" class="dropify @error('icon') is-invalid @enderror"
                                            name="icon" id="icon"
                                            @isset($serviceSector)
                                                data-default-file="{{ asset($serviceSector->icon) }}"
                                            @endisset />
                                    </div>
                                    @error('icon')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.sector.index') }}" class="btn btn-danger btn-lg">Back</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-body">
                            <h1 class="mb-4">Add company
                            </h1>
                            <div class="card" id="appendsectorFeature">
                                <div class="card-body border singel-sector-feature">

                                    <div class="mt-4">
                                        <label for="logo" class="form-label">Company Logo</label>
                                        <input type="file" multiple name="logo[]" id="logo"
                                            class="form-control @error('logo') is-invalid @enderror">
                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            @foreach($serviceSector->companies as $company)
                            <div class="card-body border singel-sector-feature mt-3">

                                <a href="{{ route('admin.company.delete', $company->id) }}" class="border-0 bg-transparent btn-sm float-end">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" >
                                <path d="M4 7l16 0" /> <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" /> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                </a>
                                <a href="{{ route('admin.company.edit', $company->id) }}" class="border-0 bg-transparent btn-sm float-end">

                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" >
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                                </svg>


                                </a>


                                <div class="mt-4">
                                    <h5>Company logo:</h5>
                                    <img src="{{ asset($company->logo) }}" alt="" width="100" style="border-radius: 20%; background-color: #000000;">
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $('.dropify').dropify();
    </script>
@endpush
