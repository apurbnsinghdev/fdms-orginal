@extends('layouts.admin')
@section('title', 'Allocate Stock')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stock</a></li>
            <li><a>Allocate</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Stock Allocate</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('inventories.stockIndex','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            {{-- {{ $ stock }} --}}
            <div class="panel-content">

                <div class="row">
                    <h4 class="col-md-12 section-subtitle">Item Details</h4>
                    @foreach ($stock->stock_details as $ke=>$va)
                   @if ($va->brand)
                        @php
                            $df=$va->brand->short_code.'-'.$va->size->name;
                        @endphp
                    @else
                        @php
                            $df=$va->size->name;
                        @endphp
                    @endif
                    <div class="col-md-3">
                          <table class="table">
                            <tr>
                                <th>Stock Item :</th>
                                <td>{{$df}}</td>
                            </tr>
                            <tr>
                                <th>Total Qty</th>
                                <td>
                                    <span class="badge x-danger">{{ $va->qty}}</span>
                                    <input type="hidden" name="m[]" id="m-{{$df}}" value="{{ $va->qty}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Allocated Qty</th>
                                <td><span class="badge x-info" id="p-{{$df}}">0</span></td>
                            </tr>
                             <tr>
                                <th>Remain Qty</th>
                                <td><span class="badge x-success" id="r-{{$df}}">{{ $va->qty}}</span></td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>


                <div class="row">
                    {{ Form::model(request()->old(),array('route' => array('inventories.stockAllocate',$stock->id),'class'=>'form-horizontal')) }}
                    <h4 class="col-md-12 section-subtitle">Item Allocation</h4>
                    @foreach ($depots as $dkey=>$dval)
                    <div class="widget-list list-to-do col-md-4">
                        <h4 class="list-title">
                            {{ $loop->iteration }}.{{ $dval }}
                            {{ Form::hidden("data[$loop->iteration][depot_id]",$dkey) }}
                        </h4>
                        <ul class="bodyul">
                            @foreach ($stock->stock_details as $dkey=>$dval)
                            @if ($dval->brand)
                                @php
                                    $dff=$dval->brand->short_code.'-'.$dval->size->name;
                                @endphp
                            @else
                                @php
                                    $dff=$dval->size->name;
                                @endphp
                            @endif
                            <li>
                                <div class="form-group">
                                    {{Form::label($dff,null,array('class' => 'control-label col-sm-4'))}}
                                    <div class="col-md-8">
                                        {{Form::number('data['.$loop->parent->iteration.'][details]['.$dval->id.']',null,array('class' => 'form-control c-'.$dff,'onChange'=>"countVal('".$dff."',this)",'onfocus'=>"countVal('".$dff."',this)", 'min'=>0))}}
                                    </div>
                                </div>
                            </li>
                           @endforeach
                        </ul>
                    </div>
                    @endforeach

    				<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Allocate
                            </button>
                        </div>
                    </div>
				    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(".bodyul:first input.form-control").focus();
        });
       function countVal(className,selector){
            var tis=$(selector);
            var sum = 0;
            var mainVal=$('#m-'+className).val();

            $('.c-'+className).each(function(){
                sum += $(this).val()|0;
            });
            if(mainVal<sum){
                tis.val(0).change();
                alert('please reduse quantity for '+ className);
            }else{
                $('#p-'+className).html(sum);
                $('#r-'+className).html(mainVal-sum);
            }
       }
    </script>
@stop



