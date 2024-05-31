@extends('layouts.admin')
@section('title', 'DF Return List')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">DF Return</a></li>
            <li><a>List</a></li>
        </ul>
    </div>
</div>
@include('df_returns.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>DF Return List</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('returns.apply','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
            	<div class="table-responsive">
                    <table id="basic-table" class="action-table data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="no-sort">Officer</th>
                            <th class="no-sort">From Shop</th>
                            <th>Depot</th>
                            <th class="no-sort">Return DF</th>
                            <th class="no-sort">Reason</th>
                            <th class="no-sort">Last Action By</th>
                            <th class="no-sort">Withdrawal Date</th>
                            <th class="no-sort">To Shop</th>
                            <th class="no-sort">Requisition</th>
                            <th class="no-sort">View Shop</th>
                            <th class="no-sort">&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($dfreturns as $data)
                            <tr>
                              <td>{{$data->creator->name or ''}}</td>
                            	<td>{{$data->shop->outlet_name or ''}}</td>
                              <td>{{$data->depot->name or ''}}</td>
                              <td>{{$data->currentdf->serial_no or ''}}</td>
                              <td>{{$data->return_reason}}</td>
                              <td>{{$data->stager->name or ''}}</td>
                              <td>{{$data->withdrawal_date->toFormattedDateString()}}</td>
                              <td>
                                @if ($data->to_outlet)
                                  {{$data->to_outlet->outlet_name or ''}}
                                @endif
                                &nbsp;
                              </td>
                              <td>
                                @if ($data->is_requisition_created)
                                  <span class="text-success">Yes</span>
                                @else
                                  <span class="text-warning">No</span>
                                @endif
                            </td>
                            <td>
                              <a style="cursor:pointer" onclick="shopCompareModal('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>
                            </td>
                              <td>
                                @if ($param=='new'||$param=='on_hold')
                                  @include('df_returns.'.$param)
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  @include('common_pages.common_modal',['modalTitle'=>'Shop Details'])
@endsection
@component('common_pages.data_table_script')
@slot('css')
    <style>
      .dropup, .dropdown{
        display: inline-block;
      }
      .dropdown-menu{
        right: 0;
        left:auto;
      }
    </style>
@endslot
<script>
  //show modal for details view
  function showModal(id){
    var modalBody=$('#modal-body');
        modalBody.html('');
        modalBody.css('padding-top',0);
        $('#modal-title').html('Shop Details');
       $.get(laravelObj.appHost+"/get-shop-details/"+id, function(data, status){
          modalBody.html(data);
      });
      $('#common-modal').modal('show');
  };

  function shopCompareModal(returnId){
    var modalBody=$('#modal-body');
        modalBody.html('');
        modalBody.css('padding-top',0);
        $('#modal-title').html('Shop Details');
       $.get(laravelObj.appHost+"/get-shop-compare-details/"+returnId, function(data, status){
          modalBody.html(data);
      });
      $('#common-modal').modal('show');
  };

  function showModal2(selector){
	    var tis=$(selector);
	    var functionName=tis.data('name');
	    var dataId=tis.data('id');
	    var stage = tis.data('stage');
      $('#modal-title').html('');
	     $.get(laravelObj.appHost+"/stage-action-oparation/"+dataId+"/"+functionName + '/' + stage + '/return', function(data, status){
	         $('#modal-body').html(data);
	      });
	    $('#common-modal').modal('show');
	  };

  function saveAction(formId){
	  $('#confirm-btn').attr('disabled',true);
	    //serializeObject function is custom function get in custom.js
	    var datas=$(formId).serializeObject();
		  $.ajax({
	          type: 'POST',
	          url:"{{ route('ajax.stage.saveAction',['return']) }}",
	          data:datas
	      }) .done(function(response) {
	        toastr.options = {
	          "progressBar": true,
	          "positionClass": "toast-top-center",
	          "timeOut": 2000,
	          "showEasing": "swing",
	          "hideEasing": "linear",
	          "showMethod": "slideDown",
	          "hideMethod": "fadeOut"
	        };

	        if (response.error && response.success){
	          $('#error').html(response.message);
	          $('#confirm-btn').attr('disabled',false);
	        }else if(response.error && !response.success){
	            toastr.warning('', '<h5 style="margin-top: 5px; margin-bottom: 0px;"><b>'+response.message+'!</b></h5>');
	            setTimeout(function() {
	               location.reload();
	            }, 2001);
	        }else if(!response.error && response.success){
	            toastr.success('', '<h5 style="margin-top: 5px; margin-bottom: 0px;"><b>'+response.message+'!</b></h5>');
	            setTimeout(function() {
	               location.reload();
	            }, 2001);
	        }
	      })
	      .fail(function(response) {
	    	  $('#confirm-btn').attr('disabled',false);
	    	  console.log(response);
	      });
	  };

  $(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
        "pageLength": 25,
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
          "order": []
        } ]
      });
  });
</script>
@endcomponent

