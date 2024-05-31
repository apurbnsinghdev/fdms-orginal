@php
	$carbonObj = new \Carbon\Carbon;
@endphp
<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p><b>SL</b></p></td>
				        <td><p><b>Date</b></p></td>
				        <td><p><b>Name of Shop</b></p></td>
				        <td><p><b>Freezer Code</b></p></td>
				        <td><p><b>Inject Date</b></p></td>
				        <td><p><b>Used</b></p></td>
				        <td><p><b>Payment Status</b></p></td>
				        <td><p><b>Settlement Issue</b></p></td>
				        <td><p><b>Result</b></p></td>
				        <td><p><b>Region</b></p></td>
				        <td><p><b>Remarks</b></p></td>
				    </tr>
			    </thead>
			    <tbody>
			    	@forelse($reportData as $data)
			    		@php
			    			$closedDate = $carbonObj->parse($data->closed_date);
			    			$usedMonths = 0;
			    			if($closedDate->day > 15){
			    				$usedMonths = 1;
			    			}
			    			if($data->month_to){
			    				$usedMonths += $closedDate->diffInMonths($data->month_to);
			    			}else{
			    				$usedMonths += $closedDate->diffInMonths($data->inject_date);
			    			}

			    		@endphp
			    	<tr>
			    		<td>{{$loop->iteration}}</td>
			    		<td>{{$closedDate->format('Y-m-d')}}</td>
			    		<td>{{$data->outlet_name}}</td>
			    		<td>{{$data->serial_no}}</td>
			    		<td>{{$carbonObj->parse($data->inject_date)->format('Y-m-d')}}</td>
			    		<td>{{$usedMonths}} Months</td>
			    		<td>{{$data->receive_amount}}</td>
			    		<td>{{mystudy_case($data->status)}}</td>
			    		<td>{{$data->name}}</td>
			    		<td>{{$data->region_name}}</td>
			    		<td>{{$data->remarks}}</td>
			    	</tr>
			    	@empty
						<tr><td class="text-danger text-center" colspan="11"><b>No Complain Found.</b></td></tr>
			    	@endforelse
				</tbody>
			</table>
		</div>
    </div>
</div>

