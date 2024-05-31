<table class="table table-condensed">
	<tr>
		<th>Outlet Name </th>
		<td>{{ $shop->outlet_name or '' }}</td>
	</tr>
	<tr>
		<th>Proprietor Name</th>
		<td>{{ $shop->proprietor_name or '' }}</td>
	</tr>
	@if ($shop->distributor)
		<tr>
			<th>Distributor</th>
			<td>{{ $shop->distributor->outlet_name or '' }}</td>
		</tr>
	@endif
	<tr>
		<th>Mobile</th>
		<td>{{ $shop->mobile or '' }}</td>
	</tr>
	<tr>
		<th>NID</th>
		<td>{{ $shop->nid or '' }}</td>
	</tr>
	<tr>
		<th>Trade Lincense</th>
		<td>{{ $shop->trade_license or '' }}</td>
	</tr>
	<tr>
		<th>Shop Address</th>
		<td>{{ $shop->address or '' }}</td>
	</tr>
	<tr>
		<th>Shop Location</th>
		<td>{{ $shop->thana->name or '' }},{{ $shop->district->name or '' }},{{ $shop->division->name or '' }}</td>
	</tr>
	<tr>
		<th>Shop Zone</th>
		<td>
		@if ($shop->area)
			{{ $shop->area->name or '' }},
		@endif
			{{ $shop->region->name or '' }}
		</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $shop->depot->name or '' }}</td>
	</tr>
	<tr>
		<th>Present Address</th>
		<td>{{ $shop->present_address or '' }}</td>
	</tr>
	<tr>
		<th>Permanent Address</th>
		<td>{{ $shop->parmanent_address or '' }}</td>
	</tr>
	<tr>
		<th>Shop Created</th>
		<td>{{ $shop->created_at or '' }}</td>
	</tr>
	<tr>
		<th>Status</th>
		<td class="text-capitalize">{{ $shop->status or '' }}</td>
	</tr>
	@if($shop->items->count())
		<tr class="bg-info">
    		<th>DF List</th>
    		<td>&nbsp;</td>
    	</tr>
    	@foreach($shop->items as $item)
    	<tr>
    		<td>{{$item->serial_no}}</td>
    		<td>{{mystudy_case($item->freeze_status)}}</td>
    	</tr>
    	@endforeach
	@endif
</table>