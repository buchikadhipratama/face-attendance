@extends('layout.master')

@push('plugin-styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" rel="stylesheet">
    <script crossorigin="anonymous" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f"
        src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" type="text/css" media="all" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/demo.js') }}"></script>
@endpush

@section('content')



    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                {{-- update session --}}
                @if (session('update'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('update') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- delete session --}}
                @if (session('delete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('delete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    <h6 class="card-title">Bordered table</h6>
                    <p class="card-description">Add class <code>.table-bordered</code></p>
                    <div class="table-responsive pt-3">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">shift</th>
                                    <th class="text-center">time</th>
                                    <th class="text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hours as $hour)
                                    <tr>
                                        <td class="text-center">{{ $hour->id }}</td>
                                        <td class="text-center">{{ $hour->shift }}</td>
                                        <td class="text-center">{{ date('H:i:s', strtotime($hour->time)) }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary edit">
                                                edit
                                            </button>
                                            <button type="button" class="btn btn-danger delete" data-toggle="modal"
                                                data-target="#delete">Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="updateForm" action="/datamaster/working-hour/update" method="POST" id="formEdit">
                    @csrf
                    <input type="hidden" name="id" id="idHour">
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="shift">Shift</label>
                                <input type="text" class="form-control" autocomplete="off" id="shift" name="shift"
                                    placeholder="Shift">
                            </div>

                            <div class="form-group">
                                <label for="hour">Jam kerja shift</label>
                                <div class="input-group date" id="id_3">
                                    <input type="text" name="hour" class="form-control" placeholder="Jam kerja shift"
                                        title="" required id="hour" />
                                    <div class="input-group-addon input-group-append">
                                        <div class="input-group-text">
                                            <i class="glyphicon glyphicon-time fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input id="btnUpdate" type="submit" class="btn btn-primary " value="Update Data">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin untuk menghapus data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="deleteForm" action="/datamaster/working-hour/delete" method="POST" id="deleteForm">
                        @csrf
                        <input type="hidden" name="id" id="IdDel">
                        <fieldset disabled>
                            <div class="mb-3">
                                <label for="Dshift">Shift</label>
                                <input type="text" class="form-control" id="Dshift" name="Dshift">
                            </div>
                            <div class="mb-3">
                                <label for="Dhour" class="form-label">Waktu Shift</label>
                                <input type="Text" id="Dhour" class="form-control" placeholder="Disabled input">
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <input id="btnDelete" type="submit" class="btn btn-danger" value="Hapus">
                </div>
            </div>
        </div>
    </div>



    {{-- choosing time --}}
    {{-- <div class="container">
        <h2 class="pb-2 mt-4 mb-2 border-bottom">bootstrap-datetimepicker with Bootstrap 4</h2>
        <div class="row">
            <div class='col-sm-6'>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="id_start_datetime">12hr Date-Time:</label>
                        <div class="input-group date" id="id_0">
                            <input type="text" value="05/16/2018 12:31:00 AM" class="form-control" required />
                            <div class="input-group-addon input-group-append">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_start_datetime">24hr Date-Time:</label>
                        <div class="input-group date" id="id_1">
                            <input type="text" value="05/16/2018 11:31:00" class="form-control" required />
                            <div class="input-group-addon input-group-append">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_end_time">12hr Time:</label>
                        <div class="input-group date" id="id_2">
                            <input type="text" name="end_time" value="12:31:00 AM" class="form-control"
                                placeholder="End time" title="" required id="id_end_time" />
                            <div class="input-group-addon input-group-append">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-time fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_end_time">24hr Time:</label>
                        <div class="input-group date" id="id_3">
                            <input type="text" name="end_time" value="11:31:00" class="form-control"
                                placeholder="End time" title="" required id="id_end_time" />
                            <div class="input-group-addon input-group-append">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-time fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_end_time">Date only:</label>
                        <div class="input-group date" id="id_4">
                            <input type="text" value="05/16/2018" class="form-control" required />
                            <div class="input-group-addon input-group-append">
                                <div class="input-group-text">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable').DataTable();
        // editing data
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            if ($(this).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#shift').val(data[1]);
            $('#hour').val(data[2]);
            $('#idHour').val(data[0]);

            $('#editModal').modal('show');
        });
        $('#btnUpdate').click(function() {
            $('#formEdit').submit();
        });

        // deleting data
        table.on('click', '.delete', function() {
            $tr = $(this).closest('tr');
            if ($(this).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();

            $('#Dshift').val(data[1]);
            $('#Dhour').val(data[2]);
            $('#idDel').val(data[0]);

            $('#deleteModal').modal('show');
        });
        $('#btnDelete').click(function() {
            $('#deleteForm').submit();
        });


    });
</script>



@push('plugin-scripts')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
