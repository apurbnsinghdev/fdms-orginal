<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='0'){{ 'active' }}@endif"><a href="{{ route('shops.index') }}">Injected DF Retailer</a></li>
        <li class="@if($param=='1'){{ 'active' }}@endif"><a href="{{ route('shops.index',['1']) }}">Non Injected DF Retailer</a></li>
    </ul>
</div>