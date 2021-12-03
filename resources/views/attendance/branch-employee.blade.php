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
                                            {{-- ini yang sebelumnya dipakai --}}
                                            {{-- <div class="col md-auto">
                                                <canvas style="border: 1px solid #03a9f3; height: 240px; width: 320px;"
                                                    class="mt-3" id="canvas">
                                                    Your captured image will appear here...
                                                </canvas>
                                            </div> --}}
                                            <div class="form-grup">
                                                <div class="col md-auto form-group form-capture">
                                                    <div id="results"></div>
                                                    {{-- <input type="hidden" name="photoURI" id="photoURI" /> --}}
                                                    <p class="text-center">Your captured image will appear
                                                        below...</p>
                                                    <canvas
                                                        style="border: 1px solid #03a9f3; height: 240px; width: 360px;"
                                                        class="mt-3 align-middle" id="canvas" value="">
                                                    </canvas>
                                                </div>
                                                <button type="button" class="btn btn-primary" id="snap" download
                                                    onclick="SaveAPicture()">snap</button>
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
                                                {{-- </div> --}}
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
            var base64image = webcam.snap();
            document.getElementById('results').innerHTML = '<img id="imageprev" style="display: none;" src="' +
                base64image + '"/>';
            // console.log(base64image);

            document.getElementById('canvas').innerHTML = '<input type="hidden" name="photoURI" id="photoURI" value="' +
                base64image + '"/>';

            var input = document.getElementById("photoURI").value;
            console.log(input);


            // console.log(base64image);

            // canvasElement.val = base64image;
            // console.log(base64image);
        }

        // function saveSnap() {
        //     var base64toImage = document.getElementById("imageprev").src;
        //     webcam.upload(base64toImage, '/attendance/branch-employee/upload-foto', function(code, text) {
        //         console.log('semangat guis');
        //     });
        //     // console.log(base64toImage);
        // }

        function SaveAPicture() {
            // var base64toImage = document.getElementById("imageprev").src;
            var base64toImage = document.getElementById('imageprev').getAttribute('src')
            // webcam.upload(base64toImage, '/attendance/upload-photo', function(code, text) {
            //     console.log('Save Successfully');
            //     const data = JSON.parse(text);
            //     $("#photoURI").val(data.data);
            // });
            var image = new Image();
            image.src = base64toImage;
            document.body.appendChild(image);

            console.log(image);
        }


        // fix
        // function takeAPicture() {
        //     // play sound effect
        //     shutter.play();
        //     var base64image = webcam.snap();
        //     canvasElement.val = base64image;
        //     console.log(base64image);
        // }

        // function saveSnap() {
        //     webcam.upload(base64image, '/attendance/upload-photo', function(code, text) {
        //         console.log('Save Successfully');
        //         const data = JSON.parse(text);
        //         #('#photoURI').val(data.data);
        //     });
        // }

        // function takeSnapshot() {
        //     var img = document.createElement('img');
        //     var context;
        //     var width = video.offsetWidth,
        //         height = video.offsetHeight;

        //     canvas = document.createElement('canvas');
        //     canvas.width = width;
        //     canvas.height = height;

        //     context = canvas.getContext('2d');
        //     context.drawImage(video, 0, 0, width, height);

        //     img.src = canvas.toDataURL('image/png');
        //     document.body.appendChild(img);
        // }
    </script>




    {{-- ini yang fix sebelumya --}}
    {{-- <script>
        // preload shutter audio clip
        let shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = '/audio/sound.mp3';

        const webcamElement = document.getElementById("webcam");
        const canvasElement = document.getElementById("canvas");
        const webcam = new Webcam(webcamElement, "user", canvasElement);
        webcam.start();


        function takeAPicture() {
            // play sound effect
            shutter.play();
            webcam.snap(function(data_uri) {
                document.getElementById('canvas').innerHTML = '<img id="imageprev" width="300" src="' + data_uri +
                    '"/>';
            });
        }

        function saveSnap() {
            // Get base64 value from <img id='imageprev'> source
            var base64image = document.getElementById("imageprev").src;
            webcam.upload(base64image, '/attendance/photo', function(code, text) {
                console.log('Save successfully');
                const data = JSON.parse(text);
                $("#name_photo").val(data.data);
            });
        }
    </script> --}}




    {{-- dibawah ini orak orek --}}

    {{-- <script>
        Webcam.set({
            width: 320,
            height: 240,
            dest_width: 640,
            dest_height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        let shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = 'audio/sound.mp3';

        function take_snapshot() {
            shutter.play();

            Webcam.snap(function(data_uri) {
                document.getElementById('results').innerHTML = ' <img id="imageprev" width="300" src="' + data_uri +
                    '"/>';
            });
        }

        function saveSnap() {
            var base64image = document.getElementById("imageprev").src;
            Webcam.upload(base64image, '/attendance/photo'function(code, text) {
                console.log('Save successfully');
                const data = JSON.parse(text);
                $("#name_photo").val(data.data);
            });
        }
    </script> --}}




    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')
</body>

</html>







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
