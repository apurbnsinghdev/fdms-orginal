@extends('layouts.admin')
@section('title', 'Freeze Assign')
@section('content')


<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Requisition</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Freeze Assign</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('requisitions.index','<i class="fa fa-list"></i>',['approved'],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
        <table class="table table-condensed">
        	<tr>
        		<th>Depot</th>
        		<td>{{$requisition->depot->name}}</td>
        	</tr>
        	<tr>
        		<th>DF Size</th>
        		<td>DF-{{$requisition->size->name}}</td>
        	</tr>
        	<tr>
        		<th>Payment Modes</th>
        		<td>{{mystudy_case($requisition->payment_modes)}}</td>
        	</tr>
        	@if($requisition->payment_modes != 'without_rent')
        	<tr>
        		<th>Payment Methods</th>
        		<td>
                    @if ($requisition->payment_methods)
                       {{config('myconfig.payment_methods')[$requisition->payment_methods]}}
                    @endif
                </td>
        	</tr>
        	<tr>
        		<th>Receive Amount</th>
        		<td>{{mystudy_case($requisition->receive_amount)}}</td>
        	</tr>
        	@endif
        	@if($requisition->payment_verrified_by)
        	<tr>
        		<th>Payment Varified By</th>
        		<td>{{$requisition->payment_verifier->name}}</td>
        	</tr>
        	@endif
		</table>
            <div class="panel-content">
            	@if($noOfTotalDF)
					     {{ Form::model(request()->old(),array('route' => array('requisitions.freeze_assign',request()->route()->parameters['param']),'method'=>'post','class'=>'form-horizontal freezeAssignFrm')) }}
    						<div class="form-group{{ $errors->has('item_id') ? ' has-error' : '' }}">
                  {{Form::label('DF:',null,array('class' => 'control-label col-sm-2 require'))}}
                  <div class="col-md-6">
                      {{Form::select('item_id',[''=>'Please Select..'] +  $items->toArray(),null,array('id'=>'df-size','class' => 'form-control select2','data-placeholder'=>'Please Select..'))}}
                      {!! $errors->first('item_id', '<p class="text-danger">:message</p>' ) !!}
                  </div>
                 @if($slectedItems->count())
                  	<div class="col-md-2"><a type="button" class="btn btn-primary" onclick="showModal()">Add Serial</a></div>
                 @endif
    						</div>
    					  <div class="form-group">
                      <div class="col-md-6 col-md-offset-2">
                           <button type="submit" class="btn btn-primary">
                              Send
                          </button>
                      </div>
              	</div>
					     {{ Form::close() }}
      				@else
      					<h4 class="text-danger text-center">{{ $msg }}</h4>
      				@endif
            </div>
        </div>
    </div>
</div>
@if($slectedItems->count())
  @component('common_pages.common_modal_component',['modalTitle'=>'Input DF Serial'])
    <form style="position: relative;overflow: hidden;" id="inputSerialFrm">
      {{ csrf_field() }}

        @if($brands->count() > 1)
          <div class="col-md-12 form-group">
                {{Form::label('Select Brand',null,array('class' => 'control-label'))}}
                {{Form::select('brand_id',$brands,$brands->keys()->first(),array('onchange'=>"generatePreSerial(this)",'class' => 'form-control'))}}
          </div>
        @endif
      @php
        $preSerial = 'DIIL/' . $brands->first(). '/' . $requisition->size->name . '/';
      @endphp
      {{Form::hidden('item_id',$slectedItems[$brands->keys()->first()],array('id'=>'itemId'))}}
      {{Form::hidden('preSerial',$preSerial,array('id'=>'hidden-preserial-id'))}}
      {{Form::hidden('requestFrom','freeze_assign')}}
      <div class="input-group">
        <span class="input-group-addon" id="pre-serial">{{$preSerial}}</span>
            {{Form::text('serial',null,array('required','class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>8))}}
      </div>
        <p class="text-danger" id="error"></p>
        <div class="col-md-4 form-group">
            <button type="button" class="btn btn-success" id="confirm-btn" onclick="addSerial()">Submit</button>
        </div>
    </form>
  @endcomponent
@endif

@endsection

@component('common_pages.selectize')
@section('script')
	@include('common_pages.max_length')
	<script type="text/javascript">
      function showModal(){
        $('#common-modal').modal('show');
      }
        //generate pre serial for modal add seiral
        function generatePreSerial(selector){
        	//showSerialModal( $(selector).children('option:selected').val());
          var val=$(selector).children('option:selected').val();
          var selectedItems=@json($slectedItems);
          var brands=@json($brands);
          var sizeName='{!! $requisition->size->name !!}';
          var brandName=brands[val];
          var itemId=selectedItems[val];
          var preSerial='DIIL/' + brandName+ '/' + sizeName + '/'
          $('#hidden-preserial-id').val(preSerial);
          $('#itemId').val(itemId);
          $('#pre-serial').html(preSerial);
        }

    	//insert serial
		function addSerial(){
			var frmData = $('#inputSerialFrm').serializeObject();
			//console.log(frmData.pre_serial);
            	$.ajax({
                  type: 'POST',
                  url:"{{ route('inventories.inputItemSerial') }}",
                  data:frmData
              	}) .done(function(response) {
              		if (response.error && response.success){
                        $('#error').html(response.message);
                      }else{
                    	  location.reload();
                      }
              		//$('#common-modal').modal('show');
              })
              .fail(function(response) {
                //console.log(response);
              });

          }

        $(document).on('submit', '.freezeAssignFrm', function() {
            return confirm('Assigned serial can\'t be changed further.Are you sure to proceed ?');
        });

	</script>
@stop
@endcomponent

