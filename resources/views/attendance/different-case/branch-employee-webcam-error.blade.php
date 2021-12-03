@extends('layout.master')

@section('content')

    <style>
        #video_webcam {
            width: 350px;
            height: 350px;
            border: 1px solid black;
        }

    </style>

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
                                    absence by pressing the Leave Button</p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddAbsen">
                                    MARK ABSENCE
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#FinishWork">
                                    LEAVE
                                </button>
                            </div>
                        </div>
                    </center>


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
                                    {{-- @php
                                        $info = json_decode($attend);
                                    @endphp --}}
                                    <tr>
                                        <td>{{ $attend->date }}</td>
                                        <td>{{ $attend->branch->branch_name }}</td>
                                        <td>{{ $attend->start }}</td>
                                        <td>{{ $attend->finish }}</td>
                                        <td>{{ $attend->working_hours }}</td>
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

    <!-- Modal Add new absence-->
    <div class="modal fade" id="AddAbsen" tabindex="-1" role="dialog" aria-labelledby="AddAbsenLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAbsenLabel">Attendance Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <video id="webCam" autoplay playsinlne width="800" height="600"></video>
                    <canvas id="canvas"></canvas>
                    <a style="padding: 10 px; background-color: orange; color: white; text-decoration: none;" id="snap"
                        download onclick="takeAPicture()">snap</a>
                </div>

                <form action="{{ route('start-work') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="mt-3">
                                <style>
                                    #selfie {
                                        padding: 10 px;
                                        background-color: orange;
                                        color: white;
                                        text-decoration: none;
                                    }

                                </style>
                                <span>Take a Selfie</span>
                                <video id="webCam" autoplay playsinlne width="800" height="600"></video>
                                <canvas id="canvas"></canvas>
                                <a style="padding: 10 px; background-color: orange; color: white; text-decoration: none;"
                                    id="snap" download onclick="takeAPicture()">snap</a>
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
    </div>

    {{-- Modal Finish work --}}
    <div class="modal fade" id="FinishWork" tabindex="-1" role="dialog" aria-labelledby="FinishWorkLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('finish-work') }}" method="POST">
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
@endsection



<script>
    const webCamElement = document.getElementById("webCam");
    const canvasElement = document.getElementById("canvas");
    const webcam = new Webcam(webCamElement, "user", canvasElement);
    webcam.start();

    function takeAPicture() {
        let picture = webcam.snap();
        document.querySelector("a").href = picture;
    }
</script>






{{-- <script>
    var video = document.querySelector("#video-webcam");

    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia ||
        navigator.msGetUserMedia || navigator.oGetUserMedia;

    if (navigator.getUserMedia) {
        navigator.getUserMedia({
            video: true
        }, handleVideo, videoError);
    }

    function handleVideo(stream) {
        video.src = window.URL.createObjectURL(stream);
        console.log(stream);
    }

    function videoError(e) {
        // do something
        alert("Izinkan menggunakan webcam untuk demo!")
    }

    function takeSnapshot() {
        var img = document.createElement('img');
        var context;
        var width = video.offsetWidth,
            height = video.offsetHeight;

        canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;

        context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, width, height);

        img.src = canvas.toDataURL('image/png');
        document.body.appendChild(img);
    }
</script> --}}

{{-- <script>
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
    Webcam.attach("#my_camera");

    function take_picture() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);

            document.getElementById('results').innerHTML = '<img src"' + data_uri + '"/>';

        });
    }
</script> --}}

{{-- <script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        });
    }
</script> --}}

{{-- <script>
    // load webcam
    Webcam.set({
        width: 350,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    })
    Webcam.attach("#camera");
</script> --}}

{{-- <script>
    var video = document.querySelector("#video-webcam");

    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    if( navigator.getUserMedia ){
        navigator.getUserMedia({video: true}, handleVideo, videoError);
    }

    function handleVideo(stream) {
        video.scrObject = stream;
    }

    function videoError (e) {
        alert("izinkan menggunakan Webcam untuk melakukan absensi")
    }

    function takeSnapshot() {
        var img = document.createElement('img');
        var context;

        var width = video.offsetWidth
        var height = video.offsetHeight;

        canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;

        context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, width, height);

        img.src = canvas.toDataURL('image/png');
        document.body.appendChild(img);
    }
</script> --}}

{{-- function timestamp() {
        $.ajax({
        url: 'http://localhost/timestamp.php',
        success: function(data) {
        $('#timestamp').html(data);
        },
        });
        } --}}

{{-- take a picture - trial --}}
{{-- versi pertama --}}
{{-- <label>File upload</label> --}}
{{-- <input type="file" name="img[]" class="file-upload-default"> --}}
{{-- <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Image">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                    </div> --}}

{{-- tutorial bahasa indonesia --}}
{{-- <video autoplay="true" id="video-webcam" src="">
                                take a picture
                                </video>
                                <div>
                                <button onclick="takeSnapshot()">take a picture</button>
                                </div> --}}

{{-- orang india --}}
{{-- <div id="camera"></div>
                                <button onclick="take_snapshot()">Take Snapshot</button> --}}

{{-- webplatform --}}
{{-- <div class="col-md-6">
                                <div id="my_camera"></div>
                                <br />
                                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" name="image" class="image-tag">
                                </div>
                                <div class="col-md-6">
                                <div id="results">Your captured image will appear here...</div>
                                </div> --}}


{{-- petani kode --}}
{{-- <div>
                                <video autoplay="true" id="video-webcam">
                                    Izinkan untuk Mengakses Webcam untuk Demo
                                </video>
                                <button onclick="takeSnapshot()">Ambil Gambar</button>
                                </div> --}}

{{-- novinaldi --}}
{{-- <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Ambil Gambar (webcam)</label>
                                <div class="col-sm-6">
                                    <div id="my_camera">

                                    </div>
                                    <p>
                                        <button type="button" class="btn btn-sm btn-info" onclick="take_picture()">Ambil
                                            Gambar</button>
                                    </p>
                                </div>
                                </div> --}}
