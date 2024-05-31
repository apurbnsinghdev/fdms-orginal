<div class="panel">
	<div class="panel-content">
		<div class="table-responsive">
		    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
		    	<thead class="table-primary">
				    <tr>
				        <td><p><b>SL</b></p></td>
				        <td><p><b>Division</b></p></td>
				        <td><p><b>District</b></p></td>
				        <td><p><b>Thana</b></p></td>
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
				        <td><p><strong>Total DF</strong></p></td>
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
												<td><p><strong>{{$subTotal}}</strong></p></td>
												@php
													$brand_id = $ele->brand_id;
													$subTotal = 0;
												@endphp
											@endif

											@if(isset($reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id]))

												@php
								        		$total = $reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id];
								        		$subTotal += $total;
								        		//$grandTotal += $total;
							        			@endphp
												<td><p>{{$total}}</p></td>
											@else
												<td><p>&nbsp;</p></td>
											@endif
											@if($loop->last)
											<td><p><strong>{{$subTotal}}</strong></p></td>
				        					@endif
										@endforeach
										<td><p><strong>{{isset($totals['rows'][$l->id])?$totals['rows'][$l->id]:0}}</strong></p></td>
								    </tr>
								    @else
									<tr>
										<td><p>{{$l->name}}</p></td>
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
												<td><p><strong>{{$subTotal}}</strong></p></td>
												@php
													$brand_id = $ele->brand_id;
													$subTotal = 0;
												@endphp
											@endif

											@if(isset($reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id]))

												@php
								        		$total = $reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id];
								        		$subTotal += $total;
								        		//$grandTotal += $total;
							        			@endphp
												<td><p>{{$total}}</p></td>
											@else
												<td><p>&nbsp;</p></td>
											@endif
											@if($loop->last)
											<td><p><strong>{{$subTotal}}</strong></p></td>
				        					@endif
										@endforeach
										<td><p><strong>{{isset($totals['rows'][$l->id])?$totals['rows'][$l->id]:0}}</strong></p></td>
									</tr>
								    @endif
							    @endforeach
						    @else

								@foreach ($loc->children as $l)
								<tr>
									@if($loop->first)
										<td rowspan="{{$rspan}}"><p>{{$district}}</p></td>
										<td><p>{{$l->name}}</p></td>
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
												<td><p><strong>{{$subTotal}}</strong></p></td>
												@php
													$brand_id = $ele->brand_id;
													$subTotal = 0;
												@endphp
											@endif

											@if(isset($reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id]))

												@php
								        		$total = $reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id];
								        		$subTotal += $total;
								        		//$grandTotal += $total;
							        			@endphp
												<td><p>{{$total}}</p></td>
											@else
												<td><p>&nbsp;</p></td>
											@endif
											@if($loop->last)
											<td><p><strong>{{$subTotal}}</strong></p></td>
				        					@endif
										@endforeach
										<td><p><strong>{{isset($totals['rows'][$l->id])?$totals['rows'][$l->id]:0}}</strong></p></td>

									@else
										<td><p>{{$l->name}}</p></td>
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
												<td><p><strong>{{$subTotal}}</strong></p></td>
												@php
													$brand_id = $ele->brand_id;
													$subTotal = 0;
												@endphp
											@endif

											@if(isset($reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id]))

												@php
								        		$total = $reports[$location->id][$loc->id][$l->id][$ele->brand_id][$ele->size_id];
								        		$subTotal += $total;
								        		//$grandTotal += $total;
							        			@endphp
												<td><p>{{$total}}</p></td>
											@else
												<td><p>&nbsp;</p></td>
											@endif
											@if($loop->last)
											<td><p><strong>{{$subTotal}}</strong></p></td>
				        					@endif
										@endforeach
										<td><p><strong>{{isset($totals['rows'][$l->id])?$totals['rows'][$l->id]:0}}</strong></p></td>
						         	@endif
						        </tr>
						        @endforeach
						    @endif
					    @endforeach
				    @endforeach

				    <tr>
				   		<td colspan="4" align="right"><p><strong>Total DF</strong></p></td>
				   		@php
				   			$brand_id=null;
				   			$grandTotal = 0;
				   			$subTotal = 0;
				   		@endphp
						@foreach ($brandSizes as $ele)
							@php

							$total = 0;

			        		if(isset($totals['columns'][$ele->brand_id][$ele->size_id])){
			        			$total = $totals['columns'][$ele->brand_id][$ele->size_id];
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
								<td><p><strong>{{$subTotal}}</strong></p></td>
								@php
									$brand_id = $ele->brand_id;
				        			$subTotal = $total;
								@endphp
							@endif

							<td><p>{{$total}}</p></td>

							@if($loop->last)
								<td><p><strong>{{$subTotal}}</strong></p></td>
				        	@endif
						@endforeach

						<td><p><strong>{{$grandTotal}}</strong></p></td>
				   	</tr>


				</tbody>
			</table>
		</div>
    </div>
</div>

