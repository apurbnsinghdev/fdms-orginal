
        <div class="panel">
			<div class="panel-content">

				<table>
					<tr>
						<td colspan="100"></td>
					</tr>
					<tr>
						<td colspan="100"><b>DF Delivery summery from {{$start_date}} to {{$end_date}}</b></td>
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