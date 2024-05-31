@extends('layouts.admin')
@section('title', 'Item Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Item</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@php
	$changeStatus = $returnSupportDf = $inputItemSerial = false;
@endphp
	@if(isMenuRender('InventoriesControler@changeItemStatus',$menu_list))
       @php
         $changeStatus=true;
       @endphp
	@endif
	@if(isMenuRender('InventoriesControler@returnSupportDf',$menu_list))
       @php
         $returnSupportDf=true;
       @endphp
	@endif
	@if(isMenuRender('InventoriesControler@inputItemSerial',$menu_list))
       @php
         $inputItemSerial=true;
       @endphp
	@endif
@php
  $dfListsArr=[
   'without_serial_dF' =>'without_serial_dF',
    'with_serial_dF'=>'with_serial_dF',
    'injected_dF'=>'injected_dF',
    'support_dF'=>'support_dF',
    'low_cooling_dF'=>'low_cooling_dF',
    'in_sip_dF'=>'SIP_dF',
    'damage_dF'=>'damaged_dF'
  ];

  if($isExecutiveGroup){
    unset($dfListsArr['without_serial_dF'],$dfListsArr['with_serial_dF'], $dfListsArr['damage_dF']);
  }
@endphp
<div class="tabs">
    <ul class="nav nav-tabs">
      @foreach ($dfListsArr as $key => $val)
          <li class="@if($param==$key){{ 'active' }}@endif"><a href="{{ route('inventories.itemIndex',[$key]) }}">{{ mystudy_case($val) }}</a></li>
      @endforeach
    </ul>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b>{{ mystudy_case($param) }} Lists   @if ($param =='damage_dF')(<span class="text-danger text-sm">Red color in serial indicates damage during receive</span>) @endif</b>
        </h4>
        <span class="pull-right">
           {!! Html::decode(link_to_route('inventories.itemExport','<i class="fa fa-download"></i>',[$param],array('class'=>'btn btn-info btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				        <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            @if($param !='without_serial_dF')
                              <th class="no-sort">Serial</th>
                            @endif
                            <th>Brand</th>
                            <th>Size</th>
                            <th>Depot</th>
                            @if($param !='without_serial_dF' && $param !='with_serial_dF')
                              <th class="no-sort">Outlet</th>
                            @endif
                            <th class="no-sort">Status</th>
                            <th>Created</th>
                            <th class="no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal Put Serial start-->
@component('common_pages.common_modal_component',[
    'modalTitle'=>'Enter Serial',
    'modalSize'=>'modal-sm',
])
	<serialadd />
@endcomponent
<!-- Modal Put Serial end-->
<!-- Modal Change status start-->
@component('common_pages.common_modal_component',[
  'id'=>'common-modal2',
  'modalSize'=>'modal-sm',
  'bodyid'=>'modal-body2'
  ])
  {{ Form::open(['route'=>'inventories.changeItemStatus','class'=>'form-horizontal','id'=>'application-form']) }}
      <div id="hidden"></div>
      <div class="form-group">
      	<div class="col-md-12">
          	<select class="form-control" name="freeze_status" id="freeze_status">
          	</select>
      	</div>
      </div>
      <div class="form-group">
          <div class="col-md-4 col-md-offset-2">
              <button type="submit" class="btn btn-primary text-capitalize" id="btn-name">
                  Submit
              </button>
          </div>
          <div class="col-md-4">
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">
                  Cancel
              </button>
          </div>
      </div>
      <div id="error" class="text-danger"></div>
  {{ Form::close() }}
@endcomponent
<!-- Modal Change status end-->
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
@endsection
@section('vuescript')
<script>
        function showModal(id,preSerial,serial){
        	laravelObj.common=id;
        	laravelObj.preSerial = preSerial;
        	$('#pre-serial').text(preSerial);
        	if(serial !== undefined){
        		laravelObj.serial = serial.replace(preSerial, '');;
        		$('#serial').val(laravelObj.serial).change();
        	}
            $('#common-modal').modal('show');
        };
    </script>
@stop
@component('common_pages.data_table_script')
<script src="{{ asset('vendor/moment/moment.js') }}"></script>
 <script>
    function showModal2(self){
        var tis=$(self);
        var id=tis.data('id');
        var freezeStatus = tis.data('status');
        var dfSerial = tis.data('serial');
        var str='<input type="hidden" name="id" value="'+id+'">';
        var optionsObj = {support:'Support',low_cooling:'Low Cooling'};
        var options = '';
        Object.keys(optionsObj).forEach(function(key) {
            var selected = '';
            if(key == freezeStatus){
            	 selected = 'selected';
            }
            options +='<option '+selected+' value= "'+key+'">'+optionsObj[key]+'</option>';
        });

        $('#hidden').html(str);
        $('#freeze_status').html(options);
        $('#common-modal2').modal('show');
        $('#common-modal2').find('#modal-title').text(dfSerial);
      }

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
           var data= $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                 "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
                  "order": []
                } ],
                "ajax": "{{ route('ajax.items.index',[$param]) }}",
                "columns": [
                	 @if($param !='without_serial_dF')
                      @if ($param =='damage_dF')
                        {
                          "data": "serial_no",
                            render: function(data, type, full, row){
                              if(!data){
                                data='Serial not added';
                              }
                              if(!full.shop_id){
                                return '<span class="text-danger">'+data+'</span>';
                              }else{
                                return data;
                              }
                            }
                         },
                      @else
                        { "data": "serial_no" },
                      @endif
                    @endif
                    {
                        "orderable": false,
                        "data": "brand.name",
                        "defaultContent":""
                    },
                    { "data": "size.name" },
                    {
                        "orderable": false,
                        "data": "depot.name"
                    },
                    @if($param !='without_serial_dF' && $param !='with_serial_dF')
                    {
                    	"orderable": false,
                      "data": "outlet_name",
                      "name":"shops.outlet_name",
                      "defaultContent":""
                     },
                    @endif
                    {
                        "orderable": false,
                        "data": "freeze_status_custom",
                        "name":"freeze_status",
                    },
                    {
                        "data": "created_at",
                        //"bSearchable": false,
                        render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("ll");
                        }
                    },
                    {
                    	"orderable": false,
                        "bSearchable": false,
                        "data": "id",
                        render: function (data, type, full, meta) {
                            var preSerial = 'DIIL/';
                            if(full.brand){
                            	preSerial = preSerial + full.brand.short_code + '/';
                            }else{
                            	preSerial = preSerial + '--/';
                            }
                            preSerial = preSerial + full.size.name + '/';
                            var returnObj = '';
                            if(full.serial_no){
                                if(full.freeze_status=='fresh'){
                                    @if($inputItemSerial)
                                		returnObj =  `<a class="btn" style="cursor:pointer" onclick="showModal(`+data+`,\'`+preSerial+`\',\'`+full.serial_no+`\')">Edit Serial</a> `;
                                	@endif
                                }
                                if((full.freeze_status == 'used' || full.freeze_status == 'support' || full.freeze_status == 'low_cooling') && full.item_status == null){
                                  @if($changeStatus)
                               	  		returnObj += `<a class="btn btn-o btn-info" style="cursor:pointer" data-id="`+full.id+`" data-serial="`+full.serial_no+`" data-status="`+full.freeze_status+`" onclick="showModal2(this)">Change Status</a> `;
                           	  		@endif
                                }else if(full.freeze_status == 'support' &&  full.item_status == 'continue'){
                                    @if($returnSupportDf)
                           		 		returnObj += `<a class="btn btn-o btn-info" style="cursor:pointer" data-id="`+full.id+`" data-serial="`+full.serial_no+`" onclick="showModal3(this)">Return Support DF</a> `;
                              		 @endif
                               }
                             }else{
                              @if($inputItemSerial)
                            	 	returnObj = `<a class="btn" style="cursor:pointer" onclick="showModal(`+data+`,\'`+preSerial+`\')">Add Serial</a> `;
                            	 @endif
                             }
							             return returnObj;
                        }
                    }
                ]
            });

        //set search text on specific column
        //data.columns(0).search('DIIL/TB/650/0000010');
        //make ajax to call server
        //data.draw();

        });
    </script>
@endcomponent

