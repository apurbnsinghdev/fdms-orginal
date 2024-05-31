@extends('layouts.admin')
@section('title', 'Distributor Retailer Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Distributor Retailer</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>{{$distributor->outlet_name}} ({{$distributor->retailers->count()}})</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('distributors.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        {{ Form::model($distributor,array('route' => array('distributor.shops.transfer',$distributor->id),'method' => 'PUT','enctype'=>'multipart/form-data')) }}
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>SI NO.</th>
                            <th>Name</th>
                            <th>Proprietor Name</th>
                            <th>Mobile</th>
                            <th class="no-sort">Address</th>
                            <th class="no-sort">
                            		<label style="border:1px solid #ddd; padding:5px; margin-top: 10px; background-color: #efefef">
                    					<input id="checkoruncheck" type="checkbox">
                    					<strong>Check/Uncheck All</strong>
                    				</label>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                         @php ($i=1)
                         @foreach($distributor->retailers as $retailer)
                         	<tr>
                         		<td>{{$i}}</td>
                         		<td>{{$retailer->outlet_name}}</td>
                                <td>{{$retailer->proprietor_name}}</td>
                                <td>{{$retailer->mobile}}</td>
                         		<td>{{$retailer->address}}</td>
                         		<td>{{ Form::checkbox('shop_ids[]',$retailer->id,null, array('class'=>'shop_ids')) }}</td>
                         	</tr>
                         	 @php ($i=$i+1)
                         @endforeach
                        </tbody>
                  </table>
                  @if($distributor->retailers->count())
                  	<table class="table table-striped" cellspacing="0" width="100%">
                     <tr>
                     	<td></td>
                     	<td></td>
                     	<td></td>
                     	<td class="text-center"><button type="button" class="btn btn-primary" onclick="showModal({{$distributor->id}},{{$distributor->depot_id}})">
                            Transfer
                        </button></td>
                     </tr>
                 	</table>
                 @endif
                </div>
            </div>
        </div>
         @include('common_pages.common_modal',['modalTitle'=>'Transfer Distributor'])
         {{ Form::close() }}
    </div>
</div>
@endsection

@component('common_pages.data_table_script')
<script>
    //show modal for delete distributor
    function showModal(id,depotId){
    	var lngth = $('input:checkbox.shop_ids:checked').length;
    	console.log(lngth);
    	if(lngth){
    		 $.ajax({
    	          type: 'POST',
    	          url:"{{ route('ajax.shops.getDepotDistributor') }}",
    	          data:{_token:window.Laravel.csrfToken,distributor_id:id,depot_id:depotId,notForm:true}
    	      	}) .done(function(response) {
    	      		 var modalBody=$('#modal-body');
    	             modalBody.css('padding-top',0);
    	             modalBody.html(response);
    	             $('#common-modal').modal('show');

    	      })
    	      .fail(function(response) {
    	      });
    	}else{
        	alert('Please check any');
    	}

    }


  $(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
        "pageLength": 100,
        "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false,
            "order": []
          } ]
      });
  });
  $(document).ready(function(e){
  	$("#checkoruncheck").change(function () {
  	    $("input:checkbox").prop('checked', $(this).prop("checked"));
  	});
  });
</script>
@endcomponent

