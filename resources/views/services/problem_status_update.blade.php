@extends('layouts.admin')
@section('title', 'Update Problem Status')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Problem Status</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Problem Status Update</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('services.problemEntryList','<i class="fa fa-list"></i>',['new'],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
        <table class="table table-condensed">
        	<tr>
		<th>Problem Type </th>
		<td>{{ $dfproblems->problem_type->name or '' }}</td>
	</tr>
	<tr>
		<th>Token </th>
		<td>{{ $dfproblems->token or '' }}</td>
	</tr>
	<tr>
		<th>Daily Serial</th>
		<td>{{ $dfproblems->daily_serial or '' }}</td>
	</tr>
	<tr>
		<th>DF Code</th>
		<td>{{ $dfproblems->df_code or '' }}</td>
	</tr>
	<tr>
		<th>DF Size</th>
		<td>{{ $dfproblems->df_size or '' }}</td>
	</tr>
	<tr>
		<th>Region</th>
		<td>{{ $dfproblems->region->name or '' }}</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $dfproblems->depot->name or '' }}</td>
	</tr>
	<tr>
		<th>Outlet</th>
		<td>{{ $dfproblems->outlet_name or '' }}</td>
	</tr>
	<tr>
		<th>Proprietor</th>
		<td>{{ $dfproblems->proprietor_name or '' }}</td>
	</tr>
	<tr>
		<th>Mobile</th>
		<td>{{ $dfproblems->mobile or '' }}</td>
	</tr>
	<tr>
		<th>Address</th>
		<td>{{ $dfproblems->address or '' }}</td>
	</tr>
	<tr>
		<th>Received Date</th>
		<td>{{ $dfproblems->created_at->format('l jS \\of F Y h:i:s A') }}</td>
	</tr>
	<tr>
		<th>Technician</th>
		<td>{{ $dfproblems->technician->name or '' }}</td>
	</tr>
		</table>
            <div class="panel-content">
				{{ Form::model($dfproblems,array('route' => array('services.assignTechnician',$dfproblems->id),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
					<div class="form-group">
						<label class="col-sm-2 control-label text-right">Work Description</label>
                        <div class="col-sm-6">
                            {{Form::textarea('work_description',null,array('rows'=>4,'class' => 'form-control max-length','maxlength'=>150))}}
                         </div>
                 	</div>
                 	<div class="form-group{{ $errors->has('invoice_date') ? ' has-error' : '' }}">
                        {{Form::label('invoice_date:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                {{Form::text('invoice_date',null,array('class' => 'form-control datepicker'))}}
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <div class="checkbox-custom checkbox-success">
                                {{Form::checkbox('pull',1,null,array('id'=>'checkboxCustom1'))}}
                                <label for="checkboxCustom1" class="check">Need to pull</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <div class="checkbox-custom checkbox-success">
                                {{Form::checkbox('support_df',1,null,array('id'=>'checkboxCustom2','v-model'=>'cvb2'))}}
                                <label for="checkboxCustom2" class="check">Need to Support DF</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('item_id') ? ' has-error' : '' }}" v-if="cvb2">
						{{Form::label('Support DF:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::select('item_id',$supportDfList,null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Technician'))}}
			                {!! $errors->first('item_id', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                            
                        </div>
                        
                    </div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@component('common_pages.selectize') 
	@include('common_pages.max_length')
	<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
         $('.datepicker').datepicker({ format: "dd/mm/yy"});
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent