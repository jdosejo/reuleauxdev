@extends('layouts.main')

<style>
    th {
        font-family: 'WorkSansRegular';
        font-size: 14px;
    }

    td {
        font-family: 'WorkSansRegular';
        font-size: 12px;
        
    }

    tr {
        padding-top:2em;
        padding-bottom:2em;
    }

</style>

@section('header-content')
<div class="row p-4 pt-1 pb-0" style="position:relative;top:-2em;margin-bottom:-4em;">
    <div class="col-md-12 p-0">
        <div class="row d-flex justify-content-between">
            <div class="col-md-3 container-fluid p-3">
                <div class="container-fluid shadow mt-3 mb-3 rounded bgc-0 p-4">
                    <div class="header-1 font-weight-bold">{{ $leaders }}</div>
                    <div class="header-6 font-weight-bold">Leaders</div>
                    <div class="header-8">Overall total leader count</div>
                </div>
            </div>
            <div class="col-md-3 container-fluid p-3">
                <div class="container-fluid shadow mt-3 mb-3 rounded bgc-0 p-4">
                    <div class="header-1 font-weight-bold">{{ $members }}</div>
                    <div class="header-6 font-weight-bold">Members</div>
                    <div class="header-8">Overall total member count</div>
                </div>
            </div>
            <div class="col-md-3 container-fluid p-3">
                <div class="container-fluid shadow mt-3 mb-3 rounded bgc-0 p-4">
                    <div class="header-1 font-weight-bold">{{ $staffs }}</div>
                    <div class="header-6 font-weight-bold">Staff</div>
                    <div class="header-8">Overall total staff count</div>
                </div>
            </div>
            <div class="col-md-3 container-fluid p-3">
                <div class="container-fluid shadow mt-3 mb-3 rounded bgc-0 p-4">
                    <div class="header-1 font-weight-bold">{{ $overallPercentage }}%</div>
                    <div class="header-6 font-weight-bold">Level Member</div>
                    <div class="header-8">Overall total branch members</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sel1').change(function() {
            let page = "{{ app('request')->input('page') }}";
            if (!page) page = 1;
            location.href = '?page=' + page + '&records=' + $(this).val() + '#member-list';
        });

        $('#sel1 option').each(function() {
            if ($(this).val() == "{{ app('request')->input('records') }}") {
                $(this).attr('selected', true);
            }
        });

        $('#search').keyup(function(e) {
            if (e.keyCode == 13) {
                location.href = '?page=1&records=10&search=' + $(this).val();
            }
        });

        $('#qrModal').on('hidden.bs.modal', function () {
            location.href = '?page=1&records=10&search=' + $('#search').val();
        });
    });
</script>
@endsection

@section('content-2')
<div class="row form-group align-items-center p-2">
    <div class="col-md-10 my-1">
        <input id="search" autocomplete="off" type="text" class="form-control" name="username" 
            placeholder="Enter search string or member QR code" />
        
    </div>
    <div class="col-md-2 my-1">
        <!-- <button type="submit" class="btn btn-primary mr-2 btn-rounded-4"> -->
        <button id="qr-scanner" type="button" class="btn btn-primary border-0 mr-2 btn-rounded-4" data-toggle="modal" data-target="#qrModal">
            <i class="fa icon-qr-1"></i>Scan QR Code
        </button>
    </div>
</div>

@if(count($data) > 0)
<div class="row p-2 pt-0">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><a class="nostyle" name="member-list" href="#">Lastname</a></th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Middlename</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $member)
                    <tr>
                        <td>{{ $member->lastname }}</td>
                        <td>{{ $member->firstname }}</td>
                        <td>{{ $member->middlename }}</td>
                        <td>{{ $member->address }}</td>
                        <td>{{ $member->contact }}</td>
                        <td>{{ $member->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row p-2">
    <div class="col-md-12">
        <div class="row p-2 justify-content-between">
            <div class="col-md-2 text-left">
                <select name="rec_per_page" class="form-control fc-1 font-regular header-10" id="sel1">
                    <option value="1">Rows per page: 1</option>
                    <option value="2">Rows per page: 2</option>
                    <option value="5">Rows per page: 5</option>
                    <option value="10">Rows per page: 10</option>
                    <option value="15">Rows per page: 15</option>
                    <option value="20">Rows per page: 20</option>
                </select>
            </div>
            <div class="col-md-3 text-center mt-2">
                <span class="fc-1 font-regular header-10">
                    {{ $from }} - {{ $to }} 
                    of 
                    {{ $total }}
                </span>
            </div>
            <div class="col-md-3 text-right">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-1 text-right">
                        <div class="circle fc-1" style="position:relative;left:90%">
                            <a class="page-nav nostyle" href="{{ $first }}">
                                <p class="font-regular header-10">|<</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                        <div class="circle" style="position:relative;left:90%">
                            <a class="page-nav nostyle" href="{{ $prev }}">
                                <p class="fc-1 font-regular header-10"><</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                        <div class="circle" style="position:relative;left:90%">
                            <a class="page-nav nostyle" href="{{ $next }}">
                                <p class="font-regular header-10">></p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1 text-right">
                        <div class="circle" style="position:relative;left:90%">
                            <a class="page-nav nostyle p-0 m-0" href="{{ $last }}">
                                <p class="fc-1 font-regular header-10">>|</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    @include('includes.search-notfound')
@endif


@endsection