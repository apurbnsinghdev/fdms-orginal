<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
body{
	margin:0;
}
td{
	padding:2px 5px;
	font-size:15px;
	line-height:13px;
	font-family:Arial, Helvetica, sans-serif;
	border:1px solid #000;
}
.no-left{ border-left:none}
.no-right{ border-right:none}
.claim{
    width:150px;
	padding:3px 5px;
	margin:3px auto 0;
	font-size:18px;
	line-height:22px;
	font-weight:bold;
	display:block;
	border:1px solid #000;
	border-radius:15px 15px 15px 15px;
}
.office{
    background-color:#000;
    color:#fff;
    width:150px;
	padding:3px 5px;
	margin:3px auto 0;
	font-size:18px;
	line-height:22px;
	font-weight:bold;
	display:block;
	border:1px solid #000;
	border-radius:15px 15px 15px 15px;
}
h1{
	padding:0;
	margin:0;
	font-size:26px;
	line-height:30px;
}
h2{
	padding:0;
	margin:0;
	font-size:18px;
	line-height:24px;
}
h2 span{
	padding-left:30px;
	margin:0;
	font-size:18px;
	line-height:24px;
	font-weight:normal;
}

</style>
</head>

<body>
	<div style="margin-top: 20px;"></div>
	@php

		$now = \Carbon\Carbon::now();
	@endphp
@for ($i = 0; $i < 2; $i++)
    <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin:0 auto;position: relative;width: 100%">
        <tr>
            <td class="no-right" rowspan="2" align="center">
            	<img style="width:100px;position: absolute;top: 25px;left: 10px" src="{{ public_path().'/storage/images/'.$site_settings->logo }}" alt="logo">
            </td>
            <td class="no-left" colspan="12" align="center">
            	@php
            		if($i == 0){
            			$titleCss = 'claim';
            			$title = 'CLAIM COPY';
            		}else{
            			$titleCss = 'office';
            			$title = 'OFFICE COPY';
            		}
            	@endphp

            	<div class="{{$titleCss}}">{{$title}}</div>
                <h1>{{ $site_settings->site_title or '' }}</h1>
                <span>{{ $site_settings->address or '' }}</span>
                <h2>Freeze Service Department <span>SI. No.- {{$dfProblem->token}}</span></h2>
            </td>
        </tr>
        <tr>
            <td colspan="3">Date: {{$now->format('d/m/Y')}}</td>
            <td colspan="3">Time: {{$now->format('h:i')}}</td>
            <td colspan="6">Area: {{$dfProblem->region->name}}</td>
        </tr>
        <tr>
            <td>Retailer Name:</td>
            <td colspan="12">&nbsp;{{$dfProblem->outlet_name}}</td>
        </tr>
        <tr>
            <td colspan="13" height="30">Address: {{$dfProblem->address}}</td>
        </tr>
        <tr>
            <td colspan="4">Freeze Size: {{$dfProblem->df_size}}</td>
            <td colspan="9">Code: {{$dfProblem->df_code}}</td>
        </tr>
        <tr>
            <td colspan="13" height="30">Problem: {{$dfProblem->df_problem}}</td>
        </tr>
        <tr>
            <td colspan="2" rowspan="4">Final Checking</td>
            <td colspan="3">Compressor:</td>
            <td colspan="3">Fan:</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">Thermostat:</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Wheel:</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="3">Glass:</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">Body Condition:</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Light:</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="5">Electric Connection:</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Relay, Overload:</td>
            <td colspan="4">&nbsp;</td>
            <td>Other:</td>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="13">Remarks:</td>
        </tr>
        <tr>
            <td colspan="6" valign="bottom" align="center" height="35">
            <p style="padding: 0;margin: 0">{{$dfProblem->technician->name}}</p>
            <p style="padding: 0;margin: 0">&nbsp;</p>
            Technician Name &amp; Signature
            </td>
            <td colspan="7" valign="bottom" align="center">
            <p style="padding: 0;margin: 0">&nbsp;</p>
            <p style="padding: 0;margin: 0">{{$dfProblem->mobile}}</p>
            Retailer Signature &amp; Cell No
            </td>
        </tr>
        <tr>
            <td colspan="13">Note: If Service is not satisfactory Please Contact the    following Cell No. 01709-816232, 01709-846233</td>
        </tr>
    </table>
    @if($i == 0)
    	<hr style="padding:0;margin:45px 0;border: 1px dotted #000;">
    @endif
@endfor


</body>
</html>
