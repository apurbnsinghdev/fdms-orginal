@extends('layouts.admin')
@section('title', 'Stock Transfer Create')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Depot</a></li>
            <li><a>Hold DF Qty</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Hold DF Qty</b></h4>
       <span class="pull-right">
            {!! Html::decode(link_to_route('depotsHoldQty.download','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                    <div class="row">
                        <div class="col-md-4">
                             <div class="form-group{{ $errors->has('depot_id') ? ' has-error' : '' }}">
                                {{Form::label('depot_id:',null,array('class' => 'control-label col-sm-3'))}}
                                <div class="col-md-9">
                                    {{Form::select('depot_id',['0'=>'Please Select Depot']+$depots->toArray(),$depotId,array('class' => 'form-control select2','data-placeholder'=>'Please Select Supplier','id'=>'depotId'))}}
                                </div>
                            </div>
                        </div>
                    </div>

                @if($depotId)
                    <br /><br />
                    <h4 class="section-subtitle"><b>{{ $depots->get($depotId) }} Depot Stock Availability</b></h4>
                    {{ Form::model(request()->old(),array('route' => array('depots.holdDFQty',$depotId),'method' => 'PUT','class'=>'form-horizontal')) }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Brand</th>
                                                <th>Size</th>
                                                <th>Available Qty.</th>
                                                <th>Remaining Qty.</th>
                                                <th>Hold Qty.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($availableDfs as $key=>$ele)

                                        @php
                                            $key = $ele->brand->id.'.'.$ele->size->id;
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
                                                    <input type="hidden" name="data[{{$key}}][depot_id]" value="{{$depotId}}">
                                                    <input type="hidden" name="data[{{$key}}][brand_id]" value="{{$ele->brand->id}}">
                                                    <input type="hidden" name="data[{{$key}}][size_id]" value="{{$ele->size->id}}">
                                                    <input oninput="javascript: if (this.value > this.maxLength) this.value = this.maxLength" maxlength="{{ $ele->total or 0 }}" onchange="remainCheck(this)"  class="form-control remain-check" type="number" name="data[{{$key}}][qty]" value="{{$holdStocks->has($key)?$holdStocks->get($key):$qty}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <button type="submit" name="submit" value="transfer" class="btn btn-primary">
                                        Hold
                                    </button>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                @else
                <br /><br />
                <h4 class="section-subtitle text-danger"><b>Please Select Any Depot</b></h4>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@component('common_pages.data_table_script')
<script>
     $(document).on('change','#depotId',function(){
        var url='{{ route('depots.holdDFQty',['depotId']) }}';
        //console.log(url.replace('depotId',this.value));
        window.location.href=url.replace('depotId',this.value);
    });
    function remainCheck(selector){
        var tis=$(selector);
        $maxQty=parseInt(tis.attr('maxlength'));
        $needQty=parseInt(tis.val());
        if($maxQty < $needQty){
        	$qty = 0;
        }else{
        	$qty = $maxQty-$needQty;
        }
        
        tis.parent().prev().html($qty)
    }

    $(document).ready(function(){
        var obj=$('.remain-check');
        obj.each(function(tis,val){
            remainCheck(val);
        });
    });

  $(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
        "paging": false
      });
  });
</script>
@endcomponent



