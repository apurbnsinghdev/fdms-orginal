<table class="table table-condensed">
	 <tr>
		<th>Outlet Name</th>
		<td>{{$shopData->outlet_name}}</td>
	</tr>
	<tr>
		<th>Proprietor Name</th>
		<td>{{$shopData->proprietor_name}}</td>
	</tr>
	<tr>
		<th>Mobile</th>
		<td>{{$shopData->mobile}}</td>
	</tr>
	{{-- shop file start--}}
    	@forelse($shopData->documents as $document)
    	<tr>
    		<th>
    			@if($document->field_name == 'nid')
    				NID
    			@else
    				{{mystudy_case($document->field_name)}}
    			@endif
    			
    		</th>
    		<td>
    			<a href="{{ asset('storage/images/'.$shopData->id.'/'.$document->file_name) }}" target="_blank">{{ $document->file_name }}</a>
    		</td>
    	</tr>
    	@empty
    	 	<tr>
    	 		<th>Shop Files</th>
    	 		<td class="text-danger">File is not uploaded yet</td>
    	 	</tr>
    	@endforelse
	{{-- shop file end--}}
	
	{{-- requisition file start--}}
    		@forelse($documentsDataArr as $value)
    			<tr class="bg-info">
            		<th>DF</th>
            		<td><strong>{{$value[0]->serial_no}}</strong></td>
            	</tr>
        		@foreach($value as $vl)
            	<tr>
            		<th>{{mystudy_case($vl->field_name)}}</th>
            		<td>
            			<a href="{{ asset('storage/images/'.$shopData->id.'/'.$vl->file_name) }}" target="_blank">{{ $vl->file_name }}</a>
        
            		</td>
            	</tr>
        		@endforeach
    		@empty
        	 	<tr>
        	 		<th>Requisition Files</th>
        	 		<td class="text-danger">File is not uploaded yet</td>
        	 	</tr>
        	@endforelse
    	
	{{-- requisition file start--}}
</table>
 
