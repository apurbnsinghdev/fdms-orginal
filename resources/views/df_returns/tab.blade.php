<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='new'){{ 'active' }}@endif"><a href="{{ route('returns.index',['new']) }}">New</a></li>
        <li class="@if($param=='processing'){{ 'active' }}@endif"><a href="{{ route('returns.index',['processing']) }}">Processing</a></li>
        <li class="@if($param=='completed'){{ 'active' }}@endif"><a href="{{ route('returns.index',['completed']) }}">Completed</a></li>
        <li class="@if($param=='on_hold'){{ 'active' }}@endif"><a href="{{ route('returns.index',['on_hold']) }}">On Hold</a></li>
    </ul>
</div>