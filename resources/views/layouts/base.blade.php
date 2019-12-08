
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Profiling</title>

		<!-- Custom fonts for this template-->
		<link rel="stylesheet" href="{{asset('css/lib/fontawesome-free/css/all.min.css')}}">

		<!-- Custom styles for this template-->
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('js/lib/jquery-ui-1.12.1/jquery-ui.css')}}">
        <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            @font-face {
                font-family: 'WorkSansLight';
                src: url('{{asset('css/fonts/WorkSans-Light.ttf')}}')  format('truetype'); /* IE9 Compat Modes */
            }

            @font-face {
                font-family: 'WorkSansRegular';
                src: url('{{asset('css/fonts/WorkSans-Regular.ttf')}}')  format('truetype'); /* IE9 Compat Modes */
            }

            @font-face {
                font-family: 'AbelRegular';
                src: url('{{asset('css/fonts/Abel-Regular.ttf')}}')  format('truetype'); /* IE9 Compat Modes */
            }
            
            html, body {
                padding:0;
                margin:0;
                overflow-x: hidden;
                height:100%;
            }
            body {
                background: #214AB9;
                font-family: 'WorkSansRegular';
            }

            .flex-fill {
                flex:1;
            }
           
            #wrapper {
                margin:0 !important;
            } 

            /* .center-panel {
                height:70%;
                width:85%;
            } */

            .bgblue {
                background: #214AB9;
            }

            .no-margin {
                margin:0 !important;
            }
            
            .bordered {
                border:1px solid red;
            }

            .nopadding {
                padding:0;
            }

            .topbar {
                padding:1em;
            }

            .bg-fade-white {
                background:#f1f1f1;
            }

            .font-light {
                font-family: 'WorkSansLight';
            }

            .font-regular {
                font-family: 'WorkSansRegular';
            }

            .header-1 {  font-size:30px; }
            .header-2 {  font-size:20px; }
            .header-4 { font-size:18px; }
            .header-5 { font-size:16px; }
            .header-6 { font-size:14px; }
            .header-8 { font-size:12px; }
            .header-10 { font-size:10px; }

            .center-icon-nt-1 {
                position:relative;
                top:-0.2em;
            }

            .center-icon-nl-1 {
                position:relative;
                left:-0.2em;
            }

            .top-buffer { margin-top: 40px; }
            .top-buffer-1 { margin-top: 50px; }
            .top-buffer-2 { margin-top: 30px; }

            .m-nt-1 {
                position:relative;
                top:-0.2em;
            }

            .m-nt-2 {
                position:relative;
                top:-0.4em;
            }

            .m-nt-3 {
                position:relative;
                top:-0.6em;
            }

            .m-nt-4 {
                position:relative;
                top:-0.8em;
            }

            .m-nt-5 {
                position:relative;
                top:-1em;
            }

            .bl-1 { border-left:1px solid; }
            .bl-2 { border-left:2px solid; }
            .bl-3 { border-left:3px solid; }
            .bl-4 { border-left:4px solid; }
            .bl-5 { border-left:5px solid; }

            .bc-0 { border-color:#214AB9; }
            .bc-1 { border-color:#FFB100; }

            .fc-0 { color:#ffffff; }
            .fc-1 { color:#5D5757; }
            .fc-2 { color:#f1f1f1; }
            .fc-3 { color:#FFB100; }

            .bgc-0 { background:#ffffff; }
            .bgc-1 { background:#214AB9; }

            .btn-rounded-2 {
                border-radius: 1.5rem;
                background: #ffb100;
                color:#5d5757;
                margin:0;
                font-size:16px;
                width: 40%;
            }

            .btn-rounded-2:hover {
                background:#FFCD5C;
                color:#5d5757;
            }

            .icon-qr {
                background:url("{{asset('css/icons/qr-code.png')}}") no-repeat;
                width:16px;
                height:16px;
                float:left;
                position:relative;
                left:0.9em;
                top:0.2em;
            }

            a.nostyle:link {
                text-decoration: inherit;
                color: inherit;
            }

            a.nostyle:visited {
                text-decoration: inherit;
                color: inherit;
            }

            .hidden {
                display:none !important;
            }

                
            .btn-curve {
                border-radius: 1rem !important;
            }

            .btn-curve:hover {
                background:#4771E7 !important;
                color:#fff !important;
                font-weight:bold;
            }

        </style>
	</head>
	
	<body id="page-top">
        <!-- <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="#"></a>

            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>
        </nav> -->

        <div id="wrapper" class="h-100 no-margin nopadding flex-fill row">

            <!-- <div class="row no-margin container-fluid center-panel bgblue shadow p-3 mb-5 rounded"> -->
            <div class="row no-margin nopadding container-fluid center-panel bgblue">
                @yield('content')
            </div>
        </div>

        

		<!-- Bootstrap core JavaScript-->
        <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('js/lib/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
        
		<script src="{{asset('css/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		
		<!-- Custom scripts for all pages-->
        <script src="{{asset('js/custom.js')}}"></script>
        <script src="{{asset('js/davidshimjs-qrcodejs-04f46c6/qrcode.js')}}"></script>
        <script src="{{asset('js/lib/webcam.min.js')}}"></script>
        <script src="{{asset('js/lib/instascan.min.js')}}"></script>
        <!-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
        

        <!-- <script src="js/app.js"></script> -->
        <script type="text/javascript">
            var scanCallback = null;

            function apiCall(url, method, data, callback) {
                $.ajax({
                    type: method,
                    url: url,
                    dataType: 'json',
                    crossDomain: true,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer {{ Session::get('access_token') }}',
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: data,
                    success: function(data){
                        callback(data);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Transaction Failed. Please try again.");
                        //console.log($('meta[name="csrf-token"]').attr('content'));
                        //console.log(xhr);
                    }
                });
            }

            function qrScan(el) {
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                scanner.addListener('scan', function (content) {
                    scanner.stop();
                    $('#qrModal').modal('hide');
                    el.val(content);
                    if (scanCallback) {
                        scanCallback(content);
                    }
                });
                    Instascan.Camera.getCameras().then(function (cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        console.error('No cameras found.');
                    }
                    }).catch(function (e) {
                    console.error(e);
                });
            }

            function getDataUri(url, callback) {
                var image = new Image();

                image.onload = function () {
                    var canvas = document.createElement('canvas');
                    canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
                    canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

                    canvas.getContext('2d').drawImage(this, 0, 0);

                    // Get raw image data
                    //callback(canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, ''));

                    // ... or get as Data URI
                    callback(canvas.toDataURL('image/png'));
                };

                image.onerror = function () {
                    callback('');
                }
                
                image.src = url;
            }

            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $(document).ready(function() {
                $('#qrModal').on('show.bs.modal', function () {
                    qrScan($('input[name="username"], input[name="search"]'));
                });
            });
        </script>
	</body>

    <div id="qrModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width:350px;padding:1em;">
                <video id="preview" style="width:325px;height:150px;" ></video>
            </div>
        </div>
    </div>
</html>