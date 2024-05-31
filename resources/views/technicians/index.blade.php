@extends('layouts.admin')
@section('title', 'Problem Type Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Technician</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Technician Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('technicians.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>SI NO.</th>
                            <th>Depot</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i=1)
                          @foreach ($technicians as $data)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$data->depot->name or ''}}</td>
                          	<td>{{$data->name}}</td>
                          	<td>{{$data->mobile}}</td>
                          	<td>{{$data->status}}</td>
                            <td>
                              {!!  Html::decode(link_to_route('technicians.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                               {!! Form::delete(route('technicians.destroy',array($data->id))) !!}
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
        "order": [], /* No ordering applied by DataTables during initialisation */}
      );
  });
</script>
@endcomponent

