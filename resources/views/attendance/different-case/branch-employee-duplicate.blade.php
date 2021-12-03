@extends('layout.master')

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                {{-- success session --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    {{-- <h6 class="card-title">Absen Hadir</h6> --}}

                    <!-- Button trigger modal -->
                    <center>
                        <div class="card" style="width: 25rem;">
                            <div class="card-body">
                                <h2 class="card-title">Attendance Form</h2>
                                <h6 class="card-subtitle mb-2 text-muted" id="clock" for="clock" style="font-size: 40px">
                                </h6>
                                <p class="card-text mb-3">Take today's absence by pressing the Absent Button, and take a
                                    home
                                    absence by pressing the Home Button</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#tambahAbsen">
                                    ABSENCE
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tambahAbsen">
                                    PARTY
                                </button>
                            </div>
                        </div>
                    </center>


                    <div class="table-responsive" onload="realtimeClock">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Jam Hadir</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $attend)
                                    @php
                                        $newDate = date('d-m-Y', strtotime($attend->datetime));
                                        $newTime = date('H:i:s', strtotime($attend->datetime));
                                    @endphp
                                    <tr>
                                        <td>{{ $newDate }}</td>
                                        <td>{{ $attend->branch->branch_name }}</td>
                                        <td>{{ $newTime }}</td>
                                        <td>{{ $attend->attendance_info->desc }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-icon">
                                                <i data-feather="edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-icon">
                                                <i data-feather="image"></i>
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

    <!-- Modal -->
    <div class="modal fade" id="tambahAbsen" tabindex="-1" role="dialog" aria-labelledby="tambahAbsenLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAbsenLabel">Attendance Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/attendance/branch-employee/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="img[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                            <div class="mt-3">
                                <span>Choose your work location</span>
                            </div>
                            <div class="form-group">
                                @foreach ($branch as $branch)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="branch_id" id="branch_id"
                                                value="{{ $branch->id }}">
                                            {{ $branch->branch_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- function timestamp() {
        $.ajax({
        url: 'http://localhost/timestamp.php',
        success: function(data) {
        $('#timestamp').html(data);
        },
        });
        } --}}
    @endsection



    {{-- modal --}}
