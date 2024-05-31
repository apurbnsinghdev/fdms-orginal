@extends('layouts.admin')
@section('title', 'Shop Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Shop</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@include('shops.tab')
@php
@endphp
<div class="row animated fadeInRight">
    <div class="col-sm-12">
    	<div class="row">
    		<div class="col-sm-6">
    			<h4 class="section-subtitle">
                    <b>  Retailer Lists </b>
                </h4>
    		</div>
    		<div class="col-sm-5">
    			{{ Form::open(array('route' => array('shops.download',!$param? '':1),'id'=>"downloadForm",'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    			<div class="row">
    				@if($depots->count())
    				<div class="col-sm-5">
    					{{Form::select('depot_id',[''=>'Please Select Depot']+$depots->toArray(),null,array('id'=>'depot_id','class' => 'form-control','onchange'=>'getDepotDistributor(this.value)'))}}
    				</div>
    				@endif
    				<div class="col-sm-6">
    					<span id="shop-list">{{Form::select('distributor_id',[''=>'Please Select Distributor']+$distributors->toArray(),null,array('id'=>'shop_id','class' => 'form-control'))}}</span>
    				</div>
    				<div class="col-sm-1">
    					<button type="submit" class="btn btn-success" id="btnDownload">
                           <i class="fa fa-download" aria-hidden="true"></i>
                        </button>
    				</div>
    			</div>
            	
            	 
			{{ Form::close() }}
    		</div>
    		<div class="col-sm-1">
    			{!! Html::decode(link_to_route('shops.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
    		</div>
    	</div>
        
        	{{-- {!! Html::decode(link_to_route('shops.download','<i class="fa fa-download" aria-hidden="true"></i>',!$param?[]:['param'=>1],array('class'=>'btn btn-success btn-right-side'))) !!} --}}
         
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                         	  <th class="no-sort">Outlet</th>
                            @if (!$param)
                              <th class="no-sort">DF Codes</th>
                            @endif
                            <th class="no-sort">Proprietor Name</th>
                            <th class="no-sort">Distributor</th>
                            <th class="no-sort">Mobile</th>
                            <th>Depot</th>
                            <th>Region</th>
                            <th>District</th>
                            <th>Thana</th>
                            <th class="no-sort">Status</th>
                        	  <th></th>
                            <th class="no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        @include('common_pages.common_modal',['modalTitle'=>'Shop Informations'])
        @include('common_pages.common_modal',['modalTitle'=>'Delete Distributor','id'=>'common-modal2','bodyid'=>'modal-body2'])
    </div>
</div>

@endsection
@component('common_pages.data_table_script')
@slot('css')
  <style>
    tr td{
      text-transform:capitalize;
    }
  </style>
@endslot
 <script>
 		//show modal for details view
        function showModal(id){
            $.get(laravelObj.appHost+"/get-shop-details/"+id, function(data, status){
                var modalBody=$('#modal-body');
                modalBody.css('padding-top',0);
                $('#modal-title').html('Shop Informations');
                modalBody.html(data);
            });
            $('#common-modal').modal('show');
        };

      //show modal for delete distributor
        function showModal2(id,depotId){
        	$.ajax({
              type: 'POST',
              url:"{{ route('ajax.shops.getDepotDistributor') }}",
              data:{_token:window.Laravel.csrfToken,distributor_id:id,depot_id:depotId}
          	}) .done(function(response) {
          		 var modalBody=$('#modal-body2');
                 modalBody.css('padding-top',0);
                 modalBody.html(response);
                 $('#common-modal2').modal('show');

          })
          .fail(function(response) {
          });
        }

        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [], /* No ordering applied by DataTables during initialisation */
                "pageLength": 25,
                "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
                  "order": []
                } ],
                "ajax": "{{ route('ajax.shops.get',[$param]) }}",
                "columns": [
                    { "data": "outlet_name" },
                    @if (!$param)
                    {
                      "data": "dfCodes",
                      'name':'items.serial_no',
                  },
                    @endif
                    { "data": "proprietor_name" },
                    {
                      'data':'distributor',
                      'name':'distributor.outlet_name',
                      'defaultContent':''
                    },

                    { "data": "mobile" },
                    {
                        "data": "depotName" ,
                        'name':'depots.name',
                    },
                    {
                        "data": "regionName",
                        'name':'region.name',
                    },
                    {
                      'data':'districtName',
                      'name':'district.name',
                      'defaultContent':''
                    },
                    {
                      'data':'thanaName',
                      'name':'thana.name',
                      "orderable": false,
                      'defaultContent':''
                    },
                    {
                        "data": "status",
                        'defaultContent':''
                     },

                    {
                        "data": "id",
                        "orderable": false,
                        "bSearchable": false,
                         render: function (data, type, full, meta) {
                            return '<a href="' + laravelObj.appHost + "/requisitions/create/" + data + '"><span aria-hidden="true" class="fa fa-wpforms fa-x"></span></a>';
                        }
                     },

                    {
                        "data": "id",
                        "orderable": false,
                        "bSearchable": false,
                        render: function (data, type, full, meta) {
                        	 if(full.status=='inactive'){
                        		 return `<a style="cursor:pointer" onclick="showModal(`+data+`)"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a> `+
                        		 `<a style="cursor:pointer" onclick="getAllDocuments(`+data+`)"><span aria-hidden="true" class="fa fa-file fa-x"></span></a>`+
                                 '<a href="' + laravelObj.appHost + "/shops/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>';
                        	 }else{
                        		 return `<a style="cursor:pointer" onclick="showModal(`+data+`)"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a> `+
                        		 `<a style="cursor:pointer" onclick="getAllDocuments(`+data+`)"><span aria-hidden="true" class="fa fa-file fa-x"></span></a>`+
                                 '<a href="' + laravelObj.appHost + "/shops/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>'+
                                 '<form method="POST" action="'+laravelObj.appHost+'/shops/'+data+'" accept-charset="UTF-8" class="delete-form"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'+Laravel.csrfToken+'"><button type="submit" class="btn btn-xs" title="" data-original-title="Delete"><span aria-hidden="true" class="fa fa-remove"></span></button></form>';
                        	 }
                        }
                    },
                ],
                "fnDrawCallback": function (oSettings) {
                    var tooltipArr = [
                        { "className": "fa-edit", "title": "Edit" },
                        { "className": "fa-eye", "title": "View" },
                        { "className": "fa-remove", "title": "Delete" },
                        { "className": "fa-wpforms", "title": "Requisition Create" },
                        { "className": "fa-list", "title": "Retailer List" },
                        { "className": "fa-file", "title": "View Documents" },

                    ];
                    tooltipArr.forEach(function(item, index) {
                        var tis = $('.' + item.className).parent();
                        tis.attr("title", item.title);
                        tis.tooltip();
                    });
                }
            });
        });

      //view all documents
        function getAllDocuments(shopId){
      	  var modalBody=$('#modal-body');
          	modalBody.css('padding-top',0);
          	modalBody.html('');
      		$.ajax({
      			type: 'Get',
                url:"{{ route('ajax.getAllDocuments') }}",
                data:{shop_id:shopId}
            }) .done(function(response) {
              $('#modal-title').html('All Documents');
              $('#modal-body').html(response);
            })
            .fail(function(response) {
              console.log(response);
          });
          $('#common-modal').modal('show');
      };

      //get distributor(request goes in requisition route)
      function getDepotDistributor(depotId){
      	$('#shop-list').html('');
      	$.ajax({
            type: 'Get',
            url:"{{ route('ajax.getShops') }}",
            data:{depot_id:depotId,distributor:1}
        	}) .done(function(response) {
           $('#shop-list').html(response);

        })
        .fail(function(response) {
        });
      }

      $(document).on('submit','#downloadForm',function(){
    	  	$('#btnDownload').prop('disabled',false);
    	});
       
    </script>
@endcomponent

