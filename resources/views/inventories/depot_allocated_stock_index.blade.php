@extends('layouts.admin')
@section('title', 'Depot Allocated Stock Lists')
@section('content')
  @php
   $stockId=null;
  @endphp
  @if(!empty(request()->route()->parameters))
    @php
      $stockId=$stock->id;
    @endphp
  @endif
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Depot Allocated Stock</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Depot Allocated Stock Lists</b></h4>
        <span class="pull-right">
          @if(!empty(request()->route()->parameters))
          	  @if($stock->is_allocated == 1)
                {!! Form::open(['url'=>route('inventories.allocationApprove',[request()->route()->parameters['stocks']]),'method'=>'post','class'=>'form-inline-block'])
                     . Form::button('Allocation Approve', ['type'=>'submit','class'=>'btn btn-warning'])
                     .Form::close() !!}
  			      @endif
  			      @if($stock->is_allocated)
              	{!! Html::decode(link_to_route('inventories.allocationPrint','Allocation Print',[request()->route()->parameters['stocks']],array('class'=>'btn btn-info btn-right-side'))) !!}
              @endif
          @endif
          {!! Html::decode(link_to_route('inventories.allocatedStockIndex','<i class="fa fa-list"></i>',[1],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>

  		<div class="panel">
  			<div class="panel-content">
  				<div class="table-responsive">
  					<table id="datatable" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="no-sort">Invoice No.</th>
                  <th>Invoice Date</th>
                  <th class="no-sort">Depot</th>
                  <th class="no-sort">No of Item Type</th>
                  <th>Total Qty</th>
                  <th class="no-sort">Status</th>
                  <th class="no-sort">Action</th>
                </tr>
              </thead>
              <tbody>
            	</tbody>
  					</table>
  				</div>
        </div>
      </div>

  </div>
</div>

 <!-- Modal -->
@include('common_pages.common_modal',['modalTitle'=>'Allocation Stock Details'])
@include('common_pages.common_modal',['modalTitle'=>'Allocated Stock Receive','id'=>'common-modal-2','bodyid'=>'modal-body-2','modalSize'=>'modal-lg'])
@endsection
@component('common_pages.data_table_script')
  @slot('css')
      <style>
        .form-inline-block{
          float: left;
          margin-left: 5px;
          margin-right: 5px;
        }
      .fa.fa-x{
        margin-left: 5px;
      }
      </style>
  @endslot
 <script src="{{ asset('vendor/moment/moment.js') }}"></script>
 <script>
      function showModal(id){
        $.get(laravelObj.appHost+"/get-allocation-details/"+id, function(data, status){
             $('#modal-body').html(data);
          });
          $('#common-modal').modal('show');
      };

      function showModal2(id){
        $.get(laravelObj.appHost+"/allocation-receive/"+id, function(data, status){
             $('#modal-body-2').html(data);
          });
          $('#common-modal-2').modal('show');
      };

      function validateData(selector){
        var tis=$(selector);
        var obj=tis.parents('.receive-tr');
        var allocatedQty=parseInt(obj.find('.allocated-qty').html());
        var receiveObj=obj.find('.receive-qty');
        var damage=obj.find('.damage-qty').val()|0;
        var missing=obj.find('.missing-qty').val()|0;
        var cal=parseInt(allocatedQty-parseInt(damage+missing));
        if(cal<0){
          alert('invalid input');
          tis.val(0).change();
        }else{
          receiveObj.val(cal)
        }
      }
      $(document).ready( function () {
          $('#datatable').DataTable({
              "processing": true,
              "serverSide": true,
              "order": [], /* No ordering applied by DataTables during initialisation */
               "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
                  "order": []
                } ],
              "pageLength": 25,
              "ajax": "{{ route('ajax.depotAllocation.index',[$stockId]) }}",
              "columns": [
                  {
                    "data": "stock.invoice_no",
                    "defaultContent":""
                  },
                  {
                    "data": "stock.invoice_date",
                     render: function(data, type, row){
                          if(type === "sort" || type === "type"){
                              return data;
                          }
                          return moment(data).format("ll");
                      }
                  },
                   {
                    "data": "depot.name",
                    "defaultContent":""
                  },
                   {
                    "data": "no_of_item",
                    "defaultContent":"0"
                  },
                   {
                    "data": "total_qty",
                    "defaultContent":"0"
                  },
                   {
                    "data": "status",
                    "defaultContent":"",
                	render: function (data, type, full, meta) {
                    	if(data == 'receive'){
                        	return 'Received';
                    	}else{
                    		return 'Pending';
                    	}
                    }
                  },
                  {
                    "data": "id",
                    "orderable": false,
                    "bSearchable": false,
                    render: function (data, type, full, meta) {
                      var actions='<a style="cursor:pointer" onclick="showModal('+data+')"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>';
                       if (full.status=='pending' && full.stock.is_allocated == 2){
                         actions+='<a style="cursor:pointer" onclick="showModal2('+data+')"><span aria-hidden="true" class="fa fa-check-square-o fa-x"></span></a>';
                        }
                        return actions;
                      }
                  }
              ],
              "fnDrawCallback": function (oSettings) {
                  var tooltipArr = [
                      { "className": "fa-eye", "title": "View" },
                      { "className": "fa-check-square-o", "title": "Receive" },
                  ];
                  tooltipArr.forEach(function(item, index) {
                      var tis = $('.' + item.className).parent();
                      tis.attr("title", item.title);
                      tis.tooltip();
                  });
              }
          });
      });
    </script>
@endcomponent


