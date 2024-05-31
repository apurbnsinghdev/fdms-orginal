<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.requisition')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Requisition Module</span></a>
     <ul class="nav child-nav level-1">

        <!-- Shop Managements start-->
        @if(isMenuRender(['ShopsController@create','ShopsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['ShopsController']) }}">
                <a><span>Shop Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('ShopsController@create',$menu_list))
                        <li @if($current_location=='ShopsController@create') class="active-item" @endif><a href="{{ route('shops.create',[]) }}">Add Shop</a></li>
                    @endif
                    @if(isMenuRender('ShopsController@index',$menu_list))
                        <li @if($current_location=='ShopsController@index') class="active-item" @endif><a href="{{ route('shops.index',[]) }}">Shop Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Shop Managements end-->

        <!-- Requisition Managements start-->
        @if(isMenuRender(['RequisitionsController@create','RequisitionsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['RequisitionsController']) }}">
                <a><span>Requisition Manage</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('RequisitionsController@create',$menu_list))
                        <li @if($current_location=='RequisitionsController@create') class="active-item" @endif><a href="{{ route('requisitions.create',[]) }}">Add Requisition</a></li>
                    @endif
                    @if(isMenuRender('RequisitionsController@index',$menu_list))
                        <li @if($current_location=='RequisitionsController@index') class="active-item" @endif><a href="{{ route('requisitions.index',['new']) }}">Requisition Lists</a></li>
                    @endif
                    {{--
                    @if(isMenuRender('RequisitionsController@deedPapergenerate',$menu_list))
                        <li @if($current_location=='RequisitionsController@deedPapergenerate') class="active-item" @endif><a href="{{ route('requisitions.deedPapergenerate') }}">Deed Paper</a></li>
                    @endif
                    --}}
                </ul>
            </li>
        @endif
        <!-- Requisition Managements end-->
    </ul>
</li>
