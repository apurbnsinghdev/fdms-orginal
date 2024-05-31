<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Payable Money Receipt</title>
    <link rel="stylesheet" href="{{ public_path().'/css/pdf.min.css' }}">
</head>
<body>
	@php
	$countMonth = $datas->month_from->diffInMonths($datas->closed_date);
	if ($datas->closed_date->day > 15 && $datas->month_from <= $datas->closed_date) {
		$countMonth = $countMonth + 1;
	}
	@endphp
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
                <th colspan="2" class="header"><u>Money Receipt</u></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%">
                                <span class="title" style="width: 15%">SL. No. : </span>
                                <span class="data no-border" style="width: 85%"><strong>{{ $datas->id or '' }}</strong></span>
                            </td>
                            <td width="30%"><span class="title" style="width: 16%">Date: </span><span class="data" style="width: 84%">&nbsp;&nbsp;{{ Carbon\Carbon::now()->format('M d, Y') }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 18%">Name of Customer: </span><span class="data" style="width: 82%">&nbsp;&nbsp;{{ $datas->outlet_name or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 8%">Address: </span><span class="data" style="width: 92%">&nbsp;&nbsp;{{ preg_replace('!\s+!', ' ', $datas->address)}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 22%">Freezer Size: </span><span class="data" style="width: 78%">&nbsp;&nbsp;{{ $datas->size or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 29%">Freezer Code: </span><span class="data" style="width: 71%">&nbsp;&nbsp;{{ $datas->serial_no or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
         
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 12%">Depot: </span><span class="data" style="width: 88%">&nbsp;&nbsp;{{ $datas->name or '' }}</span></td>
                            <td width="45%"><span class="title" style="width: 25%">Distributor: </span><span class="data" style="width: 75%">&nbsp;&nbsp;{{ $datas->distributor_name or '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="35%"><span class="title" style="width: 40%">Injected Date: </span><span class="data" style="width: 60%">&nbsp;&nbsp;{{ $datas->inject_date->format('M d, Y')}}</span></td>
                            <td width="35%"><span class="title" style="width: 35%">Closed Date: </span><span class="data" style="width: 65%">&nbsp;&nbsp;{{ $datas->closed_date->format('M d, Y')}}</span></td>
                            <td width="30%"><span class="title" style="width: 45%">Used Months: </span><span class="data" style="width: 55%">&nbsp;&nbsp;{{$countMonth}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="50%"><span class="title" style="width: 35%">Received Amount: </span><span class="data" style="width: 65%">&nbsp;&nbsp;TK. {{ $datas->receive_amount or '0' }}/-</span></td>
                            <td width="50%"><span class="title" style="width: 26%">Paid Amount: </span><span class="data" style="width: 74%">&nbsp;&nbsp;TK. {{ $datas->paid_amount or '0' }}/-</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable last-table">
                        <tr>
                            <td width="70%"><span class="content">Custommer's Signature</span></td>
                            <td width="30%"><span class="content">Authorized Signature</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>