
        <div class="panel">
			<div class="panel-content">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<table class="table table-bordered" cellspacing="0" cellpadding="0" align="left">
						    <tr>
						        <td style="border:none"></td>
						        <td colspan="{{count($uniqueSizeArr)}}"><strong>DF Received for - {{$reporting_year}}</strong></td>
						        <td colspan="2" style="border:none"></td>
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

				<table>
					<tr>
						<td colspan="100"></td>
					</tr>
					<tr>
						<td colspan="100"><b>DF Delivery Summery  for - {{$reporting_year}}</b></td>
					</tr>

				</table>

				<div class="table-responsive">
					<table class="table table-bordered" cellspacing="0" cellpadding="0" align="left" >
					    <tr>
					        <th colspan="2"><div style="width:135px">DF Distribution</div></th>
					        @foreach ($depots as $depot)
					        	 <th rowspan="2">{{$depot}}</th>
					        @endforeach
					        <td rowspan="2">Total DF</td>
					    </tr>
					    <tr>
					        <td><strong>Delivery Date</strong></td>
					        <td><strong>Size</strong></td>
					    </tr>
					 @php
					 	$totalSum=0;
					 	$totalArr=[];
					 @endphp
					@foreach ($reports as $deliveryDate=>$report)
						@foreach ($report as $size=>$data)
					    <tr>
					        <td>{{$deliveryDate}}</td>
					        <td>{{$sizes->get($size)}}</td>
					        @php
					        	$sum=0;
					        @endphp
					        @foreach ($depots as $depotId=>$d)
					        	@if (array_key_exists($depotId,$data))
					        		@php
					        			$val=$data[$depotId];
					        			$sum+=$val;
					        		@endphp
					        		<td>{{$val}}
						        	@if (array_key_exists($depotId,$totalArr))
					        			@php
					        				$totalArr[$depotId]+=$val;
					        			@endphp
					        		@else
					        			@php
					        				$totalArr[$depotId]=$val;
					        			@endphp
					        		@endif
					        	@else
					        	<td>&nbsp;</td>
					        	@endif
					        	@if (!array_key_exists($depotId,$totalArr))
						        	@php
						        		$totalArr[$depotId]=0;
						        	@endphp
						        @endif
					        @endforeach
					       	@php
					       		$totalSum+=$sum;
					       	@endphp
					        <td>{{$sum?:""}}</td>
					    </tr>
					   @endforeach
					@endforeach

					    <tr>
					        <td colspan="2"><strong>Total DF Delivery</strong></td>
					        @foreach ($totalArr as $k=>$sumVal)
					        	<td>{{$sumVal}}</td>
					        @endforeach


					        <td>{{$totalSum}}</td>
					    </tr>
					</table>



				</div>
            </div>
        </div>