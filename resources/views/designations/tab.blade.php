@php
	$routeName=\Request::route()->getName();
@endphp
<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($routeName=='designations.index') active @endif"><a href="{{ route('designations.index') }}">Designaton Lists</a></li>
        <li class="@if($routeName=='designations.sort') active @endif"><a href="{{ route('designations.sort') }}">Designation Sort</a></li>
    </ul>
</div>