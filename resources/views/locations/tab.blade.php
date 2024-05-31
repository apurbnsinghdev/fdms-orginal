<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='0'){{ 'active' }}@endif"><a href="{{ route('locations.index') }}">Division</a></li>
        <li class="@if($param=='1'){{ 'active' }}@endif"><a href="{{ route('locations.index',[1]) }}">District</a></li>
        <li class="@if($param=='2'){{ 'active' }}@endif"><a href="{{ route('locations.index',[2]) }}">Thana</a></li>
    </ul>
</div>