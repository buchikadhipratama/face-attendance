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
                    <form action="{{ route('filterList') }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row justify-content-md-center align-items-end">
                                <div class="col col-sm-2">
                                </div>
                                <div class="col-md-5">
                                    <p for="inputState" class="text-center">Time Period</p>
                                    <div class="input-group date datepicker">
                                        <input type="date" class="form-control" id="min" name="from"
                                            value="{{ date('Y-m-d') }}" />&nbsp
                                        <span class="input-group-addon">
                                            to
                                        </span>
                                        <span class="input-group-addon"></span>
                                        <input type="date" class="form-control" id="max" name="to"
                                            value="{{ date('Y-m-d') }}" />&nbsp
                                    </div>
                                </div>
                                <div class="col col-sm-2">
                                    <button type="submit" class="btn btn-outline-primary">
                                        filter
                                        {{-- <img src="asset/images/filter.jpeg" class="css-class" alt="alt text"> --}}
                                    </button>
                                </div>
                            </div>
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


<script>
    // var $  = require( 'jquery' );
    // var dt = require( 'datatables.net' )();

    // date picker
    var minDate, maxDate;
    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[4]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    // $(document).ready(function() {
    //     $('#dataTableExample').DataTable({
    //         dom: 'Bfrtip',
    //         buttons: [
    //             'copy', 'csv', 'excel', 'pdf', 'print'
    //         ]
    //     });
    // });

    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        });

        // DataTables initialisation
        var table = $('dataTableExample').DataTable();

        // Refilter the table
        $('#min, #max').on('change', function() {
            table.draw();
        });
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



{{-- orak orek --}}
