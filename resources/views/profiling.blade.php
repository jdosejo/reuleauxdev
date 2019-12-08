@extends('layouts.main')

<style>
    .input-curve {
        background-color: transparent;
        border: 1px solid #b8b8b8 !important;
        /* border-bottom: 1px solid #b8b8b8 !important; */
        /* color: #fff !important; */
        border-radius: 1rem !important;
        font-size:12px !important;
        z-index:99999999 !important;
    }

    .form-control-curve {
        -webkit-border-radius: 2em;
            -moz-border-radius: 2em;
                border-radius: 2em;
    }

    .profiling {
        /* height:160vh !important; */
    }

    .image-upload {
        cursor:pointer;
    }

    .image-upload > input {
        display: none;
    }
</style>

@section('content-2')
<form id="memberForm" action="{{ env('APP_URL', '127.0.0.1:8000') }}/register" method="POST" autocomplete="off" autofill="off">
{{ csrf_field() }}

<input type="hidden" name="imgbase64" value="" />
<input type="hidden" name="sigbase64" value="" />

<div class="row form-group align-items-center p-4">
    <div class="col-md-12 my-1">
        <h1 class="header-1 font-light fc-1">Create Accounts</h1>
    </div>
    <div class="col-md-10 my-1">
        <input type="text" class="form-control header-8" name="search" placeholder="Enter member QR code">
    </div>
    <div class="col-md-2 my-1">
        <!-- <button type="button" class="btn btn-primary mr-2 btn-rounded-4"> -->
        <button id="qr-scanner" type="button" class="btn btn-primary border-0 mr-2 btn-rounded-4" data-toggle="modal" data-target="#qrModal">
            <i class="fa icon-qr-1"></i>Scan QR Code
        </button>
    </div>
</div>

<div class="row form-group align-items-center p-5">
    <a id="triggerCamera" href="#cameraModal" data-toggle="modal" data-target="#cameraModal">
        <div id="results" class="hidden col-md-2 my-1"></div>
        <div id="svg-upload-photo" class="col-md-2 my-1">
            @include('svg.upload-photo')
        </div>
    </a>
    <div class="col-md-3 my-1">
        <span class="header-4 font-weight-bold">Upload profile picture</span>
        <p class="header-10 fc-1 font-light font-weight-bold">*Click on the camera icon to to start taking member picture.</p>
    </div>

    <div class="col-md-12 my-1">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-2 my-1">
                <span class="header-8 fc-1 font-light ">Select privileges*</span>
            </div>
            <div class="col-md-2 my-1">
                <select name="classification_id" class="form-control fc-1 font-regular header-10 input-curve p-2" id="sel1">
                    <option value="" selected disabled>Classification</option>
                    @foreach($classifications as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 my-1">
                <select name="branch_id" class="form-control fc-1 font-regular header-10 input-curve p-2" id="sel2">
                    <option value="" selected disabled>Branch name</option>
                    @foreach($branches as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 my-1" style="margin-top:-5em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-12 my-1">
                <h1 class="header-4 font-light fc-1 font-weight-bold">General Information</h1>
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="firstname" placeholder="Firstname">
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="lastname" placeholder="Lastname">   
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="middlename" placeholder="Middlename">   
            </div>
            
        </div>
    </div>

    <div class="col-md-12 my-1">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-2 my-1">
                <input type="text" style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="birthdate" placeholder="Birthdate">   
            </div>
            <div class="col-md-2 my-1">
                <!-- <input type="text" 
                    style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="status" placeholder="Status"> -->

                <select name="status" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    style="margin-top:-7em !important;"
                    id="sel3">
                    <option value="" selected disabled>Status</option>
                    <option value="New">New</option>
                    <option value="Active">Active</option>
                    <option value="Re-Entry">Re-Entry</option>
                </select>
            </div>
            <div class="col-md-4 my-1 pl-4">
                <div class="image-upload" style="margin-top:-7em !important;">
                    <label for="file-input">
                        <img id="signature" class="hidden" alt="member signature" />
                        @include('svg.import-signature-icon')
                    </label>
                    <input id="file-input" type="file" onchange="readURL(this);" />
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 my-1" style="margin-top:-7em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-12 my-1">
                <h1 class="header-4 font-light fc-1 font-weight-bold">Contact Address</h1>
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="address" placeholder="Address">
            </div>
            <div class="col-md-2 my-1">
                <input type="number" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="contact" placeholder="Contact">   
            </div>
        </div>
    </div>

    <div class="col-md-12 my-1" style="margin-top:-5em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-12 my-1">
                <h1 class="header-4 font-light fc-1 font-weight-bold">Login Credentials</h1>
            </div>
            <div class="col-md-3 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="username" placeholder="Member Code" autocomplete="off" readonly="true">
            </div>
            <div class="col-md-3 my-1">
                <p class="header-10 fc-1 font-light font-weight-bold">*Autogenerated QR Code.</p>
            </div>
        </div>
    </div>

    <div class="col-md-12 my-1">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-3 my-1">
                <input type="password" 
                    style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="password" placeholder="Password" autocomplete="new-password" value="">
            </div>
            <div class="col-md-3 my-1">
                <input type="password" 
                    style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="password_confirmation" placeholder="Confirm Password" value="">
            </div>
            <div class="col-md-3 my-1" style="margin-top:-10em !important;">
                <a id="showPassword" href="#" class="nostyle">
                    @include('svg.view-eye-icon')
                </a>
            </div> 
        </div>
    </div>

    <div class="col-md-12 my-1" style="margin-top:-5em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-1 my-1">
                <div>
                    <div 
                        id="qrcode" 
                        style="width:100px;height:100px;position:relative;">
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-1 ml-5">
                <div class="row form-group align-items-center">
                    <div class="col-md-12 my-1">
                        <p class="header-10 fc-1 font-light font-weight-bold">
                            *Click on the generate "QR Code button" to create member QR Code.
                        </p>
                    </div>
                    <div class="col-md-6 my-1">
                        <button id="qr-generator" type="submit" class="btn btn-primary border-0 mr-2 btn-rounded-4">
                            Generate QR Code
                        </button>
                    </div>
                    <div class="col-md-5 my-1">
                        <span>Download QR Code Image</span>
                    </div>
                </div>
            </div>

            <div class="col-md-12 my-1 ml-5">
                <hr />
            </div>

            <div class="col-md-12 btn-toolbar btn-lg d-flex justify-content-end">
                <button id="cancelUpdate" type="button" 
                    class="hidden btn btn-curve mr-2 btn-rounded-3 bgc-1 fc-0 font-light header-8">
                    Cancel
                </button>
                <button id="updateMember" type="submit" 
                    class="hidden btn btn-curve mr-2 btn-rounded-3 bgc-1 fc-0 font-light header-8">
                    Update
                </button>
                <button id="createMember" type="submit" 
                    class="btn btn-curve btn-rounded-3 bgc-1 fc-0 font-light header-8">
                    Create Member
                </button>
            </div>
        </div> 
    </div>
</div>
</form>

<input type="hidden" name="member_id" />
<div id="cameraModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width:350px;padding:1em;">
            <div id="my_camera"></div>
            <!-- <input type=button value="Take Snapshot" onClick="take_snapshot()"> -->
            
            <button id="captureImage" type="button" class="btn btn-primary mt-1">Capture Image</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        generateQRCode('');

        $('input[name="birthdate"]').datepicker();

        $('input[name="search"]').keyup(function(e) {
            if (e.keyCode == 13) {
                getUpdateData();
            }
        });

        $('#showPassword').click(function() {
            let t = $('input[name="password"]').attr('type');
            if (t == 'password') {
                $('input[name="password"]').attr('type', 'text');
                $('input[name="password_confirmation"]').attr('type', 'text');
            } else {
                $('input[name="password"]').attr('type', 'password');
                $('input[name="password_confirmation"]').attr('type', 'password');
            }
        });

        $('#qrModal').on('hidden.bs.modal', function () {
            if ($('#search').val() != "") {
                getUpdateData();
            }
        });

        $('#cancelUpdate').click(function() {
            $('#updateMember').addClass('hidden');
            $('#cancelUpdate').addClass('hidden');
            $('#createMember').removeClass('hidden');

            $('#sel1 option:eq(0)').attr('selected', true);
            $('#sel2 option:eq(0)').attr('selected', true);
            $('#sel3 option:eq(0)').attr('selected', true);

            $('input[name="search"]').val('');
            $('input[name="member_id"]').val('');
            $('input[name="firstname"]').val('');
            $('input[name="lastname"]').val('');
            $('input[name="middlename"]').val('');
            $('input[name="birthdate"]').val('');
            //$('input[name="status"]').val('');
            $('input[name="address"]').val('');
            $('input[name="contact"]').val('');
            $('input[name="username"]').val('');
            $('input[name="password"]').val('');
            $('input[name="password_confirmation"]').val('');

            $('#results').html("");
            $('#svg-upload-photo').removeClass('hidden');
            $('#results').addClass('hidden');
            $('#signature').addClass('hidden');
            $('input[name="username"]').attr('disabled', false);

            $('#qr-generator').attr('disabled', false);
            generateQRCode('');
        });

        $('#updateMember').click(function(e) {
            e.preventDefault();

            let img = document.getElementById("imageprev");
            let sig = document.getElementById("signature");

            let imgsrc = img ? img.src : '';
            let sigsrc = sig ? sig.src : '';

            let imgbase64 = '';
            let sigbase64 = '';

            getDataUri(imgsrc, function(dataUri) {
                imgbase64 = dataUri;

                getDataUri(sigsrc, function(dataUri) {
                    sigbase64 = dataUri;

                    let member = JSON.stringify({
                        'id': $('input[name="member_id"]').val(),
                        'firstname': $('input[name="firstname"]').val(),
                        'lastname': $('input[name="lastname"]').val(),
                        'middlename': $('input[name="middlename"]').val(),
                        'birthdate': $('input[name="birthdate"]').val(),
                        'status': $('#sel3').val(),
                        'address': $('input[name="address"]').val(),
                        'contact': $('input[name="contact"]').val(),
                        'username': $('input[name="username"]').val(),
                        'password': $('input[name="password"]').val(),
                        'classification_id': $('#sel1').val(),
                        'branch_id': $('#sel2').val(),
                        'imgbase64': imgbase64,
                        'sigbase64': sigbase64
                    });
                    // console.log(member);
                    if (validateFields()) {
                        apiCall(
                            "{{ env('API_URL', '127.0.0.1:8001') }}/api/member/", 'PUT', 
                            member,
                            (data) => {
                                alert('Successfully updated member.');
                            }
                        );
                    } else {
                        alert('Please fill in all fields.')
                    }
                });
            });
            
        });

        $('#createMember').click(function(e) {
            e.preventDefault();

            if (validateFields()) {
                // Get base64 value from <img id='imageprev'> source
                let img = document.getElementById("imageprev");
                let sig = document.getElementById("signature");

                let imgbase64 = img ? img.src : '';
                let sigbase64 = sig ? sig.src : '';

                $('input[name="imgbase64"]').val(imgbase64);
                $('input[name="sigbase64"]').val(sigbase64);

                $('#memberForm').submit();
            } else {
                alert('Please fill in all fields.')
            }
        });

        $('#qr-generator').click(function(e) {
            e.preventDefault();

            var d = new Date();
            var year = d.getFullYear();
            let code = makeid(8);

            let nextid = '{{ $nextid }}';
            let len = Math.min(8, nextid.length);
            code = code.slice(0, -len) + nextid;
            code = 'QRKP-' + code + '-' + year;
            
            $('input[name="username"]').val(code);
            generateQRCode(code);
        });
        
        <!-- Configure a few settings and attach camera -->

        $('#triggerCamera').click(function() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#my_camera');
        });

        $('#cameraModal').on('hidden.bs.modal', function () {
            Webcam.reset();
        });

        <!-- Code to handle taking the snapshot and displaying it locally -->
        $('#captureImage').click(function() {
            // take snapshot and get image data
            Webcam.snap( function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML = 
                    '<img id="imageprev" src="'+data_uri+'" width="240" height="180" />';

                $('#results').removeClass('hidden');
                $('#svg-upload-photo').addClass('hidden');
            });
        });
        
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#signature')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(75);
            };

            $('#signature').removeClass('hidden');
            reader.readAsDataURL(input.files[0]);
        }
    }

    function generateQRCode(code) {
        document.getElementById("qrcode").innerHTML = '';

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 100,
            height : 100
        });

        qrcode.makeCode(code);
    }

    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var charactersLength = characters.length;
        
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
       
        return result;
    }

    function validateFields() {
        let classification_id = $('#sel1').val();
        let branch_id = $('#sel2').val();
        let firstname = $('input[name="firstname"]').val();
        let lastname = $('input[name="lastname"]').val();
        let middlename = $('input[name="middlename"]').val();
        let birthdate = $('input[name="birthdate"]').val();
        let status = $('#sel3').val();
        let address = $('input[name="address"]').val();
        let contact = $('input[name="contact"]').val();
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();
        let password_confirmation = $('input[name="password_confirmation"]').val();

        let img = document.getElementById("imageprev");
        let sig = document.getElementById("signature");

        let imgsrc = img ? img.src : '';
        let sigsrc = sig ? sig.src : '';

        if (password != "") {
            if (password != password_confirmation) return false;
        }

        return (
            firstname && lastname && middlename && birthdate && classification_id && 
            branch_id && status && address && contact && username && imgsrc && sigsrc 
        );
    }

    function getUpdateData() {
        apiCall(
            "{{ env('API_URL', '127.0.0.1:8001') }}/api/member/" + $('input[name="search"]').val(), 'GET', 
            JSON.stringify({
                id: $('input[name="search"]').val()
            }),
            (data) => {
                if (data['classification_id']) {
                    $('#sel1 option').each(function() {
                        if ($(this).val() == data['classification_id']) {
                            $(this).attr('selected', true);
                        } else {
                            $(this).attr('selected', false);
                        }
                    });
                }

                if (data['branch_id']) {
                    $('#sel2 option').each(function() {
                        if ($(this).val() == data['branch_id']) {
                            $(this).attr('selected', true);
                        } else {
                            $(this).attr('selected', false);
                        }
                    });
                }

                if (data['status']) {
                    $('#sel3 option').each(function() {
                        if ($(this).val() == data['status']) {
                            $(this).attr('selected', true);
                        } else {
                            $(this).attr('selected', false);
                        }
                    });
                }

                $('input[name="member_id"]').val(data['id']);
                $('input[name="firstname"]').val(data['firstname']);
                $('input[name="lastname"]').val(data['lastname']);
                $('input[name="middlename"]').val(data['middlename']);
                $('input[name="birthdate"]').val(data['birthdate']);
                //$('input[name="status"]').val(data['status']);
                $('input[name="address"]').val(data['address']);
                $('input[name="contact"]').val(data['contact']);
                $('input[name="username"]').val(data['username']);

                generateQRCode(data['username']);

                let picPath = "{{ env('APP_URL', '127.0.0.1:8000') }}/images/pics/" + data['username'] + '.png';
                let sigPath = "{{ env('APP_URL', '127.0.0.1:8000') }}/images/signatures/" + data['username'] + '.png';

                $.get(picPath)
                    .done(function() { 
                        document.getElementById('results').innerHTML = 
                            '<img id="imageprev" src="' + picPath + '" width="240" height="180" />';
                    }).fail(function() { 
                        // Image doesn't exist - do something else.
                        $('#results').html("");
                        $('#svg-upload-photo').removeClass('hidden');
                    });

                $.get(sigPath)
                    .done(function() { 
                        $('#signature')
                            .attr('src', sigPath)
                            .width(100)
                            .height(75);
                        $('#signature').removeClass('hidden');
                    }).fail(function() { 
                        // Image doesn't exist - do something else.

                    });

                $('#updateMember').removeClass('hidden');
                $('#cancelUpdate').removeClass('hidden');
                $('#results').removeClass('hidden');

                $('#createMember').addClass('hidden');
                $('#svg-upload-photo').addClass('hidden');
                
                $('input[name="username"]').attr('disabled', true);
                $('#qr-generator').attr('disabled', true);
            }
        );
    }
</script>
@endsection