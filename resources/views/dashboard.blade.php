@extends('layouts.main')

@section('content-2')
<div class="row form-group align-items-center p-2">
    <div class="col-md-10 my-1">
        <input id="search" autocomplete="off" type="text" class="form-control" name="username" placeholder="Scan member QR code">
        
    </div>
    <div class="col-md-2 my-1">
        <!-- <button id="" type="submit" class="btn btn-primary mr-2 btn-rounded-4"> -->
        <button id="qr-scanner" type="button" class="btn btn-primary border-0 mr-2 btn-rounded-4" data-toggle="modal" data-target="#qrModal">
            <i class="fa icon-qr-1"></i>Scan QR Code
        </button>
    </div>
    
</div>

<script type="text/javascript">
    var qr_code = "{{ app('request')->input('qr_code') }}";

    function getScan() {
        $.get('/getScan', (data) => {
            //console.log(data);
            if (data && data.qr_code && qr_code != data.qr_code) {
                location.href = '/dashboard?qr_code=' + data.qr_code;
            }

            setTimeout(() => {   
                getScan()
            }, 3000);
        });
    }

    function updateScan() {
        apiCall("{{ env('APP_URL', '127.0.0.1:8001') }}/api/scan", 'PUT',
            JSON.stringify({
                id: "{{ Auth::user()->username }}",
                qr_code: $('#search').val()
            }),
            (data) => {
                // test
            }
        )
    }
    
    getScan();
    
    $(document).ready(function() {
        $('#qrModal').on('hidden.bs.modal', function () {
            updateScan();
        });
    });
</script>

@if(app('request')->input('qr_code') && $data)
    @include('includes.search-result')
@else
    @include('includes.search-status')
@endif

@endsection