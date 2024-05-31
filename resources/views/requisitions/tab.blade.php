<div class="tabs">
    <ul class="nav nav-tabs">
        @php
        	$arr=config('myconfig.application_status');
        	unset($arr['pending']);
        @endphp
        @foreach ($arr as $key=>$ele)
        	 <li class="@if($param==$key){{ 'active' }}@endif"><a href="{{ route('requisitions.index',[$key]) }}">{{ $ele }}</a></li>
        @endforeach
    </ul>
</div>