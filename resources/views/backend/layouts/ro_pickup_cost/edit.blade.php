@extends('backend.app')
@section('title', 'Edit a pickup cost')
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

                    <li class="breadcrumb-item text-muted"> Edit a pickup cost </li>

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
                        <h1 class="mb-4">Edit a zone area</h1>
                        <form action="{{ route('admin.ro_pickup_cost.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">


                                 <div class="col-lg-4 mt-4">
                                    <label for="">Zones</label>
                                    <select name="ldm_id"  class="form-control @error('ldm_id') is-invalid @enderror">
                                        <option value="">Select a ldm</option>
                                        @foreach ($ldms as $ldm)
                                            <option value="{{ $ldm->id }}" {{ old('ldm_id',$data->ldm_id) == $ldm->id ? 'selected': '' }}>{{ $ldm->ldm }}</option>
                                        @endforeach
                                    </select>
                                    @error('ldm_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mt-4">
                                    <label for="cost" class="form-label">Pickup cost</label>
                                    <input name="cost" id="cost" class="form-control @error('cost') is-invalid @enderror"
                                        placeholder="Enter cost" value="{{ old('cost',$data->cost) }}">
                                    @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.ro_pickup_cost.index') }}" class="btn btn-danger btn-lg">Back</a>
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
