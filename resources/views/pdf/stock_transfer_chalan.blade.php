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
                <th colspan="2" class="header"><u>Chalan Copy</u></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable">
                        <tr>
                            <td width="40%"><span class="title">From Depot: </span><span class="data no-border"><strong>{{$transferData->from_depot}}</strong></span></td>

                            <td width="40%"><span class="title">To Depot: </span><span class="data no-border"><strong>{{$transferData->to_depot}}</strong></span></td>
                            <td width="20%"><span class="title">Date: </span><span class="data no-border"><strong>{{$transferData->created_at->format('d.M.Y')}}</strong></span></td>
                        </tr>
                        <tr>
                            <td width="100%" colspan="3"><span class="title">Total Quantity: </span><span class="data no-border"><strong>{{$transferData->placed_qty}}</strong></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="subtable" border="1">
                        <tr>
                            <th width="33%"><span class="title">Brand: </span>
                            </th>
                            <th width="33%"><span class="title">Size: </span>
                            </th>
                            <th width="33%"><span class="title">Quantity: </span>
                            </th>
                        </tr>
                        @foreach($transferData->stock_transfer_details as $ele)
                        <tr>
                            <td>
                                <span >&nbsp;&nbsp;{{$ele->brand->short_code}}</span>
                            </td>
                            <td>
                                <span>&nbsp;&nbsp;{{$ele->size->name}}</span>
                            </td>
                            <td>
                                <span>&nbsp;&nbsp;{{$ele->placed_qty}}</span>
                            </td>
                        </tr>
                        @endforeach
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