@extends('layouts.admin')
@section('title', 'Stock Transfer Lists')
@section('content')
@php
  $authUserId=auth()->user()->id;
  $stockTransferApprove=$stockTransferReceive=$stockTransferUpdate=$stockTransferCancel=false;
@endphp
@if(isMenuRender('InventoriesControler@stockTransferReceive',$menu_list))
   @php
     $stockTransferReceive=true;
   @endphp
@endif
@if(isMenuRender('InventoriesControler@stockTransferApprove',$menu_list))
   @php
     $stockTransferApprove=true;
   @endphp
@endif
@if(isMenuRender('InventoriesControler@stockTransferUpdate',$menu_list))
   @php
     $stockTransferUpdate=true;
   @endphp
@endif
@if(isMenuRender('InventoriesControler@stockTransferCancel',$menu_list))
   @php
     $stockTransferCancel=true;
   @endphp
@endif

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stock Transfer</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Stock Transfer Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('inventories.stockTransferCreate','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                	<table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                		<thead>
							<tr>
								<th>Placed By</th>
								<th>Placed Date</th>
								<th>From Depot</th>
								<th>To Depot</th>
								<th>Transfer Qty</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
						@foreach ($transferlists as $key=>$ele)
							<tr>
								<td>{{$ele->placed_by}}</td>
								<td>{{$ele->placed_date}}</td>
								<td>{{$ele->from_depot}}</td>
								<td>{{$ele->to_depot}}</td>
								<td>
									{{$ele->placed_qty}} (
									@foreach ($ele->stock_transfer_details as $e)
										model: {{$e->brand->short_code}}-{{$e->size->name}},
										total: {{$e->placed_qty}}
										@if (!$loop->last)
											<br>
										@endif

									@endforeach
									)
								</td>
								<td>
                  <a href="{{route('inventories.getStockTransferChalan', $ele->id)}}"><span aria-hidden="true" class="fa fa-download fa-x"></span></a>

                   @if($ele->status=='approve')
                      @if ($stockTransferReceive)
                          <a style="cursor:pointer" onclick="showReceivedModal({{$ele->id}})">
                              <span aria-hidden="true" class="fa fa-check-square-o fa-x"></span>
                          </a>
                      @endif
                    @else

                      @if($stockTransferApprove)

                       <a href="{{route('inventories.stockTransferApprove', $ele->id)}}"><span aria-hidden="true" class="fa fa-check-square fa-x"></span></a>
                       @endif

                      @if ($stockTransferUpdate)
                       <a style="cursor:pointer" onclick="showUpdateModal({{$ele->from_depot_id}}, {{$ele->id}})"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>
                      @endif
                      @if ($stockTransferCancel)
                        {!! Form::open(['route' => 'inventories.stockTransferCancel', 'class'=>'delete-form']) !!}
                        <input type="hidden" name="stock_transfer_id" value="{{$ele->id}}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-xs" title="" data-original-title="Delete"><span aria-hidden="true" class="fa fa-times-circle"></span></button>
                        {!! Form::close() !!}
                      @endif

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
<!-- Modal -->
@include('common_pages.common_modal',['id'=>'receive-modal', 'bodyid'=>'receive-modal-body', 'modalTitle'=>'Allocated Stock Receive'])
@include('common_pages.common_modal',['id'=>'update-modal', 'bodyid'=>'update-modal-body', 'modalTitle'=>'Allocated Stock Update'])

@endsection
@component('common_pages.data_table_script')
<script>
  function remainCheck(selector){
    var tis=$(selector);
    $maxQty=tis.attr('maxlength');
    $needQty=tis.val();
    tis.parent().prev().html($maxQty-$needQty)
  }
	function showReceivedModal(id){
            $.get(laravelObj.appHost+"/stock-transfer-show/"+id, function(data, status){
               $('#receive-modal-body').html(data);
            });
            $('#receive-modal').modal('show');
        };

    function showUpdateModal(from_depot_id, transfer_id){
        $.get(laravelObj.appHost+"/stock-transfer-edit/"+from_depot_id+'/'+transfer_id, function(data, status){
           $('#update-modal-body').html(data);
        });
        $('#update-modal').modal('show');
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

  	$(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
        "paging": false
      });
  });
</script>
@endcomponent



