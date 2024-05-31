@extends('layouts.admin')
@section('title', 'Freezer')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="{{route('servicereports.index')}}">Service Report </a></li>
            <li><a href="{{route('servicereports.longPendingComplain')}}">Long Pending Complain</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
	 <div class="col-sm-12">
            {{ Form::open(['url'=>route('servicereports.longPendingComplain'),'method'=>'post', 'id'=>'service-from', 'class'=>'form-horizontal']) }}

    		<span class="pull-right">
            	<button type="submit" class="btn btn-info">
    	            <i class="fa fa-download" aria-hidden="true"></i>
    	        </button>
            </span>
            {{Form::close()}}
            <h4 class="section-subtitle"><b>Long Pending Complain Status</b></h4>
            @include('reports.services.long_pending_complain_report')

    </div>
</div>
@endsection