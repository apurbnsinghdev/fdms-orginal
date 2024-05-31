@extends('layouts.admin')
@section('title', 'Requisition Lists')
@section('content')
@php
  $authUserId=auth()->user()->id;
  $payment_verify=$bkash_verify=$document_verify=$freeze_assign=$generate_gatepass= $approve_all=false;
@endphp
@if(isMenuRender('RequisitionsController@payment_verify',$menu_list))
   @php
     $payment_verify=true;
   @endphp
@endif

@if(isMenuRender('RequisitionsController@bkash_verify',$menu_list))
   @php
     $bkash_verify=true;
   @endphp
@endif

@if(isMenuRender('RequisitionsController@document_verify',$menu_list))
   @php
     $document_verify=true;
   @endphp
@endif

@if(isMenuRender('RequisitionsController@freeze_assign',$menu_list))
    @php
     $freeze_assign=true;
   @endphp
@endif

@if(isMenuRender('RequisitionsController@generate_gatepass',$menu_list))
   @php
     $generate_gatepass=true;
   @endphp
@endif

@if(isMenuRender('RequisitionsController@approveAll',$menu_list))
   @php
     $approve_all=true;
   @endphp
@endif
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@include('requisitions.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b class="text-capitalize">{{ mystudy_case($param) }} Requisitions</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('requisitions.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

            @if ($param == 'new' && ($approve_all) && ($requisitions->count() > 0))
            	 {{ Form::model([],array('route' => array('requisitions.approveAll'),'id'=>'frm-datatable')) }}
              @endif

		            <div class="table-responsive">
                  @component('requisitions.common_list_component',[
                    'isExecutive'=>$isExecutive,
                    'actionsArr'=>$actionsArr,
                    'requisitions'=>$requisitions,
                    'payment_verify'=>$payment_verify,
                    'bkash_verify'=>$bkash_verify,
                    'document_verify'=>$document_verify,
                    'freeze_assign'=>$freeze_assign,
                    'generate_gatepass'=>$generate_gatepass,
                    'authUserId'=>$authUserId,
                    'param'=>$param,
                    'approve_all'=> $approve_all
                    ])
                  @endcomponent
                </div>

        				@if ($param == 'new' && ($approve_all) && ($requisitions->count() > 0))
        					 <input type="hidden" name="stage" value="{{$requisitions[0]->stage}}">
                    <p class="form-group">
                       <button type="submit" class="btn btn-primary">Approve All</button>
                    </p>
                  {{ Form::close() }}
        				@endif

            </div>
        </div>
    </div>
</div>

@include('common_pages.common_modal',['modalTitle'=>'Check bKash Transaction'])

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

  $(function(){

        "use strict";
        var table = $('.data-table').DataTable({
            //"aaSorting": [],  /* Disable initial sort Older version*/
            "order": [], /* No ordering applied by DataTables during initialisation */
            "pageLength": 25,
            "columnDefs": [ {
              "targets": 'no-sort',
              "orderable": false,
              "order": []
            } ]
        });

   // Handle click on "Select all" control
      $('#datatable-select-all').on('click', function(){
         // Get all rows with search applied
         var rows = table.rows({ 'search': 'applied' }).nodes();
         // Check/uncheck checkboxes for all rows in the table
         $('input[type="checkbox"]', rows).prop('checked', this.checked);
      });

      // Handle click on checkbox to set state of "Select all" control
      $('#datatable tbody').on('change', 'input[type="checkbox"]', function(){
         // If checkbox is not checked
         if(!this.checked){
            var el = $('#datatable-select-all').get(0);
            // If "Select all" control is checked and has 'indeterminate' property
            if(el && el.checked && ('indeterminate' in el)){
               // Set visual state of "Select all" control
               // as 'indeterminate'
               el.indeterminate = true;
            }
         }
      });
  });

  function getDetails(id){
     var modalBody=$('#modal-body');
      modalBody.css('padding-top',0);
      modalBody.html('');
      $('#modal-title').html('Requisition Details');
     $.get(laravelObj.appHost+"/get-requisition-details/"+id, function(data, status){
         modalBody.html(data);
      });
    $('#common-modal').modal('show');
  }

  function getShopDetails(id){
    var modalBody=$('#modal-body');
        modalBody.html('');
        $('#modal-title').html('Shop Details');
        modalBody.css('padding-top',0);
       $.get(laravelObj.appHost+"/get-shop-details/"+id, function(data, status){
          modalBody.html(data);
      });
      $('#common-modal').modal('show');
  };

  function showModal(selector){
    var tis=$(selector);
    var functionName=tis.data('name');
    var dataId=tis.data('id');
    var stage = tis.data('stage');
    $('#modal-title').html('');
     $.get(laravelObj.appHost+"/stage-action-oparation/"+dataId+"/"+functionName + '/' + stage, function(data, status){
         $('#modal-body').html(data);
      });
    $('#common-modal').modal('show');
  }

  function saveAction(formId){

    //serializeObject function is custom function get in custom.js
    var datas=$(formId).serializeObject();
    	$('#confirm-btn').attr('disabled',true);
	  $.ajax({
          type: 'POST',
          url:"{{ route('ajax.stage.saveAction') }}",
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
      });
  }

	//show modal and get existing transaction id
	function getTransactionId(id){
		var modalBody=$('#modal-body');
      	modalBody.css('padding-top',0);
      	modalBody.html('');
     	var idd=id;
		$.ajax({
			type: 'Get',
            url:"{{ route('ajax.getTransactionId') }}",
            data:{id:idd}
        }) .done(function(response) {
          $('#modal-title').html('Check bKash Transaction');
          $('#modal-body').html(response);
        })
        .fail(function(response) {
          console.log(response);
      });
      $('#common-modal').modal('show');
  }

	//add or edit transaction id
  function putTransactionId(formId){
	  var datas=$(formId).serializeObject();
	  $.ajax({
          type: 'POST',
          url:"{{ route('ajax.putTransactionId') }}",
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
            if(response.data){
                var strHtml = '<tr><td>'+response.data.transaction_id+'</td><td>'+response.data.receive_amount+'</td></tr>';
               	var strHtml2 ='<tr><td class="text-right"><strong>Total Paid=</strong></td><td id="total">'+response.data.bkashAmount+'</td>'+
                			'<tr><td class="text-right"><strong>Total Due=</strong></td><td id="total_due">'+response.data.due+'</td>'+
                $('#current_transaction').after(strHtml);
                var searchId = $('#no_data').length;
                console.log(searchId);
                if(searchId){
                	$('#no_data').before(strHtml2);
                    $('#no_data').remove();
                }else{
                	$('#total').html(response.data.bkashAmount);
                    $('#total_due').html(response.data.due);
                }
            }
          $('#error').html(response.message);
        }else if(response.error && response.success){
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
    	  console.log(response);
      });
	}


  function shopCompareModal(returnId){
    var modalBody=$('#modal-body');
        modalBody.html('');
        modalBody.css('padding-top',0);
        $('#modal-title').html('Shop Details');
       $.get(laravelObj.appHost+"/get-shop-compare-details/"+returnId, function(data, status){
          modalBody.html(data);
      });
      $('#common-modal').modal('show');
  }

  //view all documents
  function getAllDocuments(shopId, requisitionId){
	  var modalBody=$('#modal-body');
    	modalBody.css('padding-top',0);
    	modalBody.html('');
		$.ajax({
			type: 'Get',
          url:"{{ route('ajax.getAllDocuments') }}",
          data:{shop_id:shopId,requisition_id:requisitionId}
      }) .done(function(response) {
        $('#modal-title').html('All Documents');
        $('#modal-body').html(response);
      })
      .fail(function(response) {
        console.log(response);
    });
    $('#common-modal').modal('show');
  }


</script>
@endcomponent

