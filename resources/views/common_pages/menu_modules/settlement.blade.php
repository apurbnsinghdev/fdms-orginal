<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.settlement')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Settlements</span></a>
     <ul class="nav child-nav level-1">

        @if(isMenuRender(['SettlementsController@continueSettlementList'],$menu_list))
             <li @if($current_location=='SettlementsController@continueSettlementList') class="active-item" @endif>
                <a href="{{ route('settlements.continueList',['rent']) }}">Continue List</a>
            </li>
        @endif

        @if(isMenuRender(['SettlementsController@closedSettlementList'],$menu_list))
             <li @if($current_location=='SettlementsController@closedSettlementList') class="active-item" @endif>
                <a href="{{ route('settlements.closedList',['payable']) }}">Closed List</a>
            </li>
        @endif

    </ul>
</li>
