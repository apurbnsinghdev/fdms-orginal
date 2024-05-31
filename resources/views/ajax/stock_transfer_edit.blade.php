<table class="table table-condensed">
	<tr>
		<th>Date</th>
		<td>
			{{ Carbon\Carbon::parse($stockTransfer->placed_date)->format('d-M-Y') }}
		</td>
	</tr>
	<tr>
		<th>From Depot</th>
		<td>
			{{ $stockTransfer->from_depot}}
		</td>
	</tr>
	<tr>
		<th>To Depot</th>
		<td>
			{{ $stockTransfer->to_depot}}
		</td>
	</tr>
</table>

{{ Form::model(request()->old(),array('route' => array('inventories.stockTransferUpdate'),'class'=>'form-horizontal')) }}
<input type="hidden" name="stock_transfer_id" value="{{$stockTransfer->id}}">
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Brand</th>
			<th>Size</th>
			<th>Avilable Qty.</th>
			<th>Remaining Qty.</th>
			<th>Transfer Qty.</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($transferData as $key=>$ele)
	 	<tr>
			<td>{{ $ele->brand or '' }}</td>
			<td>{{ $ele->size or '' }}</td>
			<td>{{ $ele->totalAvailabe+ ( !$ele->placed_qty? $ele->placed_qty:0)}}</td>
			<td class="text-danger">{{ $ele->totalAvailabe or 0 }}</td>
			<td width="30%">
				<input type="hidden" name="data[{{$key}}][stock_transfer_detail_id]" value="{{$ele->stock_transfer_detail_id}}">
				<input type="hidden" name="data[{{$key}}][brand_id]" value="{{$ele->brand_id}}">
				<input type="hidden" name="data[{{$key}}][size_id]" value="{{$ele->size_id}}">
				<input type="hidden" name="data[{{$key}}][placed_qty]" value="{{$ele->placed_qty}}">
				<input oninput="javascript: if (this.value > this.maxLength) this.value = this.maxLength;" maxlength="{{ $ele->totalAvailabe+ ( null!=$ele->placed_qty? $ele->placed_qty:0) }}" onchange="remainCheck(this)" class="form-control" type="number" name="data[{{$key}}][qty]" value="{{ null!=$ele->placed_qty? $ele->placed_qty:'' }}"></td>
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