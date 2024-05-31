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
                <th colspan="2" class="header"><u>fBfaten Pass</u></th>
            </tr>
        </thead>
        <tbody>
             
        </tbody>
    </table>
</body>
</html>