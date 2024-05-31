
        <div class="panel">
			<div class="panel-content">
				<div class="table-responsive">
				    <table border="1" cellspacing="0" cellpadding="0" width="100%" class="table table-bordered table-striped table-sm">
				    	<thead class="table-primary">
						    <tr>
						        <td><p>SL</p></td>
						        <td><p>Depot Name</p></td>
						        @foreach ($selectedSizes as $size)
						        <td><p>{{ $size }} Liter</p></td>
						        @endforeach
						        <td><p>Total DF</p></td>
						    </tr>
					    </thead>
					    <tbody>
					    	@php
					    		$grandTotal = 0;
					    	@endphp
							@foreach ($depots as $key=>$val)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$val}}</td>
									@php
										$mainSize=[];
										$subTotal = 0;
									@endphp
									@if (array_key_exists($key, $filterData))
										@php
											$mainSize=$filterData[$key];
										@endphp
									@endif
									@foreach ($selectedSizes as $k=>$v)
										<td>
											@if(array_key_exists($k,$mainSize))
												{{$mainSize[$k]}}

												@php
													$subTotal = $subTotal+$mainSize[$k];
												@endphp
											@else
												{{'0'}}
											@endif
										</td>
									@endforeach
									@php
										$grandTotal = $grandTotal +$subTotal;
									@endphp
										<td><strong>{{$subTotal}}</strong></td>

								</tr>
						    @endforeach
						    <tr>
						    	<td colspan="2" align="right">Total DF</td>
						    @foreach ($selectedSizes as $k=>$v)
						    	<td><strong>{{collect($itemGroups->get($k))->sum()}}</strong></td>
						    @endforeach
						    <td><strong>{{$grandTotal}}</strong></td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
        </div>

