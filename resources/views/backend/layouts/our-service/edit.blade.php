@extends('backend.app')
@section('title', 'Our Service')
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

                    <li class="breadcrumb-item text-muted"> Create Our Service </li>

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->

    <section>
        <div class="container-fluid">
            <form action="{{ route('admin.services.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-body">
                            <h1 class="mb-4">Add Service</h1>

                            <div class="mt-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter title"
                                    value="{{ old('title') ?? $data->title }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Enter address" rows="3">{{ old('address') ?? $data->address }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-4">
                                        <label for="annual_meter" class="form-label">Annual Meter</label>
                                        <input type="text" name="annual_meter" id="annual_meter"
                                            class="form-control @error('annual_meter') is-invalid @enderror"
                                            placeholder="Enter Annual Meter" value="{{ old('annual_meter') ?? $data->annual_meter }}">
                                        @error('annual_meter')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-4">
                                        <label for="annual_tons" class="form-label">Annual Tons</label>
                                        <input type="text" name="annual_tons" id="annual_tons"
                                            class="form-control @error('annual_tons') is-invalid @enderror"
                                            placeholder="Enter Annual Tons" value="{{ old('annual_tons') ?? $data->annual_tons }}">
                                        @error('annual_tons')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-4">
                                        <label for="annual_shipment" class="form-label">Annual Shipment</label>
                                        <input type="text" name="annual_shipment" id="annual_shipment"
                                            class="form-control @error('annual_shipment') is-invalid @enderror"
                                            placeholder="Enter Annual Shipment" value="{{ old('annual_shipment') ?? $data->annual_shipment }}">
                                        @error('annual_shipment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-4">
                                        <label for="per_year_client" class="form-label">Per Year Client</label>
                                        <input type="text" name="per_year_client" id="per_year_client"
                                            class="form-control @error('per_year_client') is-invalid @enderror"
                                            placeholder="Enter Per Year Client" value="{{ old('per_year_client') ?? $data->per_year_client }}">
                                        @error('per_year_client')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter description" value="{{ old('description') }}" rows="7">{{ old('description') ?? $data->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="image" class="form-label">Icon</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                    <img src="{{ asset($data->image) }}" class="img-fluid mt-4" alt="" width="100">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                                <a href="{{ route('admin.faqs.index') }}" class="btn btn-danger btn-lg">Back</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-body">
                            <h1 class="mb-4">Add Service Feature
                                <button type="button" class="btn btn-primary btn-sm float-end"
                                    id="addMoreServiceFeature">Add Feature</button>
                            </h1>
                            <div class="card" id="appendServiceFeature">
                                <div class="card-body border singel-service-feature">
                                    <div class="mt-4">
                                        <label for="feature_title" class="form-label">Feature Title</label>
                                        <input type="text" name="services[0][feature_title]" id="feature_title"
                                            class="form-control @error('feature_title') is-invalid @enderror"
                                            placeholder="Enter Feature Title" value="{{ old('feature_title') }}">
                                        @error('feature_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <label for="feature_description" class="form-label">Feature Description</label>
                                        <textarea name="services[0][feature_description]" id="feature_description"
                                            class="form-control @error('feature_description') is-invalid @enderror" placeholder="Enter Feature Description"
                                            value="{{ old('feature_description') }}" rows="3"></textarea>
                                        @error('feature_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <label for="feature_image" class="form-label">Icon</label>
                                        <input type="file" name="services[0][feature_image]" id="feature_image"
                                            class="form-control @error('feature_image') is-invalid @enderror">
                                        @error('feature_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            @foreach($data->OurServiceFeatures as $serviceFeature)
                            <div class="card-body border singel-service-feature mt-3">
                                
                                <a href="{{ route('admin.our-service-feature.delete', $serviceFeature->id) }}" class="border-0 bg-transparent btn-sm float-end">
                        
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" >
                                <path d="M4 7l16 0" /> <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" /> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                </a>
                                <a href="{{ route('admin.our-service-feature.edit', $serviceFeature->id) }}" class="border-0 bg-transparent btn-sm float-end">
                                    
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2.25"
                                stroke-linecap="round" stroke-linejoin="round" >
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                                </svg>

                                
                                </a>
                                <div class="mt-4">
                                    <h2>Feature Title:</h2>
                                    <h1 for="feature_title" class="form-label">{{ $serviceFeature->feature_title }}</h1>
                                </div>

                                <div class="mt-4">
                                    <h2>Feature Description:</h2>
                                    <p>{{ $serviceFeature->feature_description }}</p>
                                </div>

                                <div class="mt-4">
                                    <h2>Icon:</h2>
                                    <img src="{{ asset($serviceFeature->feature_image) }}" alt="" width="100" style="border-radius: 20%; background-color: #000000;">
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
        $(document).ready(function() {
            let serviceFeatureNumber = 0;
            $(document).on('click', '#addMoreServiceFeature', function() {
                serviceFeatureNumber++;
                let newInputGroup = `
                <div data-id="${serviceFeatureNumber}" class="card-body border singel-service-feature mt-4">
                    <button type="button" class="border-0 bg-transparent service-feature-remove btn-sm float-end" id="removeServiceFeature">
                        
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#dc3545"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <path d="M4 7l16 0" />
                    <path d="M10 11l0 6" />
                    <path d="M14 11l0 6" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>

                    </button>
                    <div class="mt-4">
                        <label for="feature_title" class="form-label">Feature Title</label>
                        <input type="text" name="services[${serviceFeatureNumber}][feature_title]" id="feature_title"
                            class="form-control @error('feature_title') is-invalid @enderror"
                            placeholder="Enter Feature Title" value="{{ old('feature_title') }}">
                        @error('feature_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="feature_description" class="form-label">Feature Description</label>
                        <textarea name="services[${serviceFeatureNumber}][feature_description]" id="feature_description"
                            class="form-control @error('feature_description') is-invalid @enderror" placeholder="Enter Feature Description"
                            value="{{ old('feature_description') }}" rows="3"></textarea>
                        @error('feature_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="feature_image" class="form-label">Icon</label>
                        <input type="file" name="services[${serviceFeatureNumber}][feature_image]" id="feature_image"
                            class="form-control @error('feature_image') is-invalid @enderror">
                        @error('feature_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                `;
                $('#appendServiceFeature').append(newInputGroup);
            });
             $(document).on('click','.service-feature-remove',function (){
                $(this).parent().remove();
            })
        });
    </script>
@endpush
