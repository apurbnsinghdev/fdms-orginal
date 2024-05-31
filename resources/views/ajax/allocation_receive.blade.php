<div class="col-md-6 col-md-offset-3">
	<table class="table table-condensed">
		<tr>
			<th>Invoice No.:</th>
			<td>{{ $allocations->stock->invoice_no or '' }}</td>
		</tr>
		<tr>
			<th>Invoice Date:</th>
			<td>{{ $allocations->stock->invoice_date->format('d M/Y') }}</td>
		</tr>
		<tr>
			<th>Depot:</th>
			<td>{{ $allocations->depot->name or '' }}</td>
		</tr>
	</table>
</div>

{{ Form::model(request()->old(),array('route' => array('inventories.allocatedStockReceive'),'class'=>'form-horizontal')) }}
	{{ Form::hidden('invoice_date',$allocations->stock->invoice_date) }}
    <table class="table table-condensed">
    	<thead>
    			<tr>
    				<th class="col-md-2">DF</th>
    				<th class="col-md-1">Allocated</th>
    				<th class="col-md-2">Receive</th>
    				<th class="col-md-2">Damage</th>
    				<th class="col-md-1">Missing</th>
    				<th class="col-md-1">Excess</th>
    				<th class="col-md-3">Comments</th>
    			</tr>
    	</thead>
	<tbody>
	 @foreach ($allocations->allocation_details as $dkey=>$dval)
	 	<tr class="receive-tr">
	 		<td style="padding-top: 15px">
	 			<input type="hidden" name="data[{{$loop->iteration}}][depot_id]" value="{{$allocations->depot_id}}">
            	<input type="hidden" name="data[{{$loop->iteration}}][size_id]" value="{{$dval->stock_detail->size->id}}">
            	<input type="hidden" name="data[{{$loop->iteration}}][id]" value="{{$dval->id}}">
            	<input type="hidden" name="data[{{$loop->iteration}}][stock_detail_id]" value="{{$dval->stock_detail_id}}">
	 			@if ($dval->stock_detail->brand)
	 				<input type="hidden" name="data[{{$loop->iteration}}][brand_id]" value="{{$dval->stock_detail->brand->id}}">
					{{ $dval->stock_detail->brand->short_code or '' }}-
				@endif
				{{$dval->stock_detail->size->name}}
	 		</td>
 			<td class="text-center allocated-qty" style="padding-top: 15px">
 				{{$dval->qty}}
	 		<td>
	 			<input class="form-control receive-qty" type="number" name="data[{{$loop->iteration}}][receive_qty]" onchange="validateData(this)" value="{{$dval->qty}}" min="0">
	 		</td>
	 		<td>
	 			<input class="form-control damage-qty" onchange="validateData(this)" type="number" name="data[{{$loop->iteration}}][damage_qty]" value="0" min="0">
	 		</td>
	 		<td>
	 			<input class="form-control missing-qty" onchange="validateData(this)"  type="number" name="data[{{$loop->iteration}}][missing_qty]" value="0" min="0">
	 		</td>
	 		<td>
	 			<input class="form-control" type="number" name="data[{{$loop->iteration}}][excess_qty]" value="0" min="0">
	 		</td>
	 		<td>
	 			<textarea class="form-control" name="data[{{$loop->iteration}}][comments]"></textarea>
	 		</td>
	 	</tr>
	 @endforeach
		 <tr>
	 		<td colspan="7">
	 			 <button type="submit" class="btn btn-primary">
	           			 Receive
	        	</button>
	 		</td>
		 </tr>
	</tbody>
</table>
{{ Form::close() }}

