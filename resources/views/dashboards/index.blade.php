@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInUp">

    <!-- ==============01 block start========== -->
        @include('dashboards.sections.block_one')
    <!-- ==============01 block end========== -->

    <!-- ==============02 block start========== -->
        @include('dashboards.sections.block_two')
    <!-- ==============02 block end========== -->

    <!-- ==============03 block start========== -->
         @include('dashboards.sections.block_three')
    <!-- ==============03 block end========== -->

    <!-- ==============Depot wise DF Status block start========== -->
    @if ($depostDfStatus !== false)
         @include('dashboards.sections.block_depot_wise_df_status')
    @endif
    <!-- ==============Depot wise DF Status block end========== -->

    <!-- ===========Map Block strat========= -->
        @include('dashboards.sections.block_map')
    <!-- ============Map Block end========= -->

    <!-- ============payment verify secrion start=============== -->
    @if ($payment !== false)
         @include('dashboards.sections.block_payment')
    @endif
    <!-- =============payment verify secrion end=============== -->


    <!-- ==========bkash verify secrion start============== -->
    @if ($bkash !== false)
         @include('dashboards.sections.block_bkash')
    @endif
    <!-- =========bkash verify secrion end============== -->

    <!-- ===========Requistion secrion strat========= -->
    @if ($requisitions !== false)
        @include('dashboards.sections.block_requisition')
    @endif
    <!-- ===========Requistion secrion end========= -->

    <!-- ===========Regional DF status strat========= -->
    @if ($regionalDfStatus !== false)
        @include('dashboards.sections.block_regional_df_status')
    @endif
    <!-- ===========Regional DF status end========= -->


    <!-- ===========Return Block strat========= -->
    @if ($df_returns !== false)
        @include('dashboards.sections.block_return')
    @endif
    <!-- ============Return Block end========= -->

    <!-- ===========Complain Block strat========= -->
    @if ($complainStatus !== false)
        @include('dashboards.sections.block_complain')
    @endif
    <!-- ============Complain Block end========= -->

    <!-- ===========Damage Block strat========= -->
    @if ($damage_applications !== false)
        @include('dashboards.sections.block_damage')
    @endif
    <!-- ============Damage Block end========= -->

    <!-- ===========bKash mercant block========= -->
        @include('dashboards.sections.bKash_merchant')
    <!-- ============bKash mercant block========= -->


</div>

@include('common_pages.common_modal',['modalTitle'=>'Requisition Details'])

@endsection
@section('css')
<style type="text/css">
/* ===================map css start =======*/
	.st0{fill-opacity:0;stroke:#000000;}
	.st1{fill:none;stroke:#024C43;stroke-width:3.125;stroke-opacity:0.9922;stroke-dasharray:25,6.25,3.125,6.25;}
	.st2{fill:none;stroke:#000000;}
	.st3{fill:none;}
	.st4{fill:#FFE000;stroke:#FFFFFF;stroke-width:2;}
	.st5{fill:#FFE000;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
	.st6{fill:#FFFF00;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
	.st7{fill:#FFFF00;stroke:#FFFFFF;stroke-width:2;}
	.st8{opacity:0.5;enable-background:new    ;}
	.st9{fill:#FFFFFF;}
	.st10{font-family:'Arial-BoldMT';}
	.st11{font-size:50px;}
	.st12{font-size:40px;}
	.st13{font-family:'ArialMT';}
	.st14{font-size:24px;}
	.st15{fill:#FF0000;}
	.st16{fill:#FF0000;stroke:#FFFFFF;stroke-width:2;}
	.st17{fill:#FF0000;stroke:#FFFFFF;stroke-width:0.75;}
	.st18{fill:#FF0000;stroke:#FFFFFF;stroke-width:0.5;}
	.st19{fill:#EE82EE;stroke:#FFFFFF;stroke-width:2;}
	.st20{fill:#008000;}
	.st21{fill:#008000;stroke:#FFFFFF;stroke-width:3;}
	.st22{fill:#008000;stroke:#FFFFFF;stroke-width:2;}
	.st23{fill:#FFA500;stroke:#FFFFFF;stroke-width:2;}
	.st24{fill:#000080;stroke:#FFFFFF;stroke-width:2;}
	.st25{fill:#000080;stroke:#FFFFFF;stroke-miterlimit:10;}
	.st26{fill:#000080;stroke:#FFFFFF;stroke-width:0.5;}
	.info{transition:all 500ms; opacity:0;}
	.infoWrap{cursor:pointer}
	.infoWrap:hover .info{opacity:1}

 /* ===================map css end =======*/
.dash-box-height{
    height:262px;
    padding: 10px 10px 0;
}
.dash-box-height-2{
    height:238px;
}
.widget-list.list-left-element.minwidth .left-element {
    min-width: 80px !important;
}
.nano > .nano-content.dashboard{
    position: relative !important;
}
.dropup, .dropdown{
    display: inline-block;
}
.dropdown-menu{
    right: 0;
    left:auto;
}
.middle-align{
    position:absolute;
    width: 100%;
    text-align: center;
    font-size: 18px;
    top:50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

   /* -------------------- */
.dash-box-height h4{
    padding: 0;
    margin:0;
}
.dash-box-height h5{
    padding:10px 0 0;
    margin:0;
    font-size: 20px;
    line-height:26px;
}
.dash-box-heightIn {
    padding:10px;
    margin-bottom:8px;
    position: relative;
    height:calc(100% - 9px);
    background-color: #ededed;
}
   /* ---------------------------------- */

.manageHgt a{
    display: block;
    height:100%;

}
.dash-box-heightIn img{ height: 40px; }
.mild{
    width:100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
.manageHgt:first-child:nth-last-child(1) {
  height: 100%;
}

/* two items */
.manageHgt:first-child:nth-last-child(2),
.manageHgt:first-child:nth-last-child(2) ~ .manageHgt {
  height: 50%;
}

/* three items */
.manageHgt:first-child:nth-last-child(3),
.manageHgt:first-child:nth-last-child(3) ~ .manageHgt {
  height: 33.3333%;
}

/* four items */
.manageHgt:first-child:nth-last-child(4),
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt {
  height: 25%;
}

/* five items */
.manageHgt:first-child:nth-last-child(5),
.manageHgt:first-child:nth-last-child(5) ~ .manageHgt {
  height: 20%;
}
.manageHgt .col-md-6,
.manageHgt .col-sm-6,
.manageHgt .col-xs-6,
.manageHgt .row{ height: 100% }
.fourBox .dash-box-heightIn{padding:10px 10px; }
.fourBox .subtitle{
    padding-bottom:38px;
}
.fourBox>div:nth-child(odd){
    padding-right: 5px;

}
.fourBox>div:nth-child(even){
    padding-left: 5px;

}
.six-box .row>div:first-child{
    padding-right: 5px;
}
.six-box .row>div:last-child{
    padding-left: 5px;
}
.six-box h4{
    padding-bottom:10px;
    font-size: 12px;
}
.six-box img{
    height:24px;
    margin-top: 7px;
}

.manageHgt:first-child:nth-last-child(4) .subtitle,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt .subtitle{
    font-size: 12px;

}
.manageHgt:first-child:nth-last-child(4) .title,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt .title{
    font-size: 14px;
    padding:0;
}
.manageHgt:first-child:nth-last-child(4) img,
.manageHgt:first-child:nth-last-child(4) ~ .manageHgt img{
    height: 24px;
}
#bar-chart{
    height:240px !important;
}
@media only screen and (max-width: 640px) {
    .dash-box-height{height: auto;}
    .fourBox>div:nth-child(odd),
    .six-box .row>div:first-child{padding-right:15px;}
    .fourBox>div:nth-child(even),
    .six-box .row>div:last-child{padding-left:15px;}
    .fourBox .dash-box-heightIn{padding:9px 10px;}
    .six-box h4,
    .fourBox .subtitle{ padding-bottom:0; }

}
</style>
@stop
@section('script')
    <!--Gallery with Magnific popup-->
    <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    {{-- <script src="{{ asset('js/examples/dashboard.js') }}"></script> --}}
    <script src="{{ asset('vendor/chart-js/chart.min.js') }}"></script>
    <script>
    //BAR CHART EXAMPLE
    /*==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
@if ($regionalDfStatus)
    var barData = {!!$regionalDfStatus['data']!!};
    var colorData = {!!$regionalDfStatus['colors']!!};
    var barOptionsDataObj = [];
    for (var key in barData) {

    	var barOptionsData = {};
    	barOptionsData.label = key;
    	barOptionsData.fill = true;
    	barOptionsData.backgroundColor = colorData[key]['backgroundColor'];
    	barOptionsData.borderColor = colorData[key]['borderColor'];
    	barOptionsData.data = barData[key];
    	barOptionsDataObj.push(barOptionsData);
    }
    var bar = document.getElementById("bar-chart");
    var options ={
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        };

    var dataBars = {
        labels: {!!$regionalDfStatus['regions']!!},
        datasets: barOptionsDataObj,
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            }
        }
    };

    var barChar = new Chart(bar, {
        type: 'horizontalBar',
        data: dataBars,
        options: options

    });
@endif

    function getDetails(id){
         var modalBody=$('#modal-body');
          modalBody.css('padding-top',0);
          modalBody.html('');
         $.get(laravelObj.appHost+"/get-requisition-details/"+id, function(data, status){
             //$('#modal-title').html('Requisition Details');
             modalBody.html(data);
          });
        $('#common-modal').modal('show');
      }

    $('.gallery-wrap').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        },
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-with-zoom',
        zoom: {
            enabled: true,
            duration: 300
        }
    });
</script>



@stop