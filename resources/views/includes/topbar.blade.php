<nav class="navbar navbar-expand static-top topbar bgblue pl-0 pr-0">
    <div class="row w-100 p-0 m-0">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <div class="col-md-2">
                    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                        <span class="text-white font-regular header-6">Members Profiling</span>
                    </button>
                </div>

                <div class="col-md-3 align-self-center text-right font-light header-8">
                    <span class="text-white font-light">
                        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                    </span>
                    <span class="text-white font-light ml-2 mr-2"> | </span>
                    <span class="center-icon-nt-1">@include('svg.person-icon-gray')</span>
                    <a href="/logout" class="nostyle">
                        <span class="text-white font-light ml-2 font-weight-bold">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>