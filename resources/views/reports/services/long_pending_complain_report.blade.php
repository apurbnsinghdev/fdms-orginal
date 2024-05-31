<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <th>SL</th>
				        <th>Token</th>
				        <th>DF Code</th>
				        <th>DF Size</th>
				        <th>Duration</th>
				        <th>Problem Type</th>
				        <th>Outlet</th>
				        <th>Depot</th>
				        <th>Region</th>
				        <th>Remarks</th>
				        <th>Status</th>
				    </tr>
			    </thead>
			    <tbody>
			    	@forelse ($reportData as $report)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$report->token}}</td>
							<td class="text-capitalize">{{$report->df_code}}</td>
							<td>{{$report->df_size}}</td>
							<td>{{$report->duration}} Day</td>
							<td>{{ $report->complain_types->pluck('problem_type')->pluck('name')->implode(',') }}</td>
							<td>{{$report->outlet_name }}</td>
							<td>{{$report->depot->name??''}}</td>
							<td>{{$report->region->name??''}}</td>
							<td>{{$report->comments}}</td>
							<td class="text-capitalize">{{$report->status}}</td>
						</tr>

			    	@empty
						<tr><td class="text-danger text-center" colspan="11"><b>No Data Found.</b></td></tr>
			    	@endforelse
				</tbody>
			</table>
		</div>
    </div>
</div>

