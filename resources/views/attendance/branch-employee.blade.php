<!DOCTYPE html>
<!--
Template Name: NobleUI - Laravel Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Contact: nobleui123@gmail.com
License: You must have a valid license purchased only from https://themeforest.net/user/nobleui/portfolio/ in order to legally use the theme for your project.
-->
<html>

{{-- head --}}

<head>
    <title>NobleUI Laravel Admin Dashboard Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- datatable plugin -->


    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <!-- end common css -->

    @stack('style')

    <!-- script untuk menampilkan jam secara realtime -->
    <script src="{{ asset('Js/clock.js') }}"></script>

    <!-- webcam -->
    <!-- <script type="text/javascript" src="https://unpkg.com/webcam-easy@1.0.5/dist/webcam-easy.min.js"></script> -->
    <script src="{{ asset('assets/js/webcam.min.js') }}"></script>
    <script src="{{ asset('assets/js/webcam-easy.min.js') }}"></script>


    <style>
        #webcam {
            width: 360px;
            height: 240px;
            /* border: 1px solid #03a9f3; */
            margin: auto;
        }

        /* #results {
            border: 1px solid #03a9f3;
            min-height: 240px;
            max-width: 360px;
        }

        #results img {
            max-width: 360px;
            min-height: 240px;
            margin: 5px;
        } */

    </style>

</head>

{{-- body --}}

<body data-base-url="{{ url('/') }}" onload="realtimeClock()">
    <script src="{{ asset('assets/js/spinner.js') }}"></script>
    <div class="main-wrapper" id="app">
        @include('layout.sidebar')
        <div class="page-wrapper">
            @include('layout.header')
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            {{-- start work session --}}
                            @if (session('start'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('start') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- finish work session --}}
                            @if (session('finish'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('finish') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- already have a session --}}
                            @if (session('already'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('already') }}
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-label="Close">
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

                                            <h6 class="card-subtitle mb-2 text-muted" id="clock" for="clock"
                                                style="font-size: 40px">
                                            </h6>
                                            <p class="card-text mb-3">Take today's absence by pressing the Absent
                                                Button, and take a
                                                home
                                                absence by pressing the Leave Button</p>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#AddAbsen">
                                                MARK ABSENCE
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#FinishWork">
                                                LEAVE
                                            </button>
                                        </div>
                                    </div>
                                </center>

                                {{-- tabel absen --}}
                                <div class="table-responsive" onload="realtimeClock">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Branch</th>
                                                <th>Start</th>
                                                <th>Finish</th>
                                                <th>Working Hours</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendance as $attend)
                                                <tr>
                                                    <td>{{ $attend->date }}</td>
                                                    <td>{{ $attend->branch->branch_name }}</td>
                                                    <td>{{ $attend->start }}</td>
                                                    <td>{{ $attend->finish }}</td>
                                                    <td>{{ $attend->working_hours }}</td>
                                                    <td>{{ $attend->attendance_info->desc }}</td>
                                                    <td>
                                                        @if ($attend->images != null)
                                                            <a href="/storage/branch/{{ $attend->images }}"
                                                                target="_blank">Lihat</a>
                                                        @else
                                                            no photo
                                                        @endif
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

                <!-- Modal Add new absence-->
                <div class="modal fade " id="AddAbsen" tabindex="-1" role="dialog" aria-labelledby="AddAbsenLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahAbsenLabel">Attendance Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <!-- form start to work -->
                            <form action="{{ route('start-work') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        {{-- webcam --}}
                                        <div class="row justify-content-md-center">
                                            <div class="form-grup">
                                                <video id="webcam" autoplay playsinline width="480"
                                                    height="240"></video>
                                                <div class="col text-center">
                                                    <button type="button" class="btn btn-primary" id="snap" download
                                                        onclick="takeAPicture()">snap</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        {{-- webcam result --}}
                                        <div class="row justify-content-md-center">
                                            <div class="form-grup">
                                                <div class="col md-auto form-group form-capture">
                                                    <div id="results"></div>
                                                    <p class="text-center">Your captured image will
                                                        appear
                                                        below...</p>
                                                    <canvas
                                                        style="border: 1px solid #03a9f3; height: 240px; width: 360px;"
                                                        class="mt-3 align-middle" id="canvas" value="">
                                                    </canvas>
                                                </div>
                                            </div>
                                            <div class="col md-auto">
                                                <div class="mt-3">
                                                    <span>Choose your work location</span>
                                                </div>
                                                <div class="form-group">
                                                    @foreach ($branch as $branch)
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="branch_id" id="branch_id"
                                                                    value="{{ $branch->id }}">
                                                                {{ $branch->branch_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    </div>

    {{-- Modal Finish work --}}
    <div class="modal fade" id="FinishWork" tabindex="-1" role="dialog" aria-labelledby="FinishWorkLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('finish-work') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="FinishWorkLabel">End Work</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        is your work done and you want to go home now?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
                        <button type="submit" class="btn btn-danger">Go Home NOW</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    @include('layout.footer')
    </div>
    </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    {{-- masih dicoba --}}
    <script>
        // preload shutter audio clip
        let shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = '/audio/sound.mp3';

        const inputPhoto = document.getElementById("photoURI");

        const webcamElement = document.getElementById("webcam");
        const canvasElement = document.getElementById("canvas");
        const webcam = new Webcam(webcamElement, "user", canvasElement);
        webcam.start();


        function takeAPicture() {
            // play sound effect
            shutter.play();
            // get base64 of the image from webcam
            var base64image = webcam.snap();
            document.getElementById('results').innerHTML = '<img id="imageprev" style="display: none;" src="' +
                base64image + '"/>';

            document.getElementById('canvas').innerHTML = '<input type="hidden" name="photoURI" id="photoURI" value="' +
                base64image + '"/>';

            var input = document.getElementById("photoURI").value;
            console.log(input);
        }
    </script>


    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')
</body>

</html>
