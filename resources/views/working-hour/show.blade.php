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
                <div class="card-body">
                    <h6 class="card-title">Bordered table</h6>
                    <p class="card-description">Add class <code>.table-bordered</code></p>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
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
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $hour->shift }}</td>
                                        <td class="text-center">{{ date('H:i:s', strtotime($hour->time)) }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary editBranch">
                                                edit
                                            </button>
                                            <button type="button" class="btn btn-danger deleteBranch" data-toggle="modal"
                                                data-target="#deleteBranch">Delete
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









    <div class="container">
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
    </div>
@endsection


@push('plugin-scripts')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
