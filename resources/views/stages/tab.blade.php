@php
	$routeName=\Request::route()->getName();
@endphp
<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($routeName=='stages.index') active @endif"><a href="{{ route('stages.index',$module) }}">Stage Lists</a></li>
        <li class="@if($routeName=='stages.sort') active @endif"><a href="{{ route('stages.sort',$module) }}">Stage Sort</a></li>
    </ul>
</div>