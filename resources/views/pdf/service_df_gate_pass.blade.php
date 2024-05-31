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
                            <td width="70%"><span class="title" style="width: 10%">No: </span><span class="data no-border" style="width: 90%"><strong>{{$dfproblemObj->token}}</strong></span></td>
                            <td width="30%"><span class="title" style="width: 16%">Date: </span><span class="data" style="width: 84%">&nbsp;&nbsp;{{ Carbon\Carbon::now() }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 19%">Name of Retailer/Distributor: </span><span class="data" style="width: 81%">&nbsp;&nbsp;{{$dfproblemObj->outlet_name or ''}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 6%">Address: </span><span class="data" style="width: 94%">&nbsp;&nbsp;{{$dfproblemObj->address or ''}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                        	@php
                        		$size = $df_code = '';
                        		if($type == 'support'){
                        			$size = $item->brand->short_code.'-'.$item->size->name;
                        			$df_code = $item->serial_no;
                        		}else{
                        			if($dfproblemObj->df_code !='personal'){
                        				$size = $item->brand->short_code.'-'.$dfproblemObj->df_size;
                        			}else{
                        				$size = $dfproblemObj->df_size;
                        			}

                        			$df_code = $dfproblemObj->df_code;
                        		}
                        	@endphp
                            <td width="55%"><span class="title" style="width: 14%">Freezer Size: </span><span class="data" style="width: 86%">&nbsp;&nbsp;{{$size}}</span></td>
                            <td width="45%"><span class="title" style="width: 19%">Freezer Code: </span><span class="data" style="width: 81%">&nbsp;&nbsp;{{$df_code}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 6%">Purpose: </span><span class="data" style="width: 94%">&nbsp;&nbsp;{{$purpose}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="55%"><span class="title" style="width: 16%">RSM Name: </span><span class="data" style="width: 84%">&nbsp;&nbsp;</span></td>
                            <td width="45%"><span class="title" style="width: 16%">ASE Name: </span><span class="data" style="width: 84%">{{$dfproblemObj->officer->name}}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 28%">Delivery By Name & Designation: </span><span class="data" style="width: 72%">&nbsp;&nbsp;</span></td>
                            <td width="30%"><span class="title" style="width:22%">Signature: </span><span class="data" style="width: 78%">&nbsp;&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="70%"><span class="title" style="width: 24%">Received By Retailer Name: </span><span class="data" style="width: 76%">{{$dfproblemObj->proprietor_name or ''}}</span></td>
                            <td width="30%"><span class="title" style="width: 22%">Signature: </span><span class="data" style="width: 78%">&nbsp;&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable last-table">
                        <tr>
                            <td width="20%"><span class="content">Store</span></td>
                            <td width="25%"><span class="content">Acounts</span></td>
                            <td width="35%"><span class="content">Sales & Distrubution</span></td>
                            <td width="20%"><span class="content">Approved By</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>