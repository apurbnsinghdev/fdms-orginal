@extends('layouts.default')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h3>Level 1</h3>
			<div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
		</div>
		<div class="col-md-4">
			<h3>Level 2</h3>
			<div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
		</div>
		<div class="col-md-4">
			<h3>Level 3</h3>
			<div id="div3" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			{{-- <img id="drag1" src="{{ asset('storage/images/header-logo.png') }}" draggable="true" ondragstart="drag(event)" width="336" height="69"> --}}
			<p id="mip1" draggable="true" ondragstart="drag(event)">hello1</p>
			<p id="mip2" draggable="true" ondragstart="drag(event)">hello2</p>
			<p id="mip3" draggable="true" ondragstart="drag(event)">hello3</p>
			<p id="mip4" draggable="true" ondragstart="drag(event)">hello4</p>
			<p id="mip5" draggable="true" ondragstart="drag(event)">hello5</p>
			<p id="mip6" draggable="true" ondragstart="drag(event)">hello6</p>
		</div>
	</div>
</div>


@endsection
@section('css')
<style>
	#div1,#div2,#div3 {
	    height: 300px;
	    border: 1px solid #aaaaaa;
	}
</style>
@stop
@section('script')
	<script>
	function allowDrop(ev) {
	    ev.preventDefault();
	}

	function drag(ev) {
	    ev.dataTransfer.setData("text", ev.target.id);
	}

	function drop(ev) {
	    ev.preventDefault();
	    var data = ev.dataTransfer.getData("text");
	    ev.target.appendChild(document.getElementById(data));
	}
	</script>
@stop


