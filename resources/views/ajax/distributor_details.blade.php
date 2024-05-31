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
		<td>
			@if($shop->present_address)
				{{ $shop->present_address or '' }}
			@else
				Not Exists
			@endif
		</td>
	</tr>
	<tr>
		<th>Permanent Address</th>
		<td>
			@if(isset($shop->parmanent_address))
				{{ $shop->parmanent_address or '' }}
			@else
				Not Exists
			@endif
		</td>
	</tr>
	<tr>
		<th>Birthday</th>
		<td>{{ $shop->detail->birthday or '' }}</td>
	</tr>
	<tr>
		<th>Age</th>
		<td>
		@if(isset($shop->detail->birthday))
			{{ \Carbon\Carbon::parse($shop->detail->birthday)->diffInYears() }} Years
		@else
			Not Exists
		@endif
		</td>
	</tr>
	<tr>
		<th>Business Startday</th>
		<td>{{ $shop->detail->business_startday or '' }}</td>
	</tr>
	<tr>
		<th>Marital Status</th>
		<td>{{ $shop->detail->marital_status or '' }}</td>
	</tr>
	<tr>
		<th>Marriage Day</th>
		<td>{{ $shop->detail->marriage_day or '' }}</td>
	</tr>
	<tr>
		<th>Spouse Name</th>
		<td>{{ $shop->detail->spouse_name or '' }}</td>
	</tr>
	<tr>
		<th>Spouse Birthday</th>
		<td>{{ $shop->detail->spouse_birthday or '' }}</td>
	</tr>
	<tr>
		<th>Father Name</th>
		<td>{{ $shop->detail->father_name or '' }}</td>
	</tr>
	<tr>
		<th>Mother Name</th>
		<td>{{ $shop->detail->mother_name or '' }}</td>
	</tr>
	<tr>
		<th>No. of Son</th>
		<td>{{ $shop->detail->son or '' }}</td>
	</tr>
	<tr>
		<th>No. of Daughter</th>
		<td>{{ $shop->detail->daughter or '' }}</td>
	</tr>
	<tr>
		<th>Shop Created</th>
		<td>{{ $shop->created_at or '' }}</td>
	</tr>
	<tr>
		<th>Status</th>
		<td class="text-capitalize">{{ $shop->status or '' }}</td>
	</tr>
</table>