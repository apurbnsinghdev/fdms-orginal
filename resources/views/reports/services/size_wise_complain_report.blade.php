<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p><b>SL</b></p></td>
				        <td><p><b>Year</b></p></td>
				        <td><p><b>Month</b></p></td>
				        @foreach($size_list as $size)
				        <td><b>DF-{{$size}}</b></td>
				        @endforeach
				        <td><p><b>Total</b></p></td>
				    </tr>
			    </thead>
			    <tbody>
			    	@php
			    			$l = 1;
			    	@endphp
			    	@forelse ($reportData as $key => $value)

			    		@foreach ($value as $k => $vl)
			    		@php
			    			$total = 0;
			    		@endphp
			    	<tr>
						<td><p>{{$l++}}</p></td>
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
				         @foreach($size_list as $size)
    				         @if(isset($vl[$size]))
    				         	<td>{{$vl[$size]}}</td>
    				         	@php
			    					$total = $total + $vl[$size];
			    				@endphp
    				         @else
    				         	<td>0</td>
    				         @endif
				         @endforeach
				         <td>{{$total}}</td>
			    	</tr>
			    	 @endforeach
			    	@empty
						<tr><td class="text-danger text-center" colspan="{{ count($size_list)+4}}"><b>No Complain Found.</b></td></tr>
			    	@endforelse
				</tbody>
			</table>
		</div>
    </div>
</div>

