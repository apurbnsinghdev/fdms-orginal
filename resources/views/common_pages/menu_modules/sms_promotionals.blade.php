<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.sms_promotionals')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Promotional SMS</span></a>
     <ul class="nav child-nav level-1">
        @if(isMenuRender(['SmsPromotionalsController@index'],$menu_list))
             <li @if($current_location=='SmsPromotionalsController@index') class="active-item" @endif>
                <a href="{{ route('smsPromotionals.index',[config('myconfig.promotional_sms_group.sales_team')]) }}">SMS List</a>
            </li>
        @endif
    </ul>
</li>
