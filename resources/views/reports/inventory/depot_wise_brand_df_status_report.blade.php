<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p>SL</p></td>
				        <td><p>Depot</p></td>
				        <td><p>Distributor</p></td>
				        @php
				        	$brand_id=null;
				        @endphp
				        @foreach ($brandSizes as $brand)
				        	@php
				        		if($brand_id == null){
				        			$brand_id = $brand->brand_id;
				        			$brand_code = $brand->brand_code;
				        		}elseif($brand_id != $brand->brand_id){
				        			$brand_id = null;
				        		}

				        	@endphp
				        	@if($brand_id==null)
				        		<td><p><strong>Total - {{$brand_code}}</strong></p></td>
				        		@php
				        			$brand_id = $brand->brand_id;
				        			$brand_code = $brand->brand_code;
				        		@endphp
				        	@endif
				        <td><p>{{$brand->brand_code}}- {{$brand->size_name}}</p></td>

				        @if($loop->last)
						<td><p><strong>Total - {{$brand->brand_code}}</strong></p></td>
				        @endif

				        @endforeach
				        <td><p><strong>Total DF<strong></p></td>
				    </tr>
			    </thead>
			    <tbody>
			    	@foreach ($depotDistributors as $dd)
			    		@php
			    		$iteration = 	$loop->iteration;
			    		$depot = 	$dd->name;
			    		$rowspan = $dd->distributors->count();
						@endphp

						@foreach ($dd->distributors as $element)
							@if($loop->first)
							<tr>
							        <td rowspan="{{$rowspan}}"><p>{{$iteration}}</p></td>
							        <td rowspan="{{$rowspan}}"><p>{{$depot}}</p></td>
						        	<td><p>{{$element->outlet_name}}</p></td>
						    </tr>
						    @else
							<tr>
						        	<td><p>{{$element->outlet_name}}</p></td>
						    </tr>
						    @endif
						@endforeach
			    	@endforeach

				</tbody>
			</table>
		</div>
    </div>
</div>

