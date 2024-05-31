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
    <div class="col-md-4">
        <h4 class="section-subtitle"><b>DF Status</b> At A Glance</h4>
        <div class="panel">
            @if ($items['purchased']>0)
                <div class="row dash-box-height fourBox">
                    <div class="col-md-6">
                        <a href="{{ route('inventories.itemIndex') }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Purchase</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{number_format($items['purchased'], 0)}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/purchase.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('inventories.itemIndex',['injected_dF']) }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Injected</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{number_format($items['injected'], 0)}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/inject.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('inventories.itemIndex') }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Stock</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{number_format($items['stock'], 0)}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/stock.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('inventories.itemIndex') }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">SIP</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{number_format($items['in_sip'],0)}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/in_sip.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <div class="dash-box-height">
                    <div class="manageHgt">
                        <a href="{{ route('inventories.itemIndex',['injected_dF']) }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Injected</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{number_format($items['injected'], 0)}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/inject.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="manageHgt">
                        <a href="{{ route('inventories.itemIndex') }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Stock</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{number_format($items['stock'], 0)}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/stock.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="manageHgt">
                        <a href="{{ route('inventories.itemIndex') }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">SIP</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{number_format($items['in_sip'],0)}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/in_sip.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
    <!-- ==============01 block end========== -->

    <!-- ==============02 block start========== -->
    <div class="col-md-4">
        <h4 class="section-subtitle hidden-sm hidden-xs">&nbsp;</h4>
        <div class="panel">
            <div class="dash-box-height">
                <div class="manageHgt">
                    <a href="{{ route('inventories.itemIndex',['support_dF']) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Support</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['support'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/support.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="manageHgt">
                    <a href="{{ route('inventories.itemIndex',['low_cooling_dF']) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Low Cooling</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['low_cooling'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/low_cooling.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="manageHgt">
                    <a href="{{ route('inventories.itemIndex') }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Damage</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['damage'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/damage.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ==============02 block end========== -->


    <!-- ==============03 block start========== -->
    <div class="col-md-4">
        <h4 class="section-subtitle hidden-sm hidden-xs">&nbsp;</h4>
        <div class="panel">
            <div class="dash-box-height">
                <div class="manageHgt">
                    <a href="{{ route('shops.index',[1]) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Distributors</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($shops['distributors'],0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/distributor.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="manageHgt">
                    <a href="{{ route('shops.index') }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Outlets</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($shops['retailers'],0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/outlet.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                @if ($stockReceive['primary']!==false)
                <div class="manageHgt">
                    <a href="{{ route('inventories.depotAllocatedStockIndex') }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Wait to Receive (Primary Stock)</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($stockReceive['primary'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/waittorecive.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if ($stockReceive['transfer']!==false)
                <div class="manageHgt">
                    <a href="{{ route('inventories.stockTransferLists') }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Wait to Receive (Transfer)</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($stockReceive['transfer'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/waittorecive.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>
    <!-- ==============03 block end========== -->


    @if ($depostDfStatus)
    <div class="col-md-4">
        <h4 class="section-subtitle"><b>DF STATUS:</b> DEPOT WISE </h4>
        @php
        	$depotDfStatus=['injected'=>0,'stock'=>0,'low_cooling'=>0,'support'=>0];
        @endphp
        <div class="panel">
            <div class="panel-content">
                <div class="widget-list list-left-element list-sm minwidth nano has-scrollbar">
                    <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                    @if(count($depostDfStatus))
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Depot</th>
                                    <th>Injected</th>
                                    <th>Stock</th>
                                    <th>Low Cooling</th>
                                    <th>Support</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($depostDfStatus as $key => $value)
                            	@php
                            		$newArr = array_merge($depotDfStatus,$value);
                            	@endphp
                                <tr>
                                    <td>{{$depots[$key]}}</td>
                                    @foreach($newArr as $k => $vl)
                                    <td>{{$vl}}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                     <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                        <li class="text-danger middle-align"> There is no inventory</li>
                     </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif


    <!-- ============payment verify secrion start=============== -->
    @if ($payment)
    <div class="col-md-4">
        <h4 class="section-subtitle"><b>Payment</b> Verify </h4>
        <div class="panel">
            <div class="panel-content">
                <div class="widget-list list-left-element list-sm  nano has-scrollbar">
                    <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                     @if($payment->count())
                     @foreach($payment as $value)
                        <li>
                            <a href="{{ route('requisitions.payment_verify',[$value->id]) }}">
                                <div class="left-element">{{mystudy_case($value->payment_methods)}}</div>
                                <div class="text">
                                    <span class="title">{{$value->receive_amount}}Tk (@if($value->shop){{$value->shop->outlet_name}}@endif)</span>
                                    <span>&nbsp;&nbsp;Verify</span>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    @else
                    <li class="text-danger middle-align"> There is no payment for verify</li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- =============payment verify secrion end=============== -->


    <!-- ==========bkash verify secrion start============== -->
    @if ($bkash)
    <div class="col-md-4">
        <h4 class="section-subtitle"><b>bKash</b> payment verify </h4>
        <div class="panel">
            <div class="panel-content">
                <div class="widget-list list-left-element list-sm nano has-scrollbar">
                    <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                     @if($bkash->count())
                     @foreach($bkash as $value)
                        <li>
                            <a href="{{ route('requisitions.bkash_verify',[$value->id]) }}">
                                <div class="left-element">{{$value->payment_methods}}</div>
                                <div class="text">
                                    <span class="title">{{$value->receive_amount}}Tk (@if($value->shop){{$value->shop->outlet_name}}@endif)</span>
                                    <span>&nbsp;&nbsp;Verify</span>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    @else
                    <li class="text-danger middle-align"> There is no bKash payment for verify</li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- =========bkash verify secrion end============== -->

    <!-- ===========Requistion secrion strat========= -->
    <div class="col-md-4">
        <h4 class="section-subtitle"><b>Requisition</b> Status </h4>
        <div class="panel">
            <div class="row dash-box-height fourBox">
                @foreach ($requisitions as $key=>$val)
                    <div class="col-md-6">
                        <a href="{{ route('requisitions.index',[$key]) }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">
                                    @if ($key=='new')
                                       Pending
                                    @else
                                        {{ mystudy_case($key) }}
                                    @endif
                                </h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{$val}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/'.$key.'.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ===========Requistion secrion end========= -->


    <div class="col-md-4">
        <h4 class="section-subtitle"><b>Regional</b> DF Status</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="widget-list list-left-element list-sm nano has-scrollbar">
                    <div style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                         <canvas id="bar-chart" width="400" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@include('common_pages.common_modal',['modalTitle'=>'Requisition Details'])

@endsection
@section('css')
<style>
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
.fourBox .dash-box-heightIn{padding:29px 10px; }
.fourBox>div:nth-child(odd){
    padding-right: 5px;

}
.fourBox>div:nth-child(even){
    padding-left: 5px;

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
@media only screen and (max-width: 640px) {
    .dash-box-height{height: auto;}
    .fourBox>div:nth-child(odd){padding-right:15px;}
    .fourBox>div:nth-child(even){padding-left:15px;}
    .fourBox .dash-box-heightIn{padding:9px 10px;}
}
</style>
@stop
@section('script')
    <!--morris chart-->
    <!--Gallery with Magnific popup-->
    <script src="{{ asset('js/examples/dashboard.js') }}"></script>
    <script src="{{ asset('vendor/chart-js/chart.min.js') }}"></script>
    <script>
    //BAR CHART EXAMPLE
    /*==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/
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
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
            {
                label: "Stock",
                fill: true,
                backgroundColor: "rgba(0, 145, 123, 1)",
                borderColor: "rgba(0, 145, 123, 1)",
                data: [14, 15, 13, 13, 12]
            },
            {
                label: "Injected",
                fill: true,
                backgroundColor: "rgba(181, 223, 187, 1)",
                borderColor: "rgba(181, 223, 187, 1)",
                data: [12, 13, 11, 6, 9]
            }
        ],
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
    </script>

@stop