<form id="actionForm">
	{{ csrf_field() }}
	{{Form::hidden('id',$id)}}
	{{Form::hidden('action',$actionName)}}
	{{Form::hidden('stage',$stage)}}
	@if($actionName == 'approve' && $stage <= 2 && $module == 'requisition')
	<div class="form-group checkbox-custom checkbox-info mt-xs">
		{{Form::checkbox('status',1,null,array('id'=>"physical_visit"))}}
        {{Form::label('physical_visit',null,array('for'=>'physical_visit','class' => 'check text-danger'))}}
     </div>
     @endif
     @if($actionName == 'validate' && $module == 'requisition')
        <div class="form-group">
            {{Form::label("last_three_months_avg_dF_sales:(".($requisitions->last_three_months_avg_sales?:0).")",null,array('class' => 'col-form-label'))}}
            {{Form::number('last_three_months_avg_sales_real',$requisitions->last_three_months_avg_sales_real,array('class' => 'form-control','min'=>0))}}
        </div>
        <div class="form-group">
            {{Form::label("yearly_average_dF_sales:(".($requisitions->average_sales?:0).")",null,array('class' => 'col-form-label'))}}
            {{Form::number('average_sales_real',$requisitions->average_sales_real,array('class' => 'form-control','min'=>0))}}
        </div>
     @endif
     <div class="form-group">
        {{Form::label('comments:',null,array('class' => 'col-form-label'))}}
        {{Form::textarea('comments',null,array('rows'=>'5','class' => 'form-control'))}}
        <p class="text-danger" id="error"></p>
     </div>
    <div class="form-group text-right">
    	<button type="button" class="btn btn-success" id="confirm-btn" onclick="saveAction('#actionForm')">{{ucwords($actionName)}}</button>
    </div>
</form>
