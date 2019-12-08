@extends('layouts.main')

<style>
    #branchTable tbody tr:hover {
        background:#f1f1f1;
        color:#000;
        cursor:pointer;
    }

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

    .input-curve {
        background-color: transparent;
        border: 1px solid #b8b8b8 !important;
        /* border-bottom: 1px solid #b8b8b8 !important; */
        /* color: #fff !important; */
        border-radius: 1rem !important;
        font-size:12px !important;
    }

    .form-control-curve {
        -webkit-border-radius: 2em;
            -moz-border-radius: 2em;
                border-radius: 2em;
    }

    .tr-highlight {
        background:#4771E7 !important;
        color:#fff !important;
    }
    
</style>

@section('header-content')
<div class="row p-4" style="position:relative;bottom:-2em;">
    <div class="col-md-12 container-fluid shadow mb-5 rounded bgc-0">
        
        <div class="row form-group align-items-center p-4">
            <div class="col-md-12 my-1">
                <h1 class="header-1 font-light fc-1">Create Branch</h1>
                <p class="header-8 fc-1">Fill in the form below and hit save button to create a new branch.</p>
                
                @if (Session::has('success'))
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="login-form">
                    <form action="{{ env('API_URL', '127.0.0.1:8000') }}/api/branch" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" />
                        <div class="row form-group align-items-center">
                            <div class="col-md-3 my-1">
                                <input type="text" class="form-control input-curve" name="name" placeholder="Branch name">
                            </div>
                            <div class="col-md-3 my-1">
                                <input type="text" class="form-control input-curve" name="status" placeholder="Status">
                            </div>
                        </div>
                        <div class="row form-group align-items-center">
                            <div class="col-md-6 my-1">
                                <input type="text" class="form-control input-curve" name="description" placeholder="Description">
                            </div>
                        </div>
                        <div class="row form-group align-items-center">
                            <div class="col-md-3 my-1">
                                <input type="text" class="form-control input-curve" name="address" placeholder="Address">
                            </div>
                            <div class="col-md-3 my-1">
                                <input type="number" class="form-control input-curve" name="contact" placeholder="Contact">
                            </div>
                        </div>
                        <div class="row form-group align-items-center">
                            <div class="col-md-12 my-1">
                                <hr style="position:relative;top:1.5em;"/>
                            </div>
                        </div>
                        <div class="row form-group top-buffer-2">
                            <div class="col-md-12 btn-toolbar btn-lg d-flex justify-content-end">
                                <button id="cancelUpdate" type="button" 
                                    class="hidden btn btn-curve mr-2 btn-rounded-3 bgc-1 fc-0 font-light header-8">
                                    Cancel
                                </button>
                                <button id="update-branch" type="submit"
                                    class="hidden btn btn-curve mr-2 btn-rounded-3 bgc-1 fc-0 font-light header-8">
                                    Update
                                </button>
                                <button id="create-branch" type="submit" 
                                    class="btn btn-curve btn-rounded-3 bgc-1 fc-0 font-light header-8">
                                    Create Branch
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#branchTable tbody tr').click(function() {
            let id = $(this).attr('data');

            $('#branchTable tbody tr').removeClass('tr-highlight');
            $(this).addClass('tr-highlight');

            apiCall(
                "{{ env('API_URL', '127.0.0.1:8001') }}/api/branch/" + id, 'GET', 
                '',
                (data) => {
                    $('input[name="id"]').val(data['id']);
                    $('input[name="name"]').val(data['name']);
                    $('input[name="status"]').val(data['status']);
                    $('input[name="description"]').val(data['description']);
                    $('input[name="address"]').val(data['address']);
                    $('input[name="contact"]').val(data['contact']);

                    $('#cancelUpdate').removeClass('hidden');
                    $('#update-branch').removeClass('hidden');
                    $('#create-branch').addClass('hidden');
                }
            );
        });

        $('#cancelUpdate').click(function() {
            $('#cancelUpdate').addClass('hidden');
            $('#update-branch').addClass('hidden');
            $('#create-branch').removeClass('hidden');

            $('input[name="id"]').val('');
            $('input[name="name"]').val('');
            $('input[name="status"]').val('');
            $('input[name="description"]').val('');
            $('input[name="address"]').val('');
            $('input[name="contact"]').val('');

            $('#branchTable tbody tr').removeClass('tr-highlight');
        });

        $('#update-branch').click(function(e) {
            e.preventDefault();
            if (validateFields()) {
                let id = $("input[name=id]").val();
                let name = $("input[name=name]").val();
                let address = $("input[name=address]").val();
                let description = $("input[name=description]").val();
                let contact = $("input[name=contact]").val();
                let status = $("input[name=status]").val();

                apiCall(
                    "{{ env('API_URL', '127.0.0.1:8001') }}/api/branch", 'PUT', 
                    JSON.stringify({
                        id: id, 
                        name: name, 
                        address: address, 
                        description: description,
                        contact: contact,
                        status: status
                    }),
                    (data) => {
                        alert('success');
                        console.log(data);
                        
                        $('.tr-highlight td:eq(0)').html(data['name']);
                        $('.tr-highlight td:eq(1)').html(data['address']);
                        $('.tr-highlight td:eq(2)').html(data['description']);
                        $('.tr-highlight td:eq(3)').html(data['contact']);
                        $('.tr-highlight td:eq(4)').html(data['status']);
                    }
                );
            } else {
                alert("Please fill in all fields.")
            }
        });

        $('#create-branch').click(function(e) {
            e.preventDefault();

            if (validateFields()) {

                let name = $("input[name=name]").val();
                let address = $("input[name=address]").val();
                let description = $("input[name=description]").val();
                let contact = $("input[name=contact]").val();
                let status = $("input[name=status]").val();
                
                apiCall(
                    "{{ env('API_URL', '127.0.0.1:8000') }}/api/branch", 'POST', 
                    JSON.stringify({
                        name: name, 
                        address: address, 
                        description: description,
                        contact: contact,
                        status: status
                    }),
                    () => {
                        location.href = "{{ env('APP_URL', '127.0.0.1:8000') }}/branch/list";
                    }
                );
            } else {
                alert("Please fill in all fields.")
            }
        });

        $('#sel1').change(function() {
            let page = "{{ app('request')->input('page') }}";
            if (!page) page = 1;
            location.href = '?page=' + page + '&records=' + $(this).val() + '#branch-list';
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
    });

    function validateFields() {
        let name = $("input[name=name]").val();
        let address = $("input[name=address]").val();
        let description = $("input[name=description]").val();
        let contact = $("input[name=contact]").val();
        let status = $("input[name=status]").val();

        return name && address && description && contact && status;
    }
</script>
@endsection

@section('content-2')
<div class="row form-group align-items-center p-4">
    <div class="col-md-12 my-1">
        <h1 class="header-1 font-light fc-1">
            <a href="#" class="nostyle" name="branch-list">Branch List</a>
        </h1>
        <input id="search" autocomplete="off" type="text" class="form-control header-8 mt-4" name="search" 
            placeholder="Enter branch name" />
    </div>
</div>
@if(count($data) > 0)
<div class="row p-4 pt-0">
    <div class="col-md-12">
        <table id="branchTable" class="table">
            <thead>
                <tr>
                    <th scope="col">Branch</th>
                    <th scope="col">Description</th>
                    <th scope="col">Address</th>
                    <th scope="col">contact</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $branch)
                    <tr data="{{ $branch->id }}">
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->description }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>{{ $branch->contact }}</td>
                        <td>{{ $branch->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
    @include('includes.search-notfound-branch')
@endif
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

@endsection