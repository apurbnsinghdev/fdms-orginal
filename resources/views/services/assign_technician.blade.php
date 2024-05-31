@extends('layouts.admin')
@section('title', 'Assign Technician')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Technician</a></li>
            <li><a>Assign</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Technician Assign</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('services.problemEntryList','<i class="fa fa-list"></i>',['new'],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
	        <table class="table table-condensed">
	        	<tr>
					<th>Problem Type </th>
					<td>{{ $dfproblems->df_problem }}</td>
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
					<th>Comments</th>
					<td>{{ $dfproblems->comments }}</td>
				</tr>
			</table>
            <div class="panel-content">
				{{ Form::model($dfproblems,array('route' => array('services.assignTechnician',$dfproblems->id),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
					<div class="form-group{{ $errors->has('technician_id') ? ' has-error' : '' }}">
						{{Form::label('technician:',null,array('class' => 'control-label col-sm-2 require'))}}
						<div class="col-md-6">
			                {{Form::select('technician_id',$technitians,null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Technician'))}}
			                {!! $errors->first('technician_id', '<p class="text-danger">:message</p>' ) !!}
						</div>
					</div>
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary" name="submit" value="assign">
                                Assign
                            </button>
                            <button type="submit" class="btn btn-primary" name="submit" value="send">
                                Assign & Send Message
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
@endcomponent