<table class="table table-condensed">
	<tr>
		<th>Invoice</th>
		<td>{{ $allocations->stock->invoice_no or '' }}</td>
	</tr>
	<tr>
		<th>Invoice Date</th>
		<td>{{ $allocations->stock->invoice_date->format('d M,Y') }}</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $allocations->depot->name or '' }}</td>
	</tr>
	<tr>
		<th>Number of Item</th>
		<td>{{ $allocations->no_of_item or '0' }}</td>
	</tr>
	<tr>
		<th>Total Allocated Quantity</th>
		<td>{{ $allocations->total_qty or '0' }}</td>
	</tr>
	<tr>
		<th>Status</th>
		<td>{{ $allocations->status or '' }}</td>
	</tr>
	<tr>
		<th>Allocation Time</th>
		<td>
		{{ Carbon\Carbon::parse($allocations->created_at)->format('d-M-Y') }}
		</td>
	</tr>
</table>
@if ($allocations->allocation_details)
<h4 class="text-center"><span class="bb-sm">Stock Detail Informations</span></h4>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Brand</th>
			<th>Size</th>
			<th>Allocated</th>
			<th>Received</th>
			<th>Damaged</th>
			<th>Missing</th>
			<th>Excess</th>
			<th>Total Received</th>
		</tr>
	</thead>
	<tbody>
		@php $grandTotal = 0; @endphp
		@foreach ($allocations->allocation_details as $ele)
			@php
				$total = $ele->receive_qty + $ele->damage_qty + $ele->excess_qty;
				$grandTotal = $grandTotal + $total;
			@endphp
			<tr>
				<td>
					@if ($ele->stock_detail->brand)
						{{ $ele->stock_detail->brand->short_code or '' }}
					@endif
				</td>
				<td>
					@if ($ele->stock_detail->size)
						{{ $ele->stock_detail->size->name or '' }}
					@endif
				</td>
				<td align="center">{{ $ele->qty or '0' }}</td>
				<td align="center">{{ $ele->receive_qty or '0' }}</td>
				<td align="center">{{ $ele->damage_qty or '0' }}</td>
				<td align="center">{{ $ele->missing_qty or '0' }}</td>
				<td align="center">{{ $ele->excess_qty or '0' }}</td>
				<td align="center">{{ $total or '0' }}</td>
			</tr>
		@endforeach
			</tr>
				<td colspan="7" align="right"><strong>Total=</strong></td>
				<td align="center">{{$grandTotal}}</td>
			<tr>
	</tbody>
</table>
@endif