<li class=" has-child-item{{ check_menu_active($current_location,['UploadsController']) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Uploads Module</span></a>
     <ul class="nav child-nav level-1">

         <!-- distributor start-->
        @if(isMenuRender(['UploadsController@shops'],$menu_list))
             <li @if($current_location=='UploadsController@shops') class="active-item" @endif>
                <a href="{{ route('uploads.shops',[1]) }}">Distributor</a>
            </li>
        @endif
        <!-- distributor end=======-->

         <!-- retailer start-->
        @if(isMenuRender(['UploadsController@shops'],$menu_list))
             <li @if($current_location=='UploadsController@shops') class="active-item" @endif>
                <a href="{{ route('uploads.shops',[]) }}">Retailer</a>
            </li>
        @endif
        <!-- retailer end=======-->
         <!-- inventory start-->
        @if(isMenuRender(['UploadsController@generateInventory'],$menu_list))
             <li @if($current_location=='UploadsController@generateInventory') class="active-item" @endif>
                <a href="{{ route('uploads.inventory',[]) }}">Generate Inventory</a>
            </li>
        @endif
        <!-- inventory end=======-->

    </ul>
</li>
