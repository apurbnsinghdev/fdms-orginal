@extends('layouts.admin')
@section('title', 'Depot Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Depot</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Depot Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('depots.download','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('depots.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>SI NO.</th>
                            <th>Division</th>
                            <th>District</th>
                            <th>Thana</th>
                            <th>Region</th>
                            <th>Area</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th class="no-sort">Address</th>
                            <th class="no-sort">Has Incharge</th>
                            <th class="no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php ($i=1)
                        @foreach ($depots as $data)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$data->division->name or ''}}</td>
                                <td>{{$data->district->name or ''}}</td>
                                <td>{{$data->thana->name or ''}}</td>
                                <td>{{$data->region->name or ''}}</td>
                                <td>{{$data->area->name or ''}}</td>
                                <td>{{$data->name or ''}}</td>
                                 <td>{{$data->code or ''}}</td>
                                <td>{{$data->address or ''}}</td>
                                <td class="checkbox-custom checkbox-success">
                                	{{Form::checkbox('has_incharge',null, $data->has_incharge,array('id'=>'has_incharge','disabled' ,'readonly'))}}
                                	{{Form::label('', '', array('for'=>"has_incharge",'class'=>"check"))}}
                                </td>
                                <td>
                                    {!!  Html::decode(link_to_route('depots.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                                    {!! Form::delete(route('depots.destroy',array($data->id))) !!}
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

