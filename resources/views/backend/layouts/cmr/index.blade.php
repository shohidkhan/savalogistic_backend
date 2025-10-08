@extends('backend.app')
@section('title', 'CMR Convention')
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

                    <li class="breadcrumb-item text-muted"> CMR Convention</li>

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
                        <h1 class="mb-4">Add CMR Convention</h1>
                        <form action="{{ route('admin.cmr.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mt-4 col-lg-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter Compliance title" value="{{ old('title',$data->title ?? '') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-4 col-lg-6">
                                    <label for="sub_title" class="form-label">Sub Title</label>
                                    <input name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror"
                                        placeholder="Enter Compliance titsub_lsub_e" value="{{ old('sub_title',$data->sub_title ?? '') }}">
                                    @error('sub_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mt-4 col-lg-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter Regulation" rows="10">{{ old('description',$data->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-4 col-lg-6">
                                     <div class="input-style-1">
                                        <label for="icon"> Icon:</label>
                                        <input type="file" class="dropify @error('icon') is-invalid @enderror"
                                            name="icon" id="icon"
                                            @isset($data)
                                                data-default-file="{{ asset($data->icon) }}"
                                            @endisset />
                                    </div>
                                    @error('icon')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-4 col-lg-12">
                                    <label for="overview" class="form-label">Overview</label>
                                    <textarea name="overview" id="overview" class="form-control @error('overview') is-invalid @enderror"
                                        placeholder="Enter Regulation" rows="10">{{ old('overview',$data->overview ?? '') }}</textarea>
                                    @error('overview')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-4 col-lg-12">
                                    <label for="sender_responsibilities" class="form-label">Sender Responsibilities</label>
                                    <textarea name="sender_responsibilities" id="sender_responsibilities" class="form-control @error('sender_responsibilities') is-invalid @enderror"
                                        placeholder="Enter Regulation" rows="10">{{ old('sender_responsibilities',$data->sender_responsibilities ?? '') }}</textarea>
                                    @error('sender_responsibilities')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-4 col-lg-12">
                                    <label for="carrier_responsibilities" class="form-label">Carrier Responsibilities</label>
                                    <textarea name="carrier_responsibilities" id="carrier_responsibilities" class="form-control @error('carrier_responsibilities') is-invalid @enderror"
                                        placeholder="Enter Regulation" rows="10">{{ old('carrier_responsibilities',$data->carrier_responsibilities ?? '') }}</textarea>
                                    @error('carrier_responsibilities')
                                        <span class="invalid-feedback" role="alert">
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


    @push('script')
        <script type="text/javascript">

            ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#overview'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#sender_responsibilities'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#carrier_responsibilities'))
            .catch(error => {
                console.error(error);
            });

            $(function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    }
                });

                if (!$.fn.DataTable.isDataTable('#data-table')) {
                    let dTable = $('#data-table').DataTable({
                        order: [],
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        processing: true,
                        responsive: true,
                        serverSide: true,

                        language: {
                            processing: `<div class="text-center">
                                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                                </div>`
                        },

                        scroller: {
                            loadingIndicator: false
                        },
                        pagingType: "full_numbers",
                        dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                        ajax: {
                            url: "{{ route('admin.cmr.index') }}",
                            type: "get",
                        },

                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'title',
                                name: 'title',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'sub_title',
                                name: 'sub_title',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'icon',
                                name: 'icon',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'description',
                                name: 'description',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'overview',
                                name: 'overview',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'sender_responsibilities',
                                name: 'sender_responsibilities',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'carrier_responsibilities',
                                name: 'carrier_responsibilities',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'status',
                                name: 'status',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                    });

                    // dTable.buttons().container().appendTo('#file_exports');
                    // new DataTable('#example', {
                    //     responsive: true
                    // });
                }
            });

            // Status Change Confirm Alert
            function showStatusChangeAlert(id) {
                event.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to update the status?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        statusChange(id);
                    }
                });
            }

            // Status Change
            function statusChange(id) {
                let url = '{{ route('admin.cmr.status', ':id') }}';
                $.ajax({
                    type: "POST",
                    url: url.replace(':id', id),
                    success: function(resp) {
                        console.log(resp);
                        // Reloade DataTable
                        $('#data-table').DataTable().ajax.reload();
                        if (resp.success === true) {
                            // show toast message
                            toastr.success(resp.message);
                        } else if (resp.errors) {
                            toastr.error(resp.errors[0]);
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: function(error) {
                        // location.reload();
                    }
                });
            }

            // delete Confirm
            function showDeleteConfirm(id) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure you want to delete this record?',
                    text: 'If you delete this, it will be gone forever.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id);
                    }
                });
            }

            // Delete Button
            function deleteItem(id) {
                let url = '{{ route('admin.cmr.destroy', ':id') }}';
                let csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    type: "DELETE",
                    url: url.replace(':id', id),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(resp) {
                        console.log(resp);
                        // Reloade DataTable
                        $('#data-table').DataTable().ajax.reload();
                        if (resp.success === true) {
                            // show toast message
                            toastr.success(resp.message);

                        } else if (resp.errors) {
                            toastr.error(resp.errors[0]);
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: function(error) {
                        // location.reload();
                    }
                })
            }
        </script>
    @endpush
@endsection
