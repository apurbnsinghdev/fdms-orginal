<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p><b>SL</b></p></td>
				        <td><p><b>Year</b></p></td>
				        <td><p><b>Month</b></p></td>
				        @foreach($type_columns as $type)
				        <td><b>{{$type->name}}</b></td>
				        @endforeach
				        <td><p><b>Total</b></p></td>
				    </tr>
			    </thead>
			    <tbody>
			    	@forelse ($reportData as $key => $value)
			    		@foreach ($value as $k => $vl)
			    		@php
			    			$total = 0;
			    		@endphp
			    	<tr>
						<td><p>{{$loop->iteration}}</p></td>
				        <td><p>{{$key}}</p></td>
				        <td>
    				        <p>
    				        	@php
    				        	$monthNum  = $k;
								$monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); // March
    				        	@endphp
    				        {{$monthName}}
    				        </p>
				        </td>
				        @foreach($type_columns as $type)
							@if(isset($vl[$type->id]))
    				         	<td>{{$vl[$type->id]}}</td>
    				         	@php
			    					$total = $total + $vl[$type->id];
			    				@endphp
    				         @else
    				         	<td>0</td>
    				         @endif
				        @endforeach
				        <td>{{$total}}</td>
			    	</tr>
			    	 @endforeach
			    	@empty
						<tr><td class="text-danger text-center" colspan="{{$type_columns->count()+5}}"><b>No Complain Found.</b></td></tr>
			    	@endforelse
				</tbody>
			</table>
		</div>
    </div>
</div>

