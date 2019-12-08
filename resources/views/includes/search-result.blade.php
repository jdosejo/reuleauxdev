<style>
    .card-id {
        width:400px;
        height:300px;
    }
    .modal-dialog{
        position: relative;
        display: table; /* This is important */ 
        overflow-y: auto;    
        overflow-x: auto;
        width: auto;  
    }
    .flip-card {
        background-color: transparent;
        width: 400px;
        height: 300px;
        perspective: 1000px;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }

    /* .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    } */

    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
    }

    .flip-card-front {
        color: black;
        padding:0;
        margin:0;
    }

    .flip-card-back {
        color: white;
        transform: rotateY(180deg);
        padding:0;
        margin:0;
    }

    body {
        overflow-y:hidden !important;
    }
</style>
<div id="general-info" class="row mt-5">
    <div class="col-md-4 p-5 d-flex justify-content-center self-align-center">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img id="member-picture-1" src="{{ asset('images/pics') }}/{{ $data->username }}.png" class="rounded-circle" 
                            width="100px" height="100px" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-4 text-center">
                        <h1 class="header-1 font-light">
                            {{ $data->firstname }} {{ $data->lastname }}
                        </h1>
                        <div class="fc-1">{{ $data->username }}</div>
                        <div>
                            <img src="{{ asset('images/signatures') }}/{{ $data->username }}.png"
                                width="100px" height="100px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="col-md-4 pt-4 mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h1 class="header-5 font-regular font-weight-bold">General Information</h1>
                    </div>
                </div>
                <div class="row mt-4 pt-1">
                    <div class="col-md-5 text-left fc-1">
                        <span>Classification:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        @if($data->classification_id == 1)
							<span class="font-weight-bold">Leader</span>
						@elseif($data->classification_id == 2)
							<span class="font-weight-bold">Staff</span>
						@else
							<span class="font-weight-bold">Member</span>
						@endif
						
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Firstname:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->firstname }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Lastname:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->lastname }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Middlename:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->middlename }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Age:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->age }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Status:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">Single</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Birthdate:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->birthdate }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="col-md-12 pt-5">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="row mt-3">
                        <div class="col-md-3 text-left fc-1">
                            <span>Contact:</span>
                        </div>
                        <div class="col-md-7 text-left">
                            <span class="font-weight-bold">{{ $data->contact }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 text-left fc-1">
                            <span>Address:</span>
                        </div>
                        <div class="col-md-7 text-left">
                            <span class="font-weight-bold">{{ $data->address }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 text-left fc-1">
                            <span>QR Code:</span>
                        </div>
                        <div class="col-md-7 text-left">
                            <div 
                                id="qrcode" 
                                style="width:100px;height:100px;position:relative;">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row text-right mb-2" style="margin-top:7em;">
    <div class="col-md-12">
        <span class="mr-2 m-nt-1">@include('svg.save-file-icon')</span>
        <a id="openPrint" href="#printModal" data-toggle="modal" data-target="#printModal">
            <span class="fc-1 font-regular font-weight-bold pr-2 mt-5">View ID</span>
        </a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printModalLabel">Member ID Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <canvas id="canvas" width="1011" height="641" class="hidden"></canvas>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front" id="card-front">
                    @if($data->classification_id == 1)
                        @include('svg.leader-card-front')
                    @elseif($data->classification_id == 2)
                        @include('svg.staff-card-front')
                    @else
                        @include('svg.member-card-front')
                    @endif
                </div>
                <div class="flip-card-back" id="card-back">
                    @if($data->classification_id == 1)
                        @include('svg.leader-card-back')
                    @elseif($data->classification_id == 2)
                        @include('svg.staff-card-back')
                    @else
                        @include('svg.member-card-back')
                    @endif
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="save-img" type="button" class="btn btn-secondary" data-dismiss="modal">Save Image</button>
        <button id="print-btn" type="button" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    var svgeq = 0;

    $(document).ready(function() {
        var rotation = 0;
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 100,
            height : 100
        });

        qrcode.makeCode("{{ $data->username }}");

        $('.flip-card').click(function() {
            rotation = (rotation + 180) % 360
            svgeq = (svgeq + 1) % 2;
            $('.flip-card-inner', this).css({
                transform: 'rotateY(' + rotation + 'deg)'
            });
        });

        $('#print-btn').click(function() {
            printDiv();
        });
        
        $('#save-img').click(function() {
            //saveImage($(".card-id:eq(" + svgeq+ ")")[0]);
            let qr_code = "{{ $data->username }}";
            saveImage($(".card-id:eq(0)")[0], qr_code + '-front');
            saveImage($(".card-id:eq(1)")[0], qr_code + '-back');
        });

        
        let isCardFilled = false;
        $('#printModal').on('show.bs.modal', function () {
            if (!isCardFilled) {
                fillFrontCard();
                fillBackCard();
                isCardFilled = true;
            }
        });
    });

    function printDiv() 
    {

        var divToPrint=document.getElementById(svgeq ? 'card-back' : 'card-front');
        // var style = '<style>@media print and (width: 8.56cm) and (height: 5.4cm) { @page {margin: 0; } }</style>';
        var style = '<style>'
        style += '@media print{@page { size: 3.37in 2.127in;margin:0;} .card-id{height:295px;margin-left:-278px;margin-top:-5px;}';
        style += 'header, footer, aside, nav, form, iframe, .menu, .hero, .adslot { display: none; }';
        style += '</style>';
        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><head>' + style + '</head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }

    function saveImage(el, fn) {
        var svgString = new XMLSerializer().serializeToString(el);

        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var DOMURL = self.URL || self.webkitURL || self;
        var img = new Image();
        var svg = new Blob([svgString], {type: "image/svg+xml;charset=utf-8"});
        var url = DOMURL.createObjectURL(svg);

        img.onload = function() {
            ctx.drawImage(img, 0, 0);
            var png = canvas.toDataURL("image/png");
            var a  = document.createElement('a');
            a.href = png;
            a.download = fn + '.png';

            a.click()
        };
        
        img.src = url;
    }

    function fillFrontCard() {
        let classification = "{{ $data->classification_id }}";
        let color = "rgb(255, 255, 255)";
        
        if (classification == 1) {
            color = "rgb(0, 0, 0)";
        }
        let name = document.createElementNS("http://www.w3.org/2000/svg", "text");
        name.setAttribute("font-family", 'AbelRegular');
        name.setAttribute("font-size", '42px');
        name.setAttribute("x", 338);
        name.setAttribute("y", 124);
        name.setAttribute("fill", color);
        name.innerHTML = "{{ $data->lastname }}, {{ $data->firstname }} {{ $data->middlename }}";

        let birthdate = document.createElementNS("http://www.w3.org/2000/svg", "text");
        birthdate.setAttribute("font-family", 'AbelRegular');
        birthdate.setAttribute("font-size", '30px');
        birthdate.setAttribute("x", 338);
        birthdate.setAttribute("y", 264);
        birthdate.setAttribute("fill", color);

        let tmp = "{{ $data->birthdate }}";
        tmp = tmp.split('/');
        let str = '';
        for (var i in tmp) {
            if (str != '') str += ' / ';
            str += tmp[i];
        }

        birthdate.innerHTML = str;

        let code = document.createElementNS("http://www.w3.org/2000/svg", "text");
        code.setAttribute("font-family", 'AbelRegular');
        code.setAttribute("font-size", '30px');
        code.setAttribute("x", 338);
        code.setAttribute("y", 324);
        code.setAttribute("fill", color);
        code.innerHTML = "{{ $data->username }}";

        let img = document.getElementById("member-picture-1");
        let imgsrc = img ? img.src : '';

        getDataUri(imgsrc, function(dataUri) {
            $('#member-picture').attr('xlink:href', dataUri);
        });

        let svg = $('#member-card-front')[0];
        svg.appendChild(name);
        svg.appendChild(birthdate);
        svg.appendChild(code);
        
    }

    function fillBackCard() {
        let classification = "{{ $data->classification_id }}";
        let color = "rgb(255, 255, 255)";
        if (classification == 1) {
            color = "rgb(0, 0, 0)";
        }
        let code = document.createElementNS("http://www.w3.org/2000/svg", "text");
        code.setAttribute("font-family", 'AbelRegular');
        code.setAttribute("font-size", '42px');
        code.setAttribute("x", 446);
        code.setAttribute("y", 100);
        code.setAttribute("fill", color);
        code.innerHTML = "{{ $data->username }}";

        let text1 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        text1.setAttribute("font-family", 'AbelRegular');
        text1.setAttribute("font-size", '30px');
        text1.setAttribute("x", 450);
        text1.setAttribute("y", 150);
        text1.setAttribute("fill", color);
        text1.innerHTML = "Member account number.";

        let text2 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        text2.setAttribute("font-family", 'AbelRegular');
        text2.setAttribute("font-size", '30px');
        text2.setAttribute("x", 450);
        text2.setAttribute("y", 180);
        text2.setAttribute("fill", color);
        text2.innerHTML = "Scan QR code to get member details.";

        let sigsrc = $('#qrcode img').attr('src');

        getDataUri(sigsrc, function(dataUri) {
            $('#member-signature').attr('xlink:href', dataUri);
        });

        let svg = $('#member-card-back')[0];
        svg.appendChild(code);
        svg.appendChild(text1);
        svg.appendChild(text2);
    }
</script>