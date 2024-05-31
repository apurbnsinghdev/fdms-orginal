@extends('layouts.admin')
@section('title', 'Zones Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Zones</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@include('zones.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        @include('zones.subtitle')
        <span class="pull-right">
          {!! Html::decode(link_to_route('zones.download','<i class="fa fa-download" aria-hidden="true"></i>',[$param],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('zones.create','<i class="fa fa-plus"></i>',[$param],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>SI NO.</th>
                            <th>Region</th>
                            @if ($param=='1')
                            	<th>Area</th>
                            @endif
                            @if (!$param)
                              <th>Code</th>
                            @endif
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i=1)
                          @foreach ($zones as $data)
                          <tr>
                            <td>{{$i}}</td>
                            @if ($param=='1')
                            	<td>{{$data->parent->name or ''}}</td>
                            @endif
                            <td>{{$data->name}}</td>
                            @if (!$param)
                              <td>{{$data->code or ''}}</td>
                            @endif
                            <td>
                              {!!  Html::decode(link_to_route('zones.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id,$param?$param:'')))!!}
                              {!! Form::delete(route('zones.destroy',array($data->id,'level'=>$param))) !!}
                            </td>
                          </tr>
                          @php ($i=$i+1)
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@component('common_pages.data_table_script')
<script>
    $(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
      });
    });
</script>
@endcomponent

