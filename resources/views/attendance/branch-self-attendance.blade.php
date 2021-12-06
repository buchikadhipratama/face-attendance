@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Employee Attendance Table</h3>
                    <hr>
                    {{-- filter --}}
                    <form class="row g-3">
                        <div class="col-md-2">
                            <p for="inputState" class="text-center">Branch Shop</p>
                            <select id="inputState" class="form-select">
                                <option selected>branch shop</option>
                                @foreach ($branches as $branch)
                                    <option>{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <p for="inputState" class="text-center">Time Period</p>
                            <div class="input-group date datepicker" id="datePickerExample">
                                <input type="text" class="form-control" name="start" />
                                <span class="input-group-addon">
                                    to
                                </span>
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="end" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p for="inputState" class="text-center">Employee Name</p>
                            <select id="inputState" class="form-select">
                                <option selected>employee name</option>
                                @foreach ($users as $user)
                                    <option>{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <p for="inputState" class="text-center">Shift</p>
                            <select id="inputState" class="form-select">
                                <option selected>shift</option>
                                @foreach ($attendances_info as $info)
                                    <option>{{ $info->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <p for="inputState" class="text-center">Status</p>
                            <select id="inputState" class="form-select">
                                <option selected>status</option>
                                @foreach ($attendances_info as $info)
                                    <option>{{ $info->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Employee Name</th>
                                    <th>Branch Shop</th>
                                    <th>Start</th>
                                    <th>Finish</th>
                                    <th>Working Hours</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attend)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attend->date }}</td>
                                        <td>{{ $attend->user->name }}</td>
                                        <td>{{ $attend->branch->branch_name }}</td>
                                        <td>{{ $attend->start }}</td>
                                        <td>{{ $attend->finish }}</td>
                                        <td>{{ $attend->working_hours }}</td>
                                        <td>{{ $attend->attendance_info->desc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- datepicker --}}
<script>
    $('#sandbox-container .input-daterange').datepicker({
        format: "dd/mm/yyyy",
        todayHighlight: true
    });
</script>


@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
