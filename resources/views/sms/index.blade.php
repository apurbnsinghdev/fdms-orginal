@extends('layouts.admin')
@section('title', 'Sms Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Sms</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Sms Lists</b></h4>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>SI NO.</th>
                            <th>Subject</th>
                            <th>Designations</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i=1;  @endphp
                          @foreach ($sms as $data)
                          <tr>
                            <td>{{$i}}</td>
                          	<td>{{mystudy_case($data->subject)}}</td>
                          	<td>
                          		@if($data->designations)
                              		@php
                              			$insertedDesignatins = json_decode($data->designations,true);
                              			$arr = [];
                              			foreach($insertedDesignatins as $key => $value){
                              				$arr[] = $designations[$value];
                              			}
                              			echo implode(', ',$arr);
                              		@endphp
                          		@endif
                          	</td>
                            <td>{{mystudy_case($data->status)}}</td>
                            <td>
                              {!!  Html::decode(link_to_route('sms.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
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

