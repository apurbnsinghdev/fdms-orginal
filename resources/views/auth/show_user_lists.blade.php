@extends('layouts.admin')
@section('title', 'User Lists')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">User</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<!--SEARCHING, ORDENING & PAGING-->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>User Lists</b></h4>
        <span class="pull-right">
          {!! Html::decode(link_to_route('users.download','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('register','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success','style'=>'margin-bottom:10px'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="no-sort">Avatar</th>
                            <th class="no-sort">Name</th>
                            <th class="no-sort">Email</th>
                            <th class="no-sort">Mobile</th>
                            <th>Role</th>
                            <th>Designation</th>
                            <th class="no-sort">Assigned Depot</th>
                            <th class="no-sort">Status</th>
                            <th class="no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i=1)
                          @foreach ($users as $data)
                            <tr>
                            <td>@if($data->avatar) <image width="70" src="{{ asset('storage/images/avatar/'.$data->avatar) }}" /> @else <image width="70" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" /> @endif</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->mobile}}</td>
                            <td>{{$data->role->name or ''}}</td>
                            <td>{{$data->designation->title or ''}}</td>

                            <td style="font-size: 11px">@if ($data->depots->count()){{implode(', ',$depots->whereIn('id',$data->depots->pluck('depot_id'))->pluck('name')->toArray())}} ({{ $depots->whereIn('id',$data->depots->pluck('depot_id'))->pluck('name')->count() }})@endif</td>
                            <td>{{mystudy_case($data->status)}}</td>
                            <td>
                            	 {!!  Html::decode(link_to_route('password.changeUserPassword', '<span aria-hidden="true" class="fa fa-key fa-x"></span>', array($data->id)))!!}
                                 {!!  Html::decode(link_to_route('users.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                                 {!! Form::delete(route('users.destroy',array($data->id))) !!}
                            </td>
                          </tr>
                          @php ($i=$i+1)
                        @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
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
@slot('css')
  <style>
    table.dataTable.nowrap th, table.dataTable.nowrap td{
      white-space: pre-wrap
    }
  </style>
@endslot
@endcomponent



