<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p>SL</p></td>
				        <td><p>Division</p></td>
				        <td><p>District</p></td>
				        <td><p>Thana</p></td>
				        <td><p>Depot Name</p></td>
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

			    	@foreach($locations as $location)
				    	@php
			    		$iteration = 	$loop->iteration;
			    		$division = 	$location->name;
						@endphp

						@foreach($location->children as $loc)
							@php
							$rspan = $loc->children->count();
				    		$district = 	$loc->name;
							@endphp

							@if($loop->first)
								@foreach ($loc->children as $l)
									@if($loop->first)
									<tr>
								        <td rowspan="{{$rowspans[$location->id]}}"><p>{{$iteration}}</p></td>
								        <td rowspan="{{$rowspans[$location->id]}}"><p>{{$division}}</p></td>
								        <td rowspan="{{$rspan}}"><p>{{$district}}</p></td>
										<td><p>{{$l->name}}</p></td>
										@if($depots->has($l->id))
											<td><p>{{$depots->get($l->id)}}</p></td>
										@else
											<td><p>&nbsp;</p></td>
										@endif
								    </tr>
								    @else
									<tr>
										<td><p>{{$l->name}}</p></td>
										@if($depots->has($l->id))
											<td><p>{{$depots->get($l->id)}}</p></td>
										@else
											<td><p>&nbsp;</p></td>
										@endif
									</tr>
								    @endif
							    @endforeach
						    @else

								@foreach ($loc->children as $l)
								<tr>
									@if($loop->first)
									<td rowspan="{{$rspan}}"><p>{{$district}}</p></td>
									<td><p>{{$l->name}}</p></td>
									@if($depots->has($l->id))
											<td><p>{{$depots->get($l->id)}}</p></td>
										@else
											<td><p>&nbsp;</p></td>
										@endif
									@else
									<td><p>{{$l->name}}</p></td>
						         	@if($depots->has($l->id))
											<td><p>{{$depots->get($l->id)}}</p></td>
										@else
											<td><p>&nbsp;</p></td>
										@endif
						         	@endif
						        </tr>
						        @endforeach
						    @endif
					    @endforeach
				    @endforeach

				</tbody>
			</table>
		</div>
    </div>
</div>

