<table width="100%" class="table">
    <tr>
        <td>
            @if($isDownload)
                <img style="width:100px;left: 10px" src="{{ public_path().'/storage/images/'.$site_settings->logo }}" alt="Logo">
            @else
                <img style="width:100px;left: 10px" src="{{ asset('/storage/images/polar-ice-cream.png') }}" alt="Logo">
            @endif
        </td>
        <td>
            <h1 class="reHone" style="padding: 0; margin: 0; text-align: center;">Dhaka Ice Cream Industries Limited</h3>
            <h4 class="reHfour" style="padding:0; margin: 0; text-align: center;">Freeze Service Department</h4>
        </td>
        <td><span>Today-{{ \Carbon\Carbon::now()->format('F d,Y')}}</span></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td width="45%">
            <table width="100%" class="tabBorder table table-bordered">
                <tr>
                    <th>Token Number</th>
                    <td>{{$report->token}}</td>
                </tr>
                <tr>
                    <th>DF Code</th>
                    <td>{{$report->df_code}}</td>
                </tr>
                <tr>
                    <th>DF Size</th>
                    <td>{{$report->df_size}}</td>
                </tr>
                <tr>
                    <th>Problem/Complain</th>
                    <td>{{$report->df_problem}}</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
        <td width="45%">
            <table width="100%" border="0" class="tabBorder table table-bordered">
                <tr>
                    <th>Region</th>
                    <td>{{$report->region->name}}</td>
                </tr>
                <tr>
                    <th>Depot</th>
                    <td>{{$report->depot->name}}</td>
                </tr>
                <tr>
                    <th>Receive Date</th>
                    <td>{{$report->created_at->format('d-M-Y')}}</td>
                </tr>
                <tr>
                    <th>Input Time</th>
                    <td>{{$report->created_at->format('H:ia')}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<h3 class="outInfo">Outlet Information</h3>
<table class="tabBorder table table-bordered" width="100%">
    <tr style="background:#D7E1F1;">
        <th width="10%" class="textRgt">SL</th>
        <th width="20%">Title</th>
        <th idth="70%">&nbsp;</th>
    </tr>
    <tr>
        <td class="textRgt">1</td>
        <td>Outlet Name</td>
        <td>{{$report->outlet_name}}</td>
    </tr>
    <tr>
        <td class="textRgt">2</td>
        <td>Outlet Mobile</td>
        <td>{{$report->mobile}}</td>
    </tr>
    <tr>
        <td class="textRgt">3</td>
        <td>Address</td>
        <td>
            @if($report->address)
            {{$report->address}}
            @else
                {{$report->depot->address}}

            @endif
        </td>
    </tr>
    <tr>
        <td class="textRgt">4</td>
        <td>Depot</td>
        <td>{{$report->depot->name}}</td>
    </tr>
</table>

<h3 class="serviceInfo">Service Department Information</h3>
<table class="tabBorder table table-bordered" width="100%">
    <tr style="background: #A6CD91;">
        <th width="10%" class="textRgt">SL</th>
        <th width="20%">Title</th>
        <th width="70%">&nbsp;</th>
    </tr>
    <tr>
        <td class="textRgt">1</td>
        <td>Name of Technical</td>
        <td>
            @if($report->technician)
                {{$report->technician->name}}
            @else
                Not Assigned
            @endif
        </td>
    </tr>
    <tr>
        <td class="textRgt">2</td>
        <td>Work Description</td>
        <td>
            @if($report->work_description)
            {{$report->work_description}}
            @else
                NA
            @endif
        </td>
    </tr>
    <tr>
        <td class="textRgt">3</td>
        <td>Status</td>
        <td>{{ucfirst($report->status)}}</td>
    </tr>
    <tr>
        <td class="textRgt">4</td>
        <td>Attain Date</td>
        <td>
            @if($report->attain_date)
            {{$report->attain_date->format('d-M-y')}}
            @else
            Not Attained Yet
            @endif
        </td>
    </tr>
    <tr>
        <td class="textRgt">5</td>
        <td>Done Date</td>
        <td>
            @if($report->done_date)
            {{$report->done_date->format('d-M-y')}}
            @else
                Not Done Yet
            @endif
        </td>
    </tr>
    <tr>
        <td class="textRgt">6</td>
        <td>Duration</td>
        <td>
            @if($report->done_date)
            {{

                $report->done_date->diffInDays($report->created_at)
            }}
            @else
                {{$report->created_at->diffInDays(\Carbon\Carbon::now())}}
            @endif
            Day
        </td>
    </tr>
    <tr>
        <td class="textRgt">7</td>
        <td>Team Leader</td>
        <td>
            @if($report->teamleader_id)
                 {{$report->teamleader->name}}
            @else
                Not Assigned
            @endif

        </td>
    </tr>

    <tr>
        <td class="textRgt">8</td>
        <td>Team Leader Mobile</td>
        <td>
            @if($report->teamleader_id)
                {{$report->teamleader->mobile}}
            @else
            Not Available
            @endif
        </td>
    </tr>
</table>










