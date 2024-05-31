@extends('layouts.admin')
@section('title', 'Damage Application Lists')
@section('content')


@if($param=='new')
  @php
    $actionsArrr=$actionsArr;
  @endphp
@elseif($param=='on_hold')
  @php
    $actionsArrr=$actionsArr->diff(['hold']);
  @endphp
@else
  @php
    $actionsArrr=collect([]);
  @endphp
@endif

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Damage Application</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@include('services.damage_applications.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b class="text-capitalize">{{ mystudy_case($param) }} Applications</b></h4>
        <span class="pull-right">
           {{--  {!! Html::decode(link_to_route('requisitions.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!} --}}
        </span>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                  <table id="basic-table" class="action-table data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class="no-sort">SI NO.</th>
                          <th>Depot</th>
                          <th>Outlet Name</th>
                          <th>Damage Type</th>
                          <th class="no-sort">Serial</th>
                          <th>Used</th>
                          <th class="no-sort">Remark</th>
                          <th class="text-center no-sort">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          @php $i=1; @endphp
                          @foreach ($applications as $data)
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$data->depot->name or ''}}</td>
                           <td>{{$data->shop->outlet_name or ''}}</td>
                          <td>{{$data->damage_type->name or ''}}</td>
                          <td>{{$data->item->serial_no or ''}}</td>
                            @php
                              $month=(int)$data->settlement->inject_date->diffInMonths($data->created_at);
                            @endphp
                          <td>{{ $month }} {{ str_plural('month',$month) }}</td>
                          <td>{{$data->remarks }}</td>
                          <td class="text-center">
                            <a style="cursor:pointer" onclick="getDetails('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>
                          @if ($actionsArrr->isNotEmpty())
                            @foreach ($actionsArrr as $val)
                              <a href="javascript:void(0)" class="text-capitalize btn btn-o btn-info" data-id="{{ $data->id }}" data-stage="{{ $data->stage }}" data-name="{{ $val }}" onclick="showModal(this)">{{ $val }}</a>
                            @endforeach
                          @endif
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

@include('common_pages.common_modal',['modalTitle'=>'Application Details'])
@component('common_pages.common_modal_component',[
  'id'=>'common-modal2',
  'modalTitle'=>'Confirm To Proceed',
  'modalSize'=>'modal-sm',
  'bodyid'=>'modal-body2'
  ])
  {{ Form::open(['url'=>'','class'=>'form-horizontal','id'=>'application-form']) }}
      <div id="hidden"></div>
      <div class="form-group">
          <div class="col-md-4 col-md-offset-2">
              <button type="button" class="btn btn-primary text-capitalize" id="btn-name" onclick="saveApplicationAction('#application-form')">
                  Confirm
              </button>
          </div>
      </div>
      <div id="error" class="text-danger"></div>
  {{ Form::close() }}
@endcomponent

@endsection

@component('common_pages.data_table_script')
 <script>
      function showModal(self){
        var tis=$(self);
        var id=tis.data('id');
        var stage=tis.data('stage');
        var action=tis.data('name');
        var str='';
        str+='<input type="hidden" name="id" value="'+id+'">';
        str+='<input type="hidden" name="stage" value="'+stage+'">';
        str+='<input type="hidden" name="action" value="'+action+'">';
        $('#btn-name').text(action);
        $('#hidden').html(str);
        $('#common-modal2').modal('show');
      }

    function getDetails(id){
        var modalBody=$('#modal-body');
        modalBody.css('padding-top',0);
        modalBody.html('');
       $.get(laravelObj.appHost+"/get-application-details/"+id, function(data, status){
           modalBody.html(data);
        });
      $('#common-modal').modal('show');
    }

  function saveApplicationAction(formId){
    //serializeObject function is custom function get in custom.js
    var datas=$(formId).serializeObject();
    $.ajax({
          type: 'POST',
          url:"{{ route('ajax.applicationStageAction.post') }}",
          data:datas
      }) .done(function(response) {
        toastr.options = {
          "progressBar": true,
          "positionClass": "toast-top-center",
          "timeOut": 2000,
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "slideDown",
          "hideMethod": "fadeOut"
        };

        if (response.error && response.success){
          $('#error').html(response.message);
        }else if(response.error && !response.success){
            toastr.warning('', '<h5 style="margin-top: 5px; margin-bottom: 0px;"><b>'+response.message+'!</b></h5>');
            setTimeout(function() {
               location.reload();
            }, 2001);
        }else if(!response.error && response.success){
            toastr.success('', '<h5 style="margin-top: 5px; margin-bottom: 0px;"><b>'+response.message+'!</b></h5>');
            setTimeout(function() {
               location.reload();
            }, 2001);
        }
      })
      .fail(function(response) {
        console.log(response);
      });
  }
  </script>
  <script>
    $(function(){
        "use strict";
        $('.data-table').DataTable({
          "order": [], /* No ordering applied by DataTables during initialisation */
           "pageLength": 100,
            "columnDefs": [ {
              "targets": 'no-sort',
              "orderable": false,
              "order": []
            } ]
        });
    });
  </script>
@endcomponent