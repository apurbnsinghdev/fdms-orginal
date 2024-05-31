<table class="table table-condensed">
	<tr>
		<th>Depot Type</th>
		<td>{{ $applications->depot->name or '' }}</td>
	</tr>
	<tr>
		<th>Outlet Name</th>
		<td>{{ $applications->shop->outlet_name or '' }}</td>
	</tr>
	<tr>
		<th>Damage Type</th>
		<td>{{ $applications->damage_type->name or '' }}</td>
	</tr>
	<tr>
		<th>DF Code</th>
		<td>{{ $applications->item->serial_no or '' }}</td>
	</tr>
	<tr>
		<th>Inject Date</th>
		<td>{{ $applications->settlement->inject_date->format('l jS \\of F Y h:i:s A') }}</td>
	</tr>
	<tr>
		<th>Used</th>
		@php
            $month=(int)$applications->settlement->inject_date->diffInMonths($applications->created_at);
        @endphp
		<td class="text-capitalize">{{ $month }} {{ str_plural('month',$month) }}</td>
	</tr>
	<tr>
		<th>Payment Status</th>
		<td>{{ $applications->settlement->receive_amount or '0' }} Tk.</td>
	</tr>
	<tr>
		<th>Sattlement Status</th>
		@if ($applications->settlement->status=='continue')
			<td class="text-danger">Pending</td>
		@else
			<td class="text-capitalize text-danger">{{ $applications->settlement->status or '' }}</td>
		@endif

	</tr>
	<tr>
		<th>Status</th>
		<td class="text-capitalize"><strong class="text-danger">{{ $applications->status }}</strong></td>
	</tr>
	<tr>
		<th>Remark</th>
		<td>{{ $applications->remarks}}</td>
	</tr>
</table>

