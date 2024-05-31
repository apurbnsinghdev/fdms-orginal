<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='new'){{ 'active' }}@endif"><a href="{{ route('services.damageApplicationList',['new']) }}">New</a></li>
        <li class="@if($param=='processing'){{ 'active' }}@endif"><a href="{{ route('services.damageApplicationList',['processing']) }}">Processing</a></li>
        <li class="@if($param=='completed'){{ 'active' }}@endif"><a href="{{ route('services.damageApplicationList',['completed']) }}">Completed</a></li>
        <li class="@if($param=='on_hold'){{ 'active' }}@endif"><a href="{{ route('services.damageApplicationList',['on_hold']) }}">On Hold</a></li>
    </ul>
</div>