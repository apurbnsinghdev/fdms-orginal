      <div class="panel">
			<div class="panel-content">
				<div class="table-responsive">
				    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">

				    	<thead class="table-primary">
						    <tr>
						        <td><p>SL</p></td>
						        <td><p>Depot Name</p></td>
						        <td><p>Delar Name</p></td>
						        @foreach ($selectedSizes as $size)
						        <td><p>{{ $size }} Liter</p></td>
						        @endforeach
						        <td><p>Total DF</p></td>
						    </tr>
					    </thead>
					    <tbody>
					    	@php

					    	$groupedDistributor = $items->mapWithKeys(function ($item, $key) {
            return [$item['distributor_id'] => $item['outlet_name']];
        });
							$depotGrouped = $items->groupBy('depot_id');
							@endphp

							@foreach ($depots as $key=>$val)
								@if($depotGrouped->has($key))
									@php
									$distributors = $depotGrouped->get($key)->groupBy('distributor_id');
									$countDepotDistributor = $distributors->count();
									$index = $loop->iteration;

									@endphp

									@foreach ($groupedDistributor as $key=>$distributor)

										@if($loop->iteration == 1)
										<tr>
							        		<td rowspan="{{$countDepotDistributor}}"><p>{{$index}}</p></td>
							        		<td rowspan="{{$countDepotDistributor}}"><p>&nbsp;</p>
							            		<p>{{$val}}</p>
							            	</td>
							            	@php
							            	$distribMapKeys = collect([]);
							            	if($distributors->has($key)){
												$distrib = $distributors->get($key);

												$distribMapKeys = $distrib->mapWithKeys(function ($item, $key) {
									                return [$item['size_id'] => $item['totalSize']];
									            });


											}
								            $subTotal = 0;
											@endphp
							            	<td><p>{{$distributor}}</p></td>
							            	@foreach ($selectedSizes as $key=>$size)
								        		@if($distribMapKeys->has($key))
								        		@php
								        			$totalSize = $distribMapKeys->get($key);
								        			$subTotal = $subTotal +$totalSize;
								        		@endphp
								        		<td><p>{{$totalSize}}</p></td>
								        		@else
												<td><p>&nbsp;</p></td>
								        		@endif
								        	@endforeach
								        	<td><p>{{$subTotal}}</p></td>
										</tr>
										@else
										<tr>
											@php
											$distribMapKeys = collect([]);
											if($distributors->has($key)){
												$distrib = $distributors->get($key);
												$distribMapKeys = $distrib->mapWithKeys(function ($item, $key) {
								                	return [$item['size_id'] => $item['totalSize']];
								            	});
											}
								            $subTotal = 0;
											@endphp
							        		<td><p>{{$distributor}}</p></td>
							            	@foreach ($selectedSizes as $key=>$size)
							            		@if($distribMapKeys->has($key))
							            		@php
								        			$totalSize = $distribMapKeys->get($key);
								        			$subTotal = $subTotal +$totalSize;
								        		@endphp
								        		<td><p>{{$totalSize}}</p></td>
								        		@else
												<td><p>&nbsp;</p></td>
								        		@endif
								        	@endforeach
								        	<td><p>{{$subTotal}}</p></td>
										</tr>
										@endif
									@endforeach
								@else
								<tr>
						        	<td><p>{{$loop->iteration}}</p></td>
						        	<td><p>&nbsp;</p>
						            	<p>{{$val}}</p>
						            </td>
						            <td><p>&nbsp;</p></td>
						            @foreach ($selectedSizes as $size)
								       	<td><p>&nbsp;</p></td>
								    @endforeach
								    <td><p>&nbsp;</p></td>
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
            </div>
        </div>