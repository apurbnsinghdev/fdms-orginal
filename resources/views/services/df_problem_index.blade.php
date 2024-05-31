@extends('layouts.admin')
@section('title', 'Complain Entry Lists')
@section('content')

@php
  $authUserId=auth()->user()->id;
  $reject = $problemEntryEdit = $assignTechnician = false;
@endphp

@if(isMenuRender('ServicesController@problemReject',$menu_list))
   @php
     $reject = true;
   @endphp
@endif
@if(isMenuRender('ServicesController@assignTechnician',$menu_list))
   @php
     $assignTechnician = true;
   @endphp
@endif

@if(isMenuRender('ServicesController@problemEntryEdit',$menu_list))
   @php
     $problemEntryEdit = true;
   @endphp
@endif

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Complain Entry</a></li>
            <li><a>List</a></li>
        </ul>
    </div>
</div>
@include('services.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b> {{ ucfirst($param) }} List</b>
        </h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('services.problemEntry','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
            	<div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="no-sort">Token</th>
                              <th class="no-sort">Shop</th>
                              <th class="no-sort">Proprietor</th>
                              <th class="no-sort">DF Code</th>
                              <th class="no-sort">Depot</th>
                              <th class="no-sort">Zone</th>
                              <th class="no-sort">Officer</th>
                              <th class="no-sort">Mobile</th>
                              <th class="no-sort">Receive Date</th>
                              <th class="no-sort">Comments</th>
                              @if ($param !='new')
                                  <th class="no-sort">Technician</th>
                                  <th class="no-sort">Support</th>
                              @endif
                              @if ($param =='all'||$param =='damage-applied')
                                  <th class="no-sort">Status</th>
                              @endif
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
         @include('common_pages.common_modal',['modalTitle'=>'Complain Entry Details'])

         <!-- Modal Return support df start-->
        @component('common_pages.common_modal_component',[
          'id'=>'common-modal3',
          'modalSize'=>'modal-sm',
          'bodyid'=>'modal-body3'
          ])
          {{ Form::open(['route'=>'inventories.returnSupportDf','class'=>'form-horizontal','id'=>'application-form2']) }}
              <div id="hidden-support-df"></div>
              <div class="form-group">
                  <div class="col-md-4 col-md-offset-2">
                      <button type="submit" class="btn btn-primary text-capitalize">
                          Yes
                      </button>
                  </div>
                  <div class="col-md-4">
                      <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                          No
                      </button>
                  </div>
              </div>
              <div id="error" class="text-danger"></div>
          {{ Form::close() }}
        @endcomponent
        <!-- Modal Return support df end-->

    </div>
</div>
@endsection
@component('common_pages.data_table_script')
@slot('css')
  <style>
    .delete-form{
      position: static !important;
    }
  </style>
@endslot

 <script src="{{ asset('vendor/moment/moment.js') }}"></script>
 <script>
 	var reject = '{{ $reject }}';
 	var assignTechnician = '{{ $assignTechnician }}';
 	var problemEntryEdit = '{{$problemEntryEdit}}';
    var param = '{{ $param }}';
 		//show modal for details view
        function showModal(id){
            $.get(laravelObj.appHost+"/get-problem-details/"+id, function(data, status){
                var modalBody=$('#modal-body');
                modalBody.css('padding-top',0);
                modalBody.html(data);
            });
            $('#common-modal').modal('show');
        };

    function showModal3(self){
        var tis=$(self);
        var id=tis.data('id');
        var dfSerial = tis.data('serial');
        var str='<input type="hidden" name="id" value="'+id+'">';
        $('#hidden-support-df').html(str);
        $('#common-modal3').modal('show');
        $('#common-modal3').find('#modal-title').text(dfSerial);
      }

        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [], /* No ordering applied by DataTables during initialisation */
                "pageLength": 25,
                 "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                    "order": []
                 } ],
                "ajax": "{{ route('ajax.problemEntries.get',[$param]) }}",
                "columns": [
                    { "data": "token" },
                    { "data": "outlet_name" },
                    { "data": "proprietor_name" },
                    { "data": "df_code" },
                    { "data": "depot.name" },
                    { "data": "region.name" },
                    { "data": "officer.name" },
                    { "data": "mobile" },
                    {
                        "data": "created_at",
                        render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("lll");
                        }
                    },
                    { "data": "comments" },
                    @if ($param !='new')
                     {
                        'data':'technician.name',
                        'defaultContent':'<span class="text-danger">Not Assigned</span>'
                    },
                    {
                        'data':'supportdf',
                        'name':'df_problems.support',
                        "bSearchable": false,
                        "orderable": false,
                        render: function (data, type, full, meta) {
                            var val;
                            if(data){
                                val=data;
                            }else{
                                val='<a class="btn btn-o btn-info" style="cursor:pointer" data-id="'+full.item_id+'" data-serial="Return DF:\''+full.df_code+'\' to depot?" onclick="showModal3(this)"><span class="text-danger">Supported</span></a>';
                            }
                            return val;
                        }
                    },
                    @endif
                    @if ($param =='all'||$param =='damage-applied')
                        {
                            "data": "status",
                        	render: function (data, type, full, meta) {
                            	var strStatus = data.charAt(0).toUpperCase() + data.slice(1);
                       	 		return strStatus.replace(/_/g,' ');
                        	}
                        },
                    @endif
                    {
                        "data": "id",
                        "orderable": false,
                        "bSearchable": false,
                        render: function (data, type, full, meta) {
                        	var action =`<a style="cursor:pointer" onclick="showModal(`+data+`)"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a> `;
                        	var assignAction = rejectAction = statusUpdateAction = '';
                            if(assignTechnician){
                            	assignAction = '<a href="' + laravelObj.appHost + "/df-problem/assign-technician/" + data + '"><span aria-hidden="true" class="fa fa-user fa-x"></span></a>';
                            }
                        	if(reject){
                        		rejectAction = '<form method="POST" action="'+laravelObj.appHost+'/df-problem/problem-reject/'+data+'" accept-charset="UTF-8" class="delete-form"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'+Laravel.csrfToken+'"><input name="param" type="hidden" value="'+param+'"><button type="submit" class="btn btn-xs" title="" data-original-title="Delete"><span aria-hidden="true" class="fa fa-ban fa-2x"></span></button></form>';
                            }
                            if(param == 'new'){
                                action += assignAction + rejectAction ;

                            }else if(param == 'processing'){
                            	if(problemEntryEdit){
                            		statusUpdateAction = '<a href="' + laravelObj.appHost + "/df/problem-entry/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>';
                            	}
                            	action += assignAction + statusUpdateAction + rejectAction;
                            }
                            return action;
                        }
                    },
                ],
                "fnDrawCallback": function (oSettings) {
                    var tooltipArr = [
                    	{ "className": "fa-edit", "title": "Problem Status Update" },
                        { "className": "fa-user", "title": "Assign Technician" },
                        { "className": "fa-eye", "title": "View" },
                        { "className": "fa-ban", "title": "Reject" },
                    ];
                    tooltipArr.forEach(function(item, index) {
                        var tis = $('.' + item.className).parent();
                        tis.attr("title", item.title);
                        tis.tooltip();
                    });
                }
            });
        });
    </script>
@endcomponent

