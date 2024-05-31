<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p><b>Date</b></p></td>
				        @foreach($size_list as $size)
				        <td><b>DF-{{$size}}</b></td>
				        @endforeach
				        <td><b>Grand Total</b></td>
				    </tr>
			    </thead>
			    <tbody>
			    	@php $grand_total = 0; $column_row_arr = []; @endphp
			    	@forelse($reportData as $key => $value)
			    		@php $row_total = 0; @endphp
    			    	<tr>
    						<td><p>{{\Carbon\Carbon::parse($key)->format('d-M-Y')}}</p></td>
    						 @foreach($size_list as $size)
			                 @if(isset($value[$size]))
    				         	<td>
    				         	{{$value[$size]}}
    				         	 @php
    				         	 	$row_total = $row_total + $value[$size];
    				         	 	if(isset($column_row_arr[$size])){
    				         	 		$column_row_arr[$size] = $column_row_arr[$size] + $value[$size];
    				         	 	}else{
    				         	 		$column_row_arr[$size] = $value[$size];
    				         	 	}
    				         	 @endphp
    				         	 </td>
    				         @else
    				         	<td>
    				         		@php
    				         			if(isset($column_row_arr[$size])){
    				         	 		$column_row_arr[$size] = $column_row_arr[$size] + 0;
    				         	 	}else{
    				         	 		$column_row_arr[$size] = 0;
    				         	 	}
    				         		@endphp
    				         		0
    				         	</td>
    				         @endif
				          	@endforeach
				          	 <td><b>{{$row_total}}</b></td>
    			    	</tr>



			    	 @empty
						<tr><td class="text-danger text-center" colspan="{{count($column_row_arr)+2}}"><b>No Complain Found.</b></td></tr>
			    	@endforelse
					@if(count($column_row_arr)>0)
			    	<tr>
			    	 	<td><b>Grand Total</b></td>
			    	 	@foreach($column_row_arr as $col_total)
			    	 		@php $grand_total = $grand_total + $col_total; @endphp
			    	 		<td><b>{{$col_total}}</b></td>
			    	 	@endforeach
			    	 	<td><b>{{$grand_total}}</b></td>
			    	 </tr>
			    	@endif

				</tbody>
			</table>
		</div>
    </div>
</div>

