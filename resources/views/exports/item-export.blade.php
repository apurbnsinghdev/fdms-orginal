 
<table border="1" cellspacing="0" cellpadding="0" width="700">
	<thead>
		<tr>
			<th>Id</th>
			<th>Depot</th>
			<th>Brand</th>
			<th>Size</th>
			<th>Serial No</th>
			<th>Freeze Status</th>
			<th>Distributor Code</th>
			<th>Outlet Name</th>
			<th>Address</th>
			<th>Mobile</th>
			<th>Inject Date</th>
			<th>Received Amount</th>
			<th>Previous Outlet Name</th>
			<th>Category</th>
			<th>Proprietor Name</th>
			<th>NID</th>
			<th>Trade License</th>
			<th>Estimated Sales</th>
		</tr>
	</thead>
	@foreach($items as $item)
    <tbody>
    	<tr>
    		<td>{{$item->id}}</td>
    		<td>{{$item->depot->name}}</td>
    		<td>{{$item->brand->short_code}}</td>
    		<td>{{$item->size->name}}</td>
    		<td>{{$item->serial_no}}</td>
    		<td>{{$item->freeze_status}}</td>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    		<th>&nbsp;</th>
    	</tr>
    </tbody>
    @endforeach
</table>


