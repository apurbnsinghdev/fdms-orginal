<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
    <link rel="stylesheet" href="{{ public_path().'/css/pdf.min.css' }}">
</head>
<body>
	<table id="main-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="10%">
                     <img class="img" src="{{ public_path().'/storage/images/'.$site_settings->logo }}" alt="logo">
                </th>
                <th width="90%">
                    <h1 class="header uppercase">{{ $site_settings->site_title or '' }}</h1>
                    <h3 class="sub-header">{{ $site_settings->address or '' }}</h3>
                    <div class="tel">Tel : {{ $site_settings->phone or ''}}</div>
                </th>
            </tr>
            <tr>
                <th colspan="2" class="header"><u>Gate Pass</u></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 10%">No: </span><span class="data no-border" style="width: 90%"><strong>{{ $reqisition->id or '' }}</strong></span></td>
                            <td width="30%"><span class="title" style="width: 16%">Date: </span><span class="data" style="width: 84%">&nbsp;&nbsp;{{ Carbon\Carbon::now() }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 28%">Name of Retailer/Distributor: </span><span class="data" style="width: 72%">&nbsp;&nbsp;@if ($reqisition->shop){{ $reqisition->shop->outlet_name or '' }}@endif</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 8%">Address: </span><span class="data" style="width: 92%">&nbsp;&nbsp;@if($reqisition->shop){{ preg_replace('!\s+!', ' ', $reqisition->shop->address)}}@endif</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 22%">Freezer Size: </span><span class="data" style="width: 78%">&nbsp;&nbsp;@if ($item->brand) {{ $item->brand->short_code or '' }}-@endif {{ $item->size->name or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 29%">Freezer Code: </span><span class="data" style="width: 71%">&nbsp;&nbsp;{{ $item->serial_no or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%">
                                <span class="title" style="width: 9%">Purpose: </span>
                                <span class="data" style="width: 91%">&nbsp;&nbsp;{{mystudy_case($reqisition->type)}}@if($reqisition->df_return_id)(Transfer)@endif</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 32%">ASM/RSM Name: </span><span class="data" style="width: 68%">@if(isset($reqisition->depot->user)){{$reqisition->depot->user->name}}@else &nbsp;&nbsp;@endif</span></td>
                            <td width="45%"><span class="title" style="width: 24%">ASE Name: </span><span class="data" style="width: 76%">&nbsp;&nbsp;{{$reqisition->user->name}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 45%">Delivery By Name & Designation: </span><span class="data" style="width: 55%">&nbsp;&nbsp;</span></td>
                            <td width="30%"><span class="title" style="width: 33%">Signature: </span><span class="data" style="width: 67%">&nbsp;&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 38%">Received By Retailer Name: </span><span class="data" style="width: 62%">&nbsp;&nbsp;</span></td>
                            <td width="30%"><span class="title" style="width: 33%">Signature: </span><span class="data" style="width: 67%">&nbsp;&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable last-table">
                        <tr>
                            <td width="70%"><span class="content">Store/FSD</span></td>
                            <td width="30%"><span class="content">Accounts</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br/>
<div class="col-xs-1 text-center">
   <h5 class="color-info">Note: This is a system generated gate pass, hence no approval signature is required.</h5>
</body>
</html>