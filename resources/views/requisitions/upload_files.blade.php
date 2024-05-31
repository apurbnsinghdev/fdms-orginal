@extends('layouts.admin')
@section('title', 'Upload Files')
@section('content')

@php
	$requisition_file = config('myconfig.requisition_file');
	unset($requisition_file[array_search('deed_paper',$requisition_file)]);
@endphp
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Upload Files</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Upload Files</b></h4>
        <span class="pull-right">
             @if(url()->previous() == url()->current())
            	{!! Html::decode(link_to_route('requisitions.index','<i class="fa fa-list"></i>',['new'],array('class'=>'btn btn-success btn-right-side'))) !!}
            @else
            	{!! Html::decode(link_to(url()->previous(),'<i class="fa fa-list"></i>',array('class'=>'btn btn-success btn-right-side'))) !!}
            @endif
        </span>
        <div class="panel">
            <div class="panel-content">
			    {{ Form::model($requisitions,array('route' => array('requisitions.update',$requisitions->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

					<div class="form-group">
						{{Form::label('shop:',null,array('class' => 'control-label col-sm-2'))}}
						<div class="col-md-6 pt-sm">
			                 <strong>{{$requisitions->shop->outlet_name}}</strong>
						</div>
					</div>

                    {{ Form::hidden('size_id',$requisitions->size_id)  }}
                    {{ Form::hidden('payment_modes',$requisitions->payment_modes)  }}
                    {{ Form::hidden('payment_methods',$requisitions->payment_methods)  }}
                    {{ Form::hidden('distance_from_dist',$requisitions->distance_from_dist)  }}

                    {{-- shop's file upload start --}}
					@if($requisitions->doc_verified !='yes')
    					@foreach(config('myconfig.shop_file') as $value)
    							<div class="form-group">
                            {{Form::label($value.':',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-6">
                                {{Form::file($value)}}
                                {!! $errors->first($value, '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <div class="col-md-2 preview-div">
                                 @if ($documents->has($value))
                                    <a href="{{ asset('storage/images/'.$requisitions->shop_id.'/'.$documents[$value]) }}" target="_blank">{{ $documents[$value] }}</a>
                                  {{ Form::hidden('old_'.$value,$documents[$value])  }}
                                @endif
                            </div>
                        </div>
    					@endforeach
					@endif
					{{-- shop's file upload end --}}

                    @if ($requisitions->payment_modes != 'without_rent')
                        @if (($requisitions->payment_methods == 'bank' || $requisitions->payment_methods == 'cash') && !$requisitions->payment_verified && $requisitions->doc_verified != 'yes')
                        <div class="form-group">
                            {{Form::label('Money Receipt:',null,array('class' => 'control-label col-sm-2'))}}
                            <div class="col-md-6">
                                {{Form::file('money_receipt')}}
                                {!! $errors->first('money_receipt', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <div class="col-md-2 preview-div">
                                @if ($documents->has('money_receipt'))
                                    <a href="{{ asset('storage/images/'.$requisitions->shop_id.'/'.$documents['money_receipt']) }}" target="_blank">{{ $documents['money_receipt'] }}</a>
                                  {{ Form::hidden('old_money_receipt',$documents['money_receipt'])  }}
                                @endif
                            </div>
                        </div>
                         @endif
                    @endif

                    @if(!$requisitions->doc_verified)
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" name="upload_file" class="btn btn-primary">
                                    Update Documents
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
@component('common_pages.selectize')
  @slot('css')
    <style>
        .checkbox-custom label.check{
            font-weight:bold;
        }
    </style>
  @endslot
@endcomponent