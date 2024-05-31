<table class="table table-condensed">
	<tr>
		<th>&nbsp;</th>
		<th>From Shop</td>
		<th>To Shop</td>
	</tr>
	<tr>
		<th>Outlet Name </th>
		<td>{{ $fromShop->outlet_name or '' }}</td>
		<td>{{ $toShop->outlet_name or '' }}</td>
	</tr>
	<tr>
		<th>Proprietor Name</th>
		<td>{{ $fromShop->proprietor_name or '' }}</td>
		<td>{{ $toShop->proprietor_name or '' }}</td>
	</tr>
	<tr>
		<th>Distributor</th>
		<td>
			@if ($fromShop->distributor)
			{{ $fromShop->distributor->outlet_name or '' }}
			@endif
		</td>
		<td>
			@if ($toShop->distributor)
			{{ $toShop->distributor->outlet_name or '' }}
			@endif
		</td>
	</tr>
	<tr>
		<th>Mobile</th>
		<td>{{ $fromShop->mobile or '' }}</td>
		<td>{{ $toShop->mobile or '' }}</td>
	</tr>
	<tr>
		<th>NID</th>
		<td>{{ $fromShop->nid or '' }}</td>
		<td>{{ $toShop->nid or '' }}</td>
	</tr>
	<tr>
		<th>Trade Lincense</th>
		<td>{{ $fromShop->trade_license or '' }}</td>
		<td>{{ $toShop->trade_license or '' }}</td>
	</tr>
	<tr>
		<th>Shop Address</th>
		<td>{{ $fromShop->address or '' }}</td>
		<td>{{ $toShop->address or '' }}</td>
	</tr>
	<tr>
		<th>Shop Location</th>
		<td>{{ $fromShop->thana->name or '' }},{{ $fromShop->district->name or '' }},{{ $fromShop->division->name or '' }}</td>
		<td>{{ $toShop->thana->name or '' }},{{ $toShop->district->name or '' }},{{ $toShop->division->name or '' }}</td>
	</tr>
	<tr>
		<th>Shop Zone</th>
		<td>
		@if ($fromShop->area)
			{{ $fromShop->area->name or '' }},
		@endif
			{{ $fromShop->region->name or '' }}
		</td>
		<td>
		@if ($toShop->area)
			{{ $toShop->area->name or '' }},
		@endif
			{{ $toShop->region->name or '' }}
		</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $fromShop->depot->name or '' }}</td>
		<td>{{ $toShop->depot->name or '' }}</td>
	</tr>
	<tr>
		<th>Present Address</th>
		<td>{{ $fromShop->present_address or '' }}</td>
		<td>{{ $toShop->present_address or '' }}</td>
	</tr>
	<tr>
		<th>Permanent Address</th>
		<td>{{ $fromShop->parmanent_address or '' }}</td>
		<td>{{ $toShop->parmanent_address or '' }}</td>
	</tr>
	<tr>
		<th>Shop Created</th>
		<td>{{ $fromShop->created_at or '' }}</td>
		<td>{{ $toShop->created_at or '' }}</td>
	</tr>
	<tr>
		<th>Status</th>
		<td class="text-capitalize">{{ $fromShop->status or '' }}</td>
		<td class="text-capitalize">{{ $toShop->status or '' }}</td>
	</tr>
</table>