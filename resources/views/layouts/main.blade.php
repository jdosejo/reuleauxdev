@extends('layouts.base')

<style>
    .zero-margin {
        margin: 0;
    }

    input[type="text"] {
        background-color: transparent;
        border-bottom: 1px solid #b8b8b8 !important;
        /* color: #fff !important; */
        border-radius: 0rem;
        border: none;
    }

    .btn-rounded-4 {
        border-radius: 1.5rem !important;
        background: #ffb100 !important;
        color:#5d5757 !important;
        margin:0;
        font-size:14px !important;
        width:90%;
    }

    .btn-rounded-4:hover {
        background:#FFCD5C !important;
        color:#5d5757 !important;
    }

    .icon-qr-1 {
        background:url("{{asset('css/icons/qr-code.png')}}") no-repeat;
        width:16px;
        height:16px;
        float:left;
        position:relative;
        left:-0.2em;
        top:0.2em;
    }

    .circle {
        border-radius: 200px;
        height: 25px;
        font-weight: bold;
        width: 25px;
        display: table;
    }
    .circle p {
        vertical-align: middle;
        display: table-cell;
        text-align:center;
    }

    .circle-active {
        background: #214AB9;
        color: white;
    }

    .circle-active p {
        color: #ffffff;
    }

    .circle-inactive {
        background: #ffffff;
    }

    .circle-inactive p {
        color: #f1f1f1;
    }

    a span, a div {
        color: #ffffff;
    }

    a:active span, a:active div {
        color: #214AB9;
    }

    
    .page-nav {
        height: 25px;
        font-weight: bold;
        width: 25px;
        display: table;
    }

    .page-nav:hover {
        background: #214AB9;
        color: #ffffff;
        border-radius: 200px;
    }

    .page-nav p, .page-nav:hover p {
        vertical-align: middle;
        display: table-cell;
        text-align:center;
    }

    .page-nav:hover p {
        color: #ffffff;
    }
</style>

@include('includes.topbar')

@section('content')
<div class="col-md-12 zero-margin">
    <div class="row h-100">
        <div class="col-md-2 text-white">
            @if(Request::segment(1) == 'dashboard')
                <div class="row p-2 mt-5 bl-5 bc-1">
            @else
                <div class="row p-2 mt-5 bl-5 bc-0">
            @endif
                <div class="col-md-12 ml-2 mr-1 text-left">
                    <span class="mr-2 m-nt-1">@include('svg.search-icon')</span>
                    <a href="/dashboard"><span class="ml-2">Dashboard</span></a>
                </div>
            </div>

            @if(Request::segment(1) != 'dashboard')
                <div class="row p-2 bl-5 bc-1 mt-4">
            @else
                <div class="row p-2 mt-4 bl-5 bc-0">
            @endif
            
                <div class="col-md-12 ml-2 mr-1 text-left">
                    <span class="mr-2 m-nt-1">@include('svg.user-sidebar-icon')</span>
                    <a href="/member/list"><span class="ml-2">Accounts</span></a>
                </div>
            </div>

            <div class="row p-1 mt-2">
                <a href="/profiling">
                    @if(Request::segment(1) == 'profiling')
                        <div class="col-md-12 ml-5 pl-4 fc-3 text-left header-10">Create Account</div>
                    @else
                        <div class="col-md-12 ml-5 pl-4 text-left header-10">Create Account</div>
                    @endif
                    
                </a>
            </div>

            <div class="row p-1 mt-1">
                <a href="/branch/list">
                    @if(Request::segment(1) == 'branch')
                        <div class="col-md-12 ml-5 pl-4 fc-3 text-left header-10">Create Branch</div>
                    @else
                        <div class="col-md-12 ml-5 pl-4 text-left header-10">Create Branch</div>
                    @endif
                    
                </a>
            </div>
        </div>
        <div class="col-md-10 bg-fade-white pt-1">
            @yield('header-content')
            <div class="row p-4">
                <div class="col-md-12 container-fluid shadow mb-5 rounded bgc-0 profiling">
                    @yield('content-2')
                </div>
                <div class="col-md-12 container-fluid header-10 fc-1 font-weight-bold" 
                    style="position:relative;top:-3em;">
                    &#169; 2019, All rights reserved
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        apiCall(
            "{{ env('API_URL', '127.0.0.1:8001') }}/api/scan", 'PUT', 
            JSON.stringify({
                'id': '1234567891011',
                'qr_code': 'QRCGL3210023914008'
            }),
            (data) => {
                alert('success');
                console.log(data);
            }
        );
    });
    
</script> -->

@endsection