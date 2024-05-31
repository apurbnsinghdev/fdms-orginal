@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{route('servicereports.index')}}">Report </a></li>
            <li><a>Token Search</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">
	 	{{ Form::open(['url'=>route('servicereports.index'),'method'=>'post', 'id'=>'service-from', 'class'=>'form-horizontal']) }}
		<div class="panel">
            <div class="panel-content">
				<div class="row">
					<div class="col-md-12">
                        <!--RANGE datepicker-->
                        <div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
                            {{Form::label('Token:',null,array('class' => 'control-label col-sm-2 require'))}}
                            <div class="col-md-6">
                                {{Form::text('token', $token,array('class' => 'form-control input-sm', 'id'=>'token-select2','maxlength' => 15))}}
                                {!! $errors->first('token', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>


						<div class="form-group">
	                        <div class="col-md-6 col-md-offset-2">
	                            <button type="submit" class="btn btn-primary">
	                                Search Token
	                            </button>
	                        </div>
	                    </div>
			    	</div>
				</div>
			</div>
		</div>
		@if ($isPost)
			@if($report && $report->count()>0)
				<span class="pull-right">
		        	<button type="submit" class="btn btn-info" name="download">
			            <i class="fa fa-download" aria-hidden="true"></i>
			        </button>
		        </span>
		        <h4 class="section-subtitle"></h4>
				@include('reports.services.token_report')
	        @else
		   		<h2 class="section-subtitle text-danger text-center"> <b>{{$token}}</b> Token Not Found</h2>
			@endif
		@endif
		{{Form::close()}}
    </div>
</div>
@endsection

@section('css')
	@include('reports.services.token_report_css')
@endsection
