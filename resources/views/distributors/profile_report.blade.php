<style>
table.tabBorder,
table.tabBorder td,
table.tabBorder th {
    border: 1px solid #778899;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 15px;
}

th, td {
    padding: 5px;
}
.outInfo{
    padding:0 0 5px;
    margin: 0;
    color: #fff;
    font-size: 18px;
    line-height: 24px;
    text-align: center;
    background: #2C5792;

}
.serviceInfo{
    padding:0 0 5px;
    margin: 0;
    color: #fff;
    font-size: 18px;
    line-height: 24px;
    text-align: center;
    background: #53803F;

}

table.tabBorder td.textRgt,
table.tabBorder th.textRgt{
    text-align: right;
}
.reHone{
    padding:0;
    margin: 0;
    font-size: 36px;
    line-height: 42px;
    text-align: center;
}
.reHfour{
    padding:0;
    margin: 0;
    font-size: 30px;
    line-height: 40px;
    text-align: center;
}
</style>

@if($profile && $profile->count()>0)
<table width="100%" class="table">
    <tr>
        <td>
            @if(isset($is_download) AND $is_download>0 )

            <img style="width:100px;left: 10px" src="{{ public_path().'/storage/images/'.$site_settings->logo }}" alt="Logo">
            @else
                <img style="width:100px;left: 10px" src="{{ asset('/storage/images/polar-ice-cream.png') }}" alt="Logo">
            @endif
        </td>
        <td>
            <h1 class="reHone" style="padding: 0; margin: 0; text-align: center;">Dhaka Ice Cream Industries Limited</h3>
            <h4 class="reHfour" style="padding:0; margin: 0; text-align: center;">Distributor Profile</h4>
        </td>
        <td><span>Today-{{ \Carbon\Carbon::now()->format('F d,Y')}}</span></td>
    </tr>
</table>



<table width="100%">
    <tr>
        <td width="45%">
            <table width="100%" class="tabBorder table table-bordered">
                <tr>
                    <th>Distributor ID</th>
                    <td>{{$profile->code}}</td>
                </tr>
                <tr>
                    <th>Distributor Name</th>
                    <td>{{$profile->outlet_name}}</td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td>
                        @if($profile->area)
                        {{$profile->area->name}}
                        @else
                            Not Exist
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>{{$profile->region->name}}</td>
                </tr>
            </table>
        </td>
        <td width="10%"></td>
        <td width="45%">
            <table width="100%" border="0" class="tabBorder table table-bordered">
                <tr>
                    <th>Proprietor</th>
                    <td>{{$profile->proprietor_name}}</td>
                </tr>
                <tr>
                    <th>Cell</th>
                    <td>{{$profile->mobile}}</td>
                </tr>
                <tr>
                    <th>Business Start</th>
                    <td>
                        @if(isset($profile->detail->business_startday))
                        {{$profile->detail->business_startday}}
                        @else
                        Not Exist
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Business Duration</th>
                    <td>
                        @if(isset($profile->detail->business_startday))
                        {{$profile->detail->business_startday}}
                        @else
                        Not Exist
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<h3 class="outInfo">Distributor's Information</h3>

<table class="tabBorder table table-bordered" width="100%">
        <tr style="background:#D7E1F1;">
            <th width="10%" class="textRgt">SL</th>
            <th width="20%">Title</th>
            <th idth="70%">&nbsp;</th>
        </tr>
        <tr>
            <td class="textRgt">1</td>
            <td>Proprietor</td>
            <td>
                @if($profile->proprietor_name)
                {{$profile->proprietor_name}}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">2</td>
            <td>Date Of Birth</td>
            <td>
                @if(isset($profile->detail->birthday))
                {{$profile->detail->birthday}}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">3</td>
            <td>Age</td>
            <td>
                @if(isset($profile->detail->birthday))
                {{ \Carbon\Carbon::parse($profile->detail->birthday)->diffInYears() }} Years
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">4</td>
            <td>Marital Status</td>
            <td>
                @if(isset($profile->detail->marital_status))
                {{ $profile->detail->marital_status }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">5</td>
            <td>Marriage Day</td>
            <td>
                @if(isset($profile->detail->marriage_day))
                {{ $profile->detail->marriage_day }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">6</td>
            <td>Spouse Name</td>
            <td>
                @if(isset($profile->detail->spouse_name))
                {{ $profile->detail->spouse_name }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">7</td>
            <td>Spouse Birthday</td>
            <td>
                @if(isset($profile->detail->spouse_birthday))
                {{ $profile->detail->spouse_birthday }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">8</td>
            <td>No. of Son</td>
            <td>
                @if(isset($profile->detail->son))
                {{ $profile->detail->son }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">9</td>
            <td>No. of Daughter</td>
            <td>
                @if(isset($profile->detail->daughter))
                {{ $profile->detail->daughter }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">10</td>
            <td>Father</td>
            <td>
                @if(isset($profile->detail->father_name))
                {{ $profile->detail->father_name }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">11</td>
            <td>Mother</td>
            <td>
                @if(isset($profile->detail->mother_name))
                {{ $profile->detail->mother_name }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">12</td>
            <td>Present Address</td>
            <td>
                @if(isset($profile->present_address))
                {{ $profile->present_address }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
        <tr>
            <td class="textRgt">13</td>
            <td>Permanent Address</td>
            <td>
                @if(isset($profile->parmanent_address))
                {{ $profile->parmanent_address }}
                @else
                Not Exist
                @endif
            </td>
        </tr>
    </table>

@else
<h2 class="section-subtitle text-danger text-center"> <b>{{$token}}</b> Profile Not Found</h2>

@endif









