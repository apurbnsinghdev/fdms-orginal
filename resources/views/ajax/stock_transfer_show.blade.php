<table class="table table-condensed">
	<tr>
		<th>Date</th>
		<td>
			{{ Carbon\Carbon::parse($transferData->placed_date)->format('d-M-Y') }}
		</td>
	</tr>
	<tr>
		<th>From Depot</th>
		<td>
			{{ $transferData->from_depot }}
		</td>
	</tr>
</table>

{{ Form::model(request()->old(),array('route' => array('inventories.stockTransferReceive'),'class'=>'form-horizontal')) }}
	 			<input type="hidden" name="data[stock_transfer_id]" value="{{$transferData->id}}">
<table class="table table-condensed">
    	<thead>
    			<tr>
    				<th class="col-md-2">DF</th>
    				<th class="col-md-1">Receive Qty</th>
    				<th class="col-md-3">Comments</th>
    			</tr>
    	</thead>
	<tbody>
	<tbody>
		@foreach ($transferData->stock_transfer_details as $transferItem)
	 	<tr class="receive-tr">
	 		<td style="padding-top: 15px">
	 			<input type="hidden" name="data[{{$loop->iteration}}][stock_transfer_detail_id]" value="{{$transferItem->id}}">
				{{$transferItem->brand->short_code}}
				-
				{{$transferItem->size->name}}
	 		</td>
 			<td class="text-center allocated-qty" style="padding-top: 15px">{{$transferItem->placed_qty}}<input class="form-control" type="hidden" name="data[{{$loop->iteration}}][receive_qty]" value="{{$transferItem->placed_qty}}" min="0">
	 		</td>
	 		<td>
	 			<textarea class="form-control" name="data[{{$loop->iteration}}][comments]"></textarea>
	 		</td>
	 	</tr>
	 	@endforeach
		<tr>
	 		<td colspan="7">
	 			 <button type="submit" class="btn btn-primary">
	           			 Save
	        	</button>
	 		</td>
		 </tr>
	</tbody>
</table>
{{ Form::close() }}