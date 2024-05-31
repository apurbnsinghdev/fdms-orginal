@extends('layouts.admin')
@section('title', 'DF list for complain')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Services</a></li>
            <li><a>Service History</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-md-12 col-lg-12">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--HEADER INFO-->
        <div class="panel  project-detail">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12 p-project">

                        @php


                        $donutMonth = \Carbon\Carbon::parse($settlements->inject_date)->startOfDay()->diffInMonths();

                        $longevity_period = (int)$item->longevity_period*12;
                        $donutValue =  $donutMonth*100/$longevity_period;
                        if($donutValue >100){
                            $donutValue = 100;
                        }
                       @endphp
                         <div class="p-progress"><span class="donut">{{round($donutValue,2)}}/100</span><span class="value"> {{round($donutValue,2)}}%</span></div>
                        <div class="p-data">
                            <h5 class="p-name">{{$item->serial_no}}</h5>
                            <div class="p-update">First Injected Date: <span class="highlight">{{$settlements->inject_date->format('d-M-Y')}}</span></div>
                            <div class="p-status"><small>Brand:</small> <span class="badge x-info">{{$item->brand->name}}</span></div>
                            <div class="p-status"><small>Size:</small> <span class="badge x-info">{{$item->size->name}}</span>|</div>
                            <div class="p-deadline"><small>Used Month: </small><b>

                                {{\Carbon\Carbon::parse($settlements->inject_date)->startOfDay()->diffInMonths()}} Month
                            </b></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="col-md-12">
        <!--TIMELINE right-->
        <div class="timeline tl-right">
            <h4><span class="highlight">Service History</span> </h4>

            @foreach($dfproblems as $problem)
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-angle-up"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">{{ $problem->complain_types->pluck('problem_type')->pluck('name')->implode(',') }}</h4>

                   {{$problem->work_description}}

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Daily Serial</th>
                                <th>Token</th>
                                <th>Depot</th>
                                <th>Officer</th>
                                <th>Shop</th>
                                <th>Proprietor</th>
                                <th>Mobile</th>
                                <th>Receive Date</th>
                                <th>Technician</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$problem->daily_serial}}</td>
                                <td>{{$problem->token}}</td>
                                <td>{{$problem->depot->name}}</td>
                                <td>{{$problem->officer->name}}</td>
                                <td>{{$problem->outlet_name}}</td>
                                <td>{{$problem->proprietor_name}}</td>
                                <td>{{$problem->mobile}}</td>
                                <td>{{$problem->created_at->format('d-M-Y')}}</td>
                                <td>
                                    @if($problem->technician)
                                    {{$problem->technician->name}}

                                    @else
                                     Not Assigned
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="timeline-footer">
                    <span>Attain Date:
                    @if($problem->attain_date)
                        {{$problem->attain_date->format("d-M-Y")}}
                    @else
                        Not Attain Yet
                    @endif
                    </span> |
                    <span>Done Date:
                    @if($problem->done_date)
                        {{$problem->done_date->format("d-M-Y")}}
                    @else
                        Not Done Yet
                    @endif
                    </span> |
                    <span>Stattus:</span>
                    <span class="badge x-primary">{{$problem->status}}</span>
                </div>

            </div>
            @endforeach

        </div>
    </div>

        </div>
    </div>

</div>
@endsection
@section('script')
   <!--peity chart-->
    <script src="{{ asset('vendor/peity-chart/jquery.peity.min.js') }}"></script>
    <script>
        $(".donut").peity("donut", {
            radius: 45,
            innerRadius: 25,
            fill: function(value, i) {

                if (i == 0) {

                    if (value > 60) {
                        return "#d2322d";
                    } else if (value > 30) {
                        return '#fea223';
                    } else {
                        return '#88b93c';
                    }
                } else {
                    return '#ececec';
                }

            }
        })


    </script>
@stop

