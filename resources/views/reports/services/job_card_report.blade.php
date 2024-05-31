<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p><b>SL</b></p></td>
				        <td><p><b>Name of Technical</b></p></td>
				        <td><p><b>Technical Number</b></p></td>
				        <td><p><b>Depot</b></p></td>
				        <td><p><b>Month</b></p></td>
				        <td><p><b>No. of Complain Received</b></p></td>
				        <td><p><b>No. of Complain Done</b></p></td>
				        <td><p><b>Working Days</b></p></td>
				    </tr>
			    </thead>
			    <tbody>
			    	@forelse($reportData as $report)
			    	<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$report->technician->name}}</td>
						<td>{{$report->technician->mobile or ''}}</td>
						<td>{{$report->depot->name}}</td>
						<td>{{ date('F', mktime(0, 0, 0, $report->month, 10)) }}</td>
						<td>{{$report->no_of_assigned}}</td>
						<td>{{$report->no_of_completed}}</td>
						<td>{{$report->working_days}}</td>
					</tr>
			    	@empty
						<tr><td class="text-danger text-center" colspan="11"><b>No Job Card Found.</b></td></tr>
			    	@endforelse
				</tbody>
			</table>
		</div>
    </div>
</div>