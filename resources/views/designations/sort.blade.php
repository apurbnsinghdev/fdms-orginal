@extends('layouts.admin')
@section('title', 'Designation Sort')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Designation</a></li>
            <li><a>Sort</a></li>
        </ul>
    </div>
</div>

@include('designations.tab')

<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Designation Sorting</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('designations.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
    </div>

    <div class="col-sm-12">
      {{ Form::model([],array('route' => array('designations.sort'),'method' => 'PUT')) }}
      <ul id="sortable">
        @foreach ($designations as $key=>$val)
        <li class="ui-state-default">
          <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
          <input type="hidden" name="sort[]" value="{{ $key }}">{{ $val }}
        </li>
        @endforeach
      </ul>

      <div class="form-group">
        <button type="submit" class="btn btn-primary mt-sm">
            Sort Designation
        </button>
      </div>

      {{ Form::close() }}
    </div>
</div>

@endsection

@section('script')
  <script src="{{ asset('js/jquery-ui.js') }}"></script>
  <script>
    $( function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
    });
  </script>
@stop

@section('css')
  <style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; cursor: pointer; }
    #sortable li span { margin-left: -1.3em; }
    #custom-label{
      cursor: pointer; font-weight: normal;font-size: 11px; float: right;
    }
    #custom-label input{
      cursor: pointer;padding-top: 25px;
    }
  </style>
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
@stop

