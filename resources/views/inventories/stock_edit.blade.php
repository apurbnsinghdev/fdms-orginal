@extends('layouts.admin')
@section('title', 'Edit Stock')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stock</a></li>
            <li><a>Edit</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Stock Edit</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('inventories.stockIndex','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model($stocks,array('route' => array('inventories.stockEdit',$stocks->id),'method'=>'PUT','class'=>'form-horizontal')) }}
                    <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                        {{Form::label('supplier:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::select('supplier_id',[''=>'Please Select Supplier']+$suppliers->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Supplier'))}}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                        {{Form::label('Origin:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::select('origin',[''=>'Please Select Origin']+$countries->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Origin'))}}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('invoice_no') ? ' has-error' : '' }}">
                        {{Form::label('invoice_no:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::text('invoice_no',null,array('class' => 'form-control'))}}
                            {!! $errors->first('invoice_no', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('invoice_date') ? ' has-error' : '' }}">
                        {{Form::label('invoice_date:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                {{Form::text('invoice_date',old('invoice_date')?:$stocks->invoice_date->format('Y-m-d'),array('class' => 'form-control datepicker'))}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('lc_no') ? ' has-error' : '' }}">
                        {{Form::label('lC_no:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::text('lc_no',null,array('class' => 'form-control'))}}
                            {!! $errors->first('lc_no', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('lc_date') ? ' has-error' : '' }}">
                        {{Form::label('lC_date:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            <div class="input-group">
                                @if ($stocks->lc_date)
                                    @php
                                        $lcdate=$stocks->lc_date->format('Y-m-d');
                                    @endphp
                                @else
                                    @php
                                        $lcdate=null;
                                    @endphp
                                @endif
                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                {{Form::text('lc_date',old('lc_date')?:$lcdate,array('class' => 'form-control datepicker'))}}
                            </div>
                        </div>
                    </div>
                     <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                        {{Form::label('currency:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::text('currency',null,array('class' => 'form-control'))}}
                        </div>
                    </div>

                @if (!$stocks->is_allocated)
                    <div class="from-group">
                        @if (count($errors->get('details.*'))>0)
                            <div class="alert alert-danger" style="width:64%;padding: 5px;    margin-bottom: 10px;margin-left: 38px;">
                                <ul>
                                    <li>Size,Brand & Quantity cann't be blank</li>
                                    <li>Unit price should be a number or blank</li>
                                </ul>
                            </div>
                        @endif
                        @if(request()->old('details'))
                            <stockdetails :brands="{{ $brands }}" :sizes="{{ $sizes }}" :details="{{ collect(request()->old('details')) }}"/>
                        @else
                        	@if($stocks->stock_details)
                            <stockdetails :brands="{{ $brands }}" :sizes="{{ $sizes }}" :details="{{$stocks->stock_details}}"/>
                            @else
                            <stockdetails :brands="{{ $brands }}" :sizes="{{ $sizes }}" :details="[]"/>
                            @endif
                        @endif
                    </div>
                @endif

					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@component('common_pages.selectize')
    <script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
         $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent


