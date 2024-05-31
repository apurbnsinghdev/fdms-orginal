<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.return')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Return Module</span></a>
     <ul class="nav child-nav level-1">

        @if(isMenuRender(['DfReturnsController@apply'],$menu_list))
             <li @if($current_location=='DfReturnsController@apply') class="active-item" @endif>
                <a href="{{ route('returns.apply',[]) }}">Apply</a>
            </li>
        @endif

        @if(isMenuRender(['DfReturnsController@index'],$menu_list))
             <li @if($current_location=='DfReturnsController@index') class="active-item" @endif>
                <a href="{{ route('returns.index',[]) }}">List</a>
            </li>
        @endif

    </ul>
</li>
