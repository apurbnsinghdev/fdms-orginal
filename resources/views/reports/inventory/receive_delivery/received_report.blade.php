
<div class="panel">
	<div class="panel-content">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-bordered" cellspacing="0" cellpadding="0" align="left" >
				    <tr>

				        <td colspan="{{count($uniqueSizeArr)+2}}" align="center"><strong>DF Received Summery from {{$start_date}} to {{$end_date}}</strong></td>

				    </tr>
				    <tr>
				        <td><strong>Brand Name</strong></td>
				        @foreach ($uniqueSizeArr as $size=>$brand)
				        	<td>{{$brands->get($brand)}}</td>
				        @endforeach
				        <td rowspan="2"><strong>Total</strong></td>
				    </tr>
				    <tr>
				        <td><strong>DF Size</strong></td>
				        @foreach ($uniqueSizeArr as $size=>$brand)
				        	<td>{{$sizes->get($size)}}</td>
				        @endforeach

				    </tr>
				    <tr>
				        <td colspan="{{count($uniqueSizeArr)+1}}"><strong>Receive Date:</strong></td>
				        <td rowspan="{{$stocks->count()+1}}"><strong>&nbsp;</strong></td>
				    </tr>

				    @php
			        	$totalArr=[];
			        @endphp

				    @foreach ($stocks as $stock)
				    	@php
				    		$arr=$stock->stock_details->pluck('qty','size_id')->toArray();
				    	@endphp
					    <tr>
					        <td>{{$stock->invoice_date->format('d.m.Y') }}</td>
					        @foreach ($uniqueSizeArr as $key=>$val)
					        	@if (array_key_exists($key, $arr))

					        		@if (array_key_exists($key,$totalArr))
					        			@php
					        				$totalArr[$key] += $arr[$key];
					        			@endphp
					        		@else
					        			@php
					        				$totalArr[$key]= $arr[$key];
					        			@endphp
					        		@endif

					        		<td>{{$arr[$key]}}</td>
					        	@else
					        		<td>&nbsp;</td>
					        	@endif

					        @endforeach
					    </tr>
				    @endforeach

				    <tr>
				        <td><strong>Total Receive</strong></td>
				        @foreach ($totalArr as $ele)
				        	<th>{{$ele}}</th>
				        @endforeach
				        <td><strong>{{array_sum($totalArr)}}</strong></td>
				    </tr>
				</table>
			</div>
		</div>
    </div>
</div>