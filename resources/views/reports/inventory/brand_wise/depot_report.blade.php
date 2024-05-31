<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
			@if (count($reports))
				<table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
			    	<thead class="table-primary">
					    <tr>
					        <td><b>SL</b></td>
					        <td><b>Depot</b></td>
					        <td><b>Distributor Code</b></td>
					        <td><b>Distributor</b></td>
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
					        		<td><strong>Total - {{$brand_code}}</strong></td>
					        		@php
					        			$brand_id = $brand->brand_id;
					        			$brand_code = $brand->brand_code;
					        		@endphp
					        	@endif
					        <td>{{$brand->brand_code}}- {{$brand->size_name}}</td>

					        @if($loop->last)
							<td><strong>Total - {{$brand->brand_code}}</strong></td>
					        @endif

					        @endforeach
					        <td><strong>Total DF</strong></td>
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
									<td rowspan="{{$rowspan}}">{{$iteration}}</td>
							        <td rowspan="{{$rowspan}}">{{ $depot }}</td>
						        	<td>{{ $element->code }}</td>
						        	<td>{{  $element->outlet_name }}</td>
						        	@php
			        					$brand_id=null;
			        					$subTotal = 0;
			        				@endphp
									@foreach ($brandSizes as $ele)
										@php
						        		if($brand_id == null){
						        			$brand_id = $ele->brand_id;

						        		}elseif($brand_id != $ele->brand_id){
						        			$brand_id = null;
						        		}
								        @endphp

								        @if($brand_id==null)
											<td><strong>{{$subTotal}}</strong></td>
											@php
												$brand_id = $ele->brand_id;
												$subTotal = 0;
											@endphp
										@endif

										@if(isset($reports[$element->depot_id][$element->id][$ele->brand_id][$ele->size_id]))

											@php
							        		$total = (int)$reports[$element->depot_id][$element->id][$ele->brand_id][$ele->size_id];
							        		$subTotal += $total;
							        		//$grandTotal += $total;
						        			@endphp
											<td>{{$total}}</td>
										@else
											<td>&nbsp;</td>
										@endif
										@if($loop->last)
										<td><strong>{{$subTotal}}</strong></td>
			        					@endif
									@endforeach
									<td><strong>{{isset($totals['rows'][$element->id])?$totals['rows'][$element->id]:0}}</strong></td>
							    </tr>
							    @else
								<tr>
									<td>{{ $element->code }}</td>
						        	<td>{{  $element->outlet_name }}</td>
						        	@php
			        					$brand_id=null;
			        					$subTotal = 0;
			        				@endphp
									@foreach ($brandSizes as $ele)
										@php
						        		if($brand_id == null){
						        			$brand_id = $ele->brand_id;

						        		}elseif($brand_id != $ele->brand_id){
						        			$brand_id = null;
						        		}
								        @endphp

								        @if($brand_id==null)
											<td><strong>{{$subTotal}}</strong></td>
											@php
												$brand_id = $ele->brand_id;
												$subTotal = 0;
											@endphp
										@endif

										@if(isset($reports[$element->depot_id][$element->id][$ele->brand_id][$ele->size_id]))

											@php
							        		$total = (int) $reports[$element->depot_id][$element->id][$ele->brand_id][$ele->size_id];
							        		$subTotal += $total;
							        		//$grandTotal += $total;
						        			@endphp
											<td>{{$total}}</td>
										@else
											<td>&nbsp;</td>
										@endif
										@if($loop->last)
										<td><strong>{{$subTotal}}</strong></td>
			        					@endif
									@endforeach
									<td><strong>{{isset($totals['rows'][$element->id])?$totals['rows'][$element->id]:0}}</strong></td>
							    </tr>
							    @endif
							@endforeach
				    	@endforeach
				    	<tr>
					   		<td colspan="4" align="right"><strong>Total DF</strong></td>
					   		@php
					   			$brand_id=null;
					   			$grandTotal = 0;
					   			$subTotal = 0;
					   		@endphp
							@foreach ($brandSizes as $ele)
								@php

								$total = 0;

				        		if(isset($totals['columns'][$ele->brand_id][$ele->size_id])){
				        			$total = (int)$totals['columns'][$ele->brand_id][$ele->size_id];
				        			$grandTotal += $total;
				        		}else{
				        			$subTotal += 0;
				        		}

								if($brand_id == null){
				        			$brand_id = $ele->brand_id;
				        			$subTotal = $total;

				        		}elseif($brand_id != $ele->brand_id){
				        			$brand_id = null;
				        			$subTotal = $subTotal;
				        		}else{
				        			$subTotal += $total;
				        		}

								@endphp

								@if($brand_id==null)
									<td><strong>{{$subTotal}}</strong></td>
									@php
										$brand_id = $ele->brand_id;
					        			$subTotal = $total;
									@endphp
								@endif

								<td>{{$total}}</td>
								@if($loop->last)
								<td><strong>{{$subTotal}}</strong></td>
						        @endif
							@endforeach
							<td><strong>{{$grandTotal}}</strong></td>
					   	</tr>
					</tbody>
				</table>
			@else
				<table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
					<thead>
						<tr><td>No Data found</td></tr>
					</thead>
				</table>
			@endif
		</div>
    </div>
</div>

