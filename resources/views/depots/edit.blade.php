@extends('layouts.admin')
@section('title', 'Update Depot')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Depot</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Depot Update</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('depots.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
               {{ Form::model($depots,array('route' => array('depots.update',$depots->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}

                    @include('common_pages.location_zone_dropdown_edit')

                    <div class="row mb-md">
                        <div class="col-md-12 ">
                            <hr>
                            <div class="form-group">
                                {{Form::label('',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-8 checkbox-custom checkbox-success">
                                   {{Form::checkbox('has_incharge',1, $depots->has_incharge,['id'=>'has_incharge'])}}
                                   {{Form::label('has_incharge',null,array('for'=>'has_incharge','class' => 'check'))}}
                                </div>
                            </div>
                            @if(count($depotUsers))
                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                {{Form::label('Authorized User:',null,array('class' => 'control-label col-sm-2 require'))}}
                                <div class="col-md-8">
                                	{{Form::select('user_id',[''=>'Please Select..'] + $depotUsers,$depots->user_id,array('class' => 'form-control'))}}
                                	{!! $errors->first('user_id', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                            @endif
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {{Form::label('depot name:',null,array('class' => 'control-label col-sm-2 require'))}}
                                <div class="col-md-8">
                                    {{Form::text('name',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                {{Form::label('depot code:',null,array('class' => 'control-label col-sm-2 require'))}}
                                <div class="col-md-8">
                                    {{Form::text('code',null,array('class' => 'form-control'))}}
                                    {!! $errors->first('code', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {{Form::label('address:',null,array('class' => 'control-label col-sm-2'))}}
                                <div class="col-md-8">
                                    {{Form::textarea('address',null,array('class' => 'form-control'))}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                UPDATE
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('vuescript')
<script>
    laravelObj.division_id='{{ $depots->division_id or '' }}';
    laravelObj.districts = JSON.parse('{!! $districts or '' !!}');
    laravelObj.district_id='{{ $depots->district_id or '' }}';
    laravelObj.thanas =JSON.parse('{!! $thanas or '' !!}');
    laravelObj.thana_id ='{{ $depots->thana_id or '' }}';
    laravelObj.region_id='{{ $depots->region_id or '' }}';
    laravelObj.areas=JSON.parse('{!! $areas or '' !!}');
    laravelObj.area_id='{{ $depots->area_id or '' }}';
</script>
@stop
@section('script')
    <script>
        $('#has_incharge').change(function() {
          if (!this.checked) {
            var conf=confirm('Are you sure ? All the applications will be directly forwared to RSM onwards.');
            if(conf){
                return true;
            }else{
                this.checked=true;
            }
          }
        });
    </script>
@stop