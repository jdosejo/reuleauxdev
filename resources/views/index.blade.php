@extends('layouts.base')

@section('content')
<style>
    .display-4 {
        font-size:3em;
    }

    input[type="text"], input[type="password"] {
        background-color: transparent;
        border-bottom: 1px solid #b8b8b8 !important;
        /* color: #fff !important; */
        border-radius: 0rem;
        border: none;
    }

    input[type="text"]::placeholder, input[type="password"]::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #6c8ff0;
        opacity: 1; /* Firefox */
        font-family:'WorkSansLight';
    }

    input[type="text"]:-ms-input-placeholder, input[type="password"]::placeholder { /* Internet Explorer 10-11 */
        color: #6c8ff0;
    }

    input[type="text"]::-ms-input-placeholder, input[type="password"]::placeholder { /* Microsoft Edge */
        color: #6c8ff0;
    }

    .btn-rounded-1 {
        border-radius: 1rem;
        background: #fff;
        color:#999;
        margin:0;
        font-size:16px;
        font-weight:bold;
        margin-left:-3em;
    }

    .btn-rounded-3 {
        border-radius: 1.5rem;
        background: #f1f1f1;
        color:#4771e7;
        margin:0;
        font-size:16px;
        width: 40%;
    }

    .btn-rounded-2:hover {
        background:#DFDFDF;
        color:#4771e7;
    }
    

    .font-color-1 {
        color: #6c8ff0
    }

    .border1 {
        /* border:1px solid #000; */
        height:80vh;
    }


    .login-scrn img{
        max-width: 450px;
    }

    .form-control:focus {
        color: #ececec;
        background-color: transparent;
        border-color: #80bdff;
        outline: 0;
        -webkit-box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        box-shadow: 0 0 0 0rem rgba(0, 123, 255, 0.25);
    }

    .login-form{
        margin-top: 4em;    
    }

    .login-col{
        padding: 5em 10em 5em 0em;
    }
</style>
<!--Grid row-->
<div id="login-wrapper" class="col-md-12 text-center text-white">
    <div class="row justify-content-between">
        <div class="col-md-2 p-4 ml-3">
            <span class="header-4">Members Profiling</span>
        </div>
        <div class="col-md-3 p-4 mr-3">
            @include('svg.sun-icon')
            <span class="header-8">{{ date('H:i A') }}</span>
            <span class="header-8"> | {{ $ldate }}</span>
        </div>
    </div>

    <div class="row login-scrn top-buffer justify-content-between">
        <div class="col-md-7 border1 d-flex justify-content-center align-items-center">
            <img src="{{asset('images/qrcodecard.png')}}" />
        </div>
        <div class="col-md-5 border1 text-left login-col top-buffer">
            <h1 class="font-light-1">Welcome Back!</h1>
            <p>Please use QR Code ID scanner or type member code<br /> and password.</p>
            @isset ($message)
            <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ $message }}</p>
            </div>
            @endisset
            <div class="login-form">
                <form action="/authenticate/login" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="row form-group align-items-center">
                        <div class="col-md-10 my-1">
                            <input type="text" autocomplete="off" class="form-control fc-0" name="username" value="" placeholder="Enter member code...">
                        </div>
                    </div>
                    <div class="row form-group align-items-center">
                        <div class="col-md-10 my-1">
                            <input type="password" autocomplete="new-password" class="form-control fc-0" name="password" value="" placeholder="Enter password...">
                        </div>
                        
                    </div>
                    <div class="row form-group align-items-center top-buffer-2">
                        <div class="col-md-12 btn-toolbar btn-lg">
                            <button id="qr-scanner" type="button" class="btn btn-primary border-0 mr-2 btn-rounded-2" data-toggle="modal" data-target="#qrModal">
                                <i class="fa icon-qr"></i>Scan QR Code
                            </button>
                            <button type="submit" class="btn btn-primary btn-rounded-3">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row justify-content-start top-buffer-2">
        <div class="col-md-2">
            <span class="font-color-1">&#169; All rights reserved 2019</span>
        </div>
    </div>

    <!-- <div class="row justify-content-center top-buffer-2">
        <div class="col-md-12">
            <h3 class="display-4">Authentication Page</h3>
            <p>
                <div>Member profiling application</div>
            </p> 
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <img src="{{asset('images/cardsample.png')}}" />
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <p>
                <div>Please use QR code scanner or type in code</div>
                <div>and password to login.</div>
            </p> 
        </div>
    </div>

    <div class="row justify-content-center top-buffer">
        <div class="col-md-4">
            <form action="/authenticate/login" method="POST">
                {{ csrf_field() }}
                <div class="row form-group align-items-center">
                    <div class="col-md-10 my-1">
                        <input type="text" class="form-control" name="username" placeholder="Enter member code...">
                    </div>
                </div>
                <div class="row form-group align-items-center">
                    <div class="col-md-10 my-1">
                        <input type="text" class="form-control" name="password" placeholder="Enter password...">
                    </div>
                    <div class="col-sm-2 my-1">
                        <button type="submit" class="btn btn-primary btn-rounded-1"> > </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-start top-buffer-2">
        <div class="col-md-2">
            <span class="font-color-1">&#169; All rights reserved 2019</span>
        </div>
    </div> -->
</div>

<!--Grid row-->
@endsection