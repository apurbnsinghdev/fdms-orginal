@extends('layouts.admin')
@section('title', 'Stock Transfer Create')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stock Transfer</a></li>
            <li><a>Create</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Stock Transfer Create</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('inventories.stockTransferLists','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

				{{ Form::model(request()->old(),array('route' => array('inventories.stockTransferCreate', $transferFrom),'class'=>'form-horizontal')) }}
					<div class="row">
						<div class="col-md-6">
							 <div class="form-group{{ $errors->has('transfer_from') ? ' has-error' : '' }}">
		                        {{Form::label('transfer_from:',null,array('class' => 'control-label col-sm-4 '))}}
		                        <div class="col-md-8">
		                            {{Form::select('transfer_from',[''=>'Please Select Depot']+$depots->toArray(),$transferFrom,array('class' => 'form-control select2','data-placeholder'=>'Please Select Supplier'))}}
		                        </div>
		                    </div>
						</div>
						<div class="col-md-6">
							 <button type="submit" name="submit" value="search" class="btn btn-info">
                                Search For Available DF
                            </button>
						</div>
					</div>
					@php
						$transferFrom = $transferFrom? $transferFrom : request()->old('transfer_from');
					@endphp
					@if($transferFrom)
					<br /><br />
                    <h4 class="section-subtitle"><b>{{ $depots->get($transferFrom) }} Depot Stock Availability</b></h4>


                    <div class="row">
                    	<div class="col-md-8">
							<div class="table-responsive">

		                    	<table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
		                    		<thead>
										<tr>
											<th>Brand</th>
											<th>Size</th>
											<th>Available Qty.</th>
											<th>Remaining Qty.</th>
											<th>Transfer Qty.</th>
										</tr>
									</thead>
									<tbody>
									@foreach ($availableDfs as $key=>$ele)

									@php
										$qty = '';
										if(old('data')){
											$qty = old('data')[$key]['qty'];
										}
									@endphp
										<tr>
											<td>{{ $ele->brand->short_code or '' }}</td>
											<td>{{ $ele->size->name or '' }}</td>
											<td>{{ $ele->total or 0 }}</td>
											<td class="text-danger">{{ $ele->total or 0 }}</td>
											<td width="30%">
												<input type="hidden" name="data[{{$key}}][brand_id]" value="{{$ele->brand->id}}">
												<input type="hidden" name="data[{{$key}}][size_id]" value="{{$ele->size->id}}">
												<input oninput="javascript: if (this.value > this.maxLength) this.value = this.maxLength" maxlength="{{ $ele->total or 0 }}" onchange="remainCheck(this)"  class="form-control" type="number" name="data[{{$key}}][qty]" value="{{$qty}}"></td>
										</tr>
									@endforeach
									</tbody>
								</table>
		                    </div>
                    	</div>
                    	<div class="col-md-4">
	                    	<div class="form-group{{ $errors->has('transfer_to') ? ' has-error' : '' }}">
		                        {{Form::label('transfer_to:',null,array('class' => 'control-label col-sm-4'))}}
		                        <div class="col-md-8">
		                            {{Form::select('transfer_to',[''=>'Please Select Depot']+$trasferDepots->toArray(),old('transfer_to'),array('class' => 'form-control select2','data-placeholder'=>'Please Select Depot'))}}
		                        </div>
	                   		</div>
                    	</div>
                    </div>

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" name="submit" value="transfer" class="btn btn-primary">
                                Transfer
                            </button>
                        </div>
                    </div>
                    @endif
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@component('common_pages.data_table_script')
<script>
	function remainCheck(selector){
		var tis=$(selector);
		$maxQty=tis.attr('maxlength');
		$needQty=tis.val();
		tis.parent().prev().html($maxQty-$needQty)
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



