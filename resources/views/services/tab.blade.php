<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='new'){{ 'active' }}@endif"><a href="{{ route('services.problemEntryList',['new']) }}">New</a></li>
        <li class="@if($param=='processing'){{ 'active' }}@endif"><a href="{{ route('services.problemEntryList',['processing']) }}">Processing</a></li>
        <li class="@if($param=='service_workshop'){{ 'active' }}@endif"><a href="{{ route('services.problemEntryList',['service_workshop']) }}">Service Workshop</a></li>
        <li class="@if($param=='rejected'){{ 'active' }}@endif"><a href="{{ route('services.problemEntryList',['rejected']) }}">Rejected</a></li>
        <li class="@if($param=='completed'){{ 'active' }}@endif"><a href="{{ route('services.problemEntryList',['completed']) }}">Completed</a></li>
        <li class="@if($param=='damage-applied'){{ 'active' }}@endif"><a href="{{ route('services.problemEntryList',['damage-applied']) }}">Damage Applied</a></li>
        <li class="@if($param=='all'){{ 'active' }}@endif"><a href="{{ route('services.problemEntryList',['all']) }}">All</a></li>
    </ul>
</div>