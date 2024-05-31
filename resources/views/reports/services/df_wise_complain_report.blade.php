<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <th>DF Code</th>
				        @foreach ($totalProblemTypes as $problemTypeId=>$name)
				        	<th>{{$problemTypes->get($problemTypeId)}}</th>
				        @endforeach
				        <th>Grand Total</th>
				    </tr>
			    </thead>
			    <tbody>
			    	@forelse($problems as $dfCode=>$typeArr)
			    	<tr>
						<td>{{$dfCode}}</td>
				        @php
				        	$grandTotal = 0;
				        	$Arr =array_replace($totalProblemTypes, $typeArr);
				        @endphp
				        @foreach ($Arr as $no_of_problem)
					        @php
					        	$grandTotal += $no_of_problem;
					        @endphp
				        	<td>{{$no_of_problem}}</td>
				        @endforeach
				        <td><strong>{{$grandTotal}}</strong></td>
			    	</tr>
			    	@empty
						<tr><td class="text-danger text-center" colspan="{{count($problems)+6}}"><b>No Complain Found.</b></td></tr>
			    	@endforelse
				</tbody>
			</table>
		</div>
    </div>
</div>