@extends('layouts.admin')
@section('title', 'Roles List')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Role</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Roles List</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('roles.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
          <div class="panel-content">
            <div class="table-responsive">
              <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0">
                <thead>
                  <tr>
                    <th>SI#</th>
                    <th>Role Name</th>
                    <th>Description</th>
                    <th class="center">Created</th>
                    <th>Updated</th>
                    <th>Status</th>
                    <th>Can Apply</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php  $options=''; $i=1; @endphp
                  @foreach ($roles as $data)
                  @php
                    $options .= '<option value="' . $data->id . '">' . $data->name . '</option>';
                  @endphp
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$data->name}}</td>
                    <td>{!!$data->description!!}</td>
                    <td>{{showDateWithFormat($data->created_at)}}</td>
                    <td>{{showDateWithFormat($data->updated_at)}}</td>
                    <td>{{$data->status}}</td>
                    <td>
                      @if ($data->can_apply)
                        <i class="fa fa-check text-success"></i>
                      @else
                          <i class="fa fa-times text-danger"></i>
                      @endif
                    </td>
                    <td>
                      @if($data->is_editable=='1')
                      {!!  Html::decode(link_to_route('roles.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                      @endif
                      @if($data->is_deletable=='1')
                      <span class="delete-form">
                         <button type="button" data-toggle="modal" data-target="#myModal" onClick="callModal('{{$data->id}}')" class='btn btn-xs delete-button'><span aria-hidden="true" class="fa fa-remove"></span></button>
                      </span>
                      @endif
                  </tr>
                  @php $i=$i+1; @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Select any role for all the users under this role</h4>
      </div>
      {{ Form::open(array('route' => array('roles.destroy', 'remove-id'),'method'=>'DELETE','id'=>'del-form')) }}
      <div class="modal-body">
        {{Form::select('role_id',[],null,array('class' => 'form-control', 'id'=>'selectBox'))}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {{ Form::submit('Confirm Delete',array('class'=>'btn btn-primary'))}}
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@component('common_pages.data_table_script')
 <script>
     $(function(){
        "use strict";
        $('.data-table').DataTable({
          "order": [], /* No ordering applied by DataTables during initialisation */
        });
    });
        //role delete options
      function callModal(selector){
        var options='{!! $options or '' !!}';
        var my_obj = $('#del-form');
        var my_action = my_obj.attr('action');
        var my_id = selector;
        var my_actions = my_action.replace("remove-id", my_id);
        my_obj.attr('action', my_actions);
        $('#selectBox').empty();
        $("#selectBox").append(options);
        $("#selectBox option[value='"+my_id+"']").remove();
      }
    </script>

    @slot('css')
      <style>
        table.dataTable.nowrap th,
        table.dataTable.nowrap td{
             white-space: pre-wrap;
        }
      </style>
    @endslot
@endcomponent

