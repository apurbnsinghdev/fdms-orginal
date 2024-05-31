<div class="tabs">
    <ul class="nav nav-tabs">
    	@foreach(config('myconfig.promotional_sms_group') as $value)
        <li class="@if($param == $value){{ 'active' }}@endif"><a href="{{ route('smsPromotionals.index',[$value]) }}">{{mystudy_case($value)}}</a></li>
        @endforeach
    </ul>
</div>