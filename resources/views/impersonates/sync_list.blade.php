@extends('layouts.admin')
@section('title', 'DF Size Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Users</a></li>
            <li><a>Sync List</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Create User Sync</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('users.syncCreate','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Common Username</th>
                                <th>User From</th>
                                <th>User To</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $employee)
                            	<tr>
                                    <td>{{ $employee->common_username }}</td>
                                    <td>{{ $employee->email.' :: '.$employee->name.' :: '.$employee->mobile.' :: '.$employee->designation }}</td>
                                    <td>{{ $employee->con_email.' :: '.$employee->con_name.' :: '.$employee->con_mobile.' :: '.$employee->con_designation }}</td>
                                    <td class="text-center">
                                        <a href="#"
                                            data-toggle="tooltip" data-placement="left" title="Switch"
                                            onclick="event.preventDefault();
                                                     document.getElementById('{{ $employee->common_username }}').submit();">
                                            <span class="btn-box btnDngr"><i class="glyphicon glyphicon-trash"></i></span>
                                        </a>
                                         <form id="{{ $employee->common_username }}" action="{{ route('users.unSync',$employee->common_username) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            @method('PATCH')
                                        </form>
                                    </td>
	                            </tr>
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