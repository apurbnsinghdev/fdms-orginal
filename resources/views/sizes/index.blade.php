@extends('layouts.admin')
@section('title', 'DF Size Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Size</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>DF Size Lists</b></h4>
        <span class="pull-right">
          {!! Html::decode(link_to_route('sizes.download','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('sizes.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				        <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>SI NO.</th>
                            <th>DF Size</th>
                            <th>Rent Amount</th>
                            <th>Installment</th>
                            <th>Availability</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i=1)
                          @foreach ($sizes as $data)
                          <tr>
                            <td>{{$i}}</td>
                          	<td>{{$data->name or ''}}</td>
                          	<td>{{$data->rent_amount or ''}}</td>
                            <td>{{$data->installment or ''}}</td>
                            <td>{{config('myconfig.availability')[$data->availability]}}</td>
                            <td>
                              {!!  Html::decode(link_to_route('sizes.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                              {!! Form::delete(route('sizes.destroy',array($data->id))) !!}
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
