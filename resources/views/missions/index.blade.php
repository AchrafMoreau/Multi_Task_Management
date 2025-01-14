@extends('layouts.master')
@section('title')
    @lang('translation.mission')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">@lang("translation.mission-list")</h4>
                </div><!-- end card header -->

                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form action="{{ url('/mission-filter') }}" method="POST" >
                        @csrf
                        @method("POST")
                        @php
                            $months = [
                                'January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'
                            ];
                        @endphp
                        <div class="row g-3">
                            <div class="col-xxl-3 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control"
                                        name="month" id="monthSelect" >
                                        <option value="all" selected>@lang('translation.month')</option>
                                        @foreach ($months as $index => $month)
                                            <option {{ ($sMonth ?? null) && $sMonth == $index + 1 ? 'selected' : "" }} value="{{ $index + 1 }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control"
                                        name="year" id="yearSelect">
                                        <option value="all" selected>@lang('translation.year')</option>
                                        @foreach(range(date('Y'), date('Y') - 9) as $year)
                                            <option {{ ($sYear ?? null) && $sYear == $year ? 'selected' : "" }} value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <button type="submit" class="btn btn-primary w-100"> <i
                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Filters
                                </button>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ url('/mission/create') }}">
                                        <button class="btn btn-primary add-btn"  id="create-btn" >
                                            <i class="ri-add-line align-bottom me-1"></i>
                                            @lang("translation.addMission")
                                        </button>
                                    </a>
                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th  data-sort="serial_number">@lang("translation.serialNumber")</th>
                                        <th  data-sort="driver">@lang("translation.driver")</th>
                                        <th  data-sort="taskType">@lang("translation.missionType")</th>
                                        <th  data-sort="agent">@lang("translation.agent")</th>
                                        <th  data-sort="start-date">@lang("translation.startDate")</th>
                                        <th  data-sort="end-date">@lang("translation.endDate")</th>
                                        <th  data-sort="action">@lang("translation.action")</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach($missions as $task)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                    value="option1">
                                            </div>
                                        </th>
                                        <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                class="fw-medium link-primary">{{ $task->id }}</a></td>
                                        <td class="serial_number">{{ $task->serial_number }}</td>
                                        <td class="driver">{{ $task->driver->name }}</td>
                                        <td class="taskType">{{ $task->type }}</td>
                                        <td class="agent">{{ $task->agent }}</td>
                                        <td class="start-date">{{ $task->start_date }}</td>
                                        <td class="end-date">{{ $task->end_date }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="download">
                                                    <a href="{{ url( '/downloadPdf'.'/'.$task->id )}}">
                                                    <button class="btn btn-sm btn-success edit-item-btn">
                                                        <i class='ri-download-fill align-middle'></i>
                                                    </button>
                                                    </a>
                                                </div>
                                                
                                                <div class="view">
                                                    <a href="{{ url( '/mission'.'/'.$task->id )}}">
                                                    <button class="btn btn-sm btn-secondary edit-item-btn">
                                                        <i class='ri-eye-fill align-middle'></i>
                                                    </button>
                                                    </a>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{ url( '/mission'.'/'.$task->id. '/edit')}}">
                                                    <button class="btn btn-sm btn-primary edit-item-btn">
                                                        <i class="ri-pencil-fill align-bottom"></i>
                                                    </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal">
                                                        <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#25a0e2,secondary:#00bd9d" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="javascript:void(0);">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->



    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off">
                    <div class="modal-body">
                        <div class="mb-3" id="modal-id" style="display: none;">
                            <label for="id-field" class="form-label">ID</label>
                            <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="customername-field" class="form-label">Customer Name</label>
                            <input type="text" id="customername-field" class="form-control" placeholder="Enter Name"
                                required />
                            <div class="invalid-feedback">Please enter a customer name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email-field" class="form-label">Email</label>
                            <input type="email" id="email-field" class="form-control" placeholder="Enter Email"
                                required />
                            <div class="invalid-feedback">Please enter an email.</div>
                        </div>

                        <div class="mb-3">
                            <label for="phone-field" class="form-label">Phone</label>
                            <input type="text" id="phone-field" class="form-control" placeholder="Enter Phone no."
                                required />
                            <div class="invalid-feedback">Please enter a phone.</div>
                        </div>

                        <div class="mb-3">
                            <label for="date-field" class="form-label">Joining Date</label>
                            <input type="text" id="date-field" class="form-control" placeholder="Select Date"
                                required />
                            <div class="invalid-feedback">Please select a date.</div>
                        </div>

                        <div>
                            <label for="status-field" class="form-label">Status</label>
                            <select class="form-control" data-trigger name="status-field" id="status-field" required>
                                <option value="">Status</option>
                                <option value="Active">Active</option>
                                <option value="Block">Block</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Add Customer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#25a0e2,secondary:#00bd9d" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>@lang("translation.are-you-sure")</h4>
                            <p class="text-muted mx-4 mb-0">@lang("translation.are-you-sure-message")</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">@lang("translation.close")</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-record">@lang("translation.yes-delete-it")</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- listjs init -->
    <script src="{{ URL::asset('build/js/pages/mission-list.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        window.translations = {
            yesDeletedIt: "{{ __('translation.yes-delete-it') }}",
        }

        refreshCallbacks();
    </script>
@endsection


