<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='0'){{ 'active' }}@endif"><a href="{{ route('zones.index') }}">Region</a></li>
        <li class="@if($param=='1'){{ 'active' }}@endif"><a href="{{ route('zones.index',[1]) }}">Area</a></li>
    </ul>
</div>