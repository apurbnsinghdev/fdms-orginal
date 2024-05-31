<!DOCTYPE html>
<html>
<head>
<title>Dhaka Ice Cream</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="user-scalable=no, width=device-width, target-densityDpi=device-dpi" />
	@include('reports.services.token_report_css')
</head>
<body>
	@if($report && $report->count()>0)
		@include('reports.services.token_report')
	@else
	    <h2 class="section-subtitle text-danger text-center"> <b>{{$token}}</b> Token Not Found</h2>
	@endif
</body>
</html>