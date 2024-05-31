<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.report')) }}">
    {{-- onclick="addcollapsibleclass('left-sidebar-collapsed')" --}}
    <a><i class="fa fa-file" aria-hidden="true"></i><span>Reports Module</span></a>
     <ul class="nav child-nav level-1">

        <!-- Purchase and Inventory Start-->
        @if(isMenuRender('InventoryReportsController@index',$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['InventoryReportsController']) }}">
                <a><span>Purchase & Inventory</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('InventoryReportsController@index',$menu_list))
                        <li @if($current_location=='InventoryReportsController@index') class="active-item" @endif><a href="{{ route('inventoryreports.index',[]) }}">DF Received & Delivery</a></li>
                    @endif

                    @if(isMenuRender('InventoryReportsController@getdepotDFStatus',$menu_list))
                        <li @if($current_location=='InventoryReportsController@getdepotDFStatus') class="active-item" @endif><a href="{{ route('inventoryreports.getdepotDFStatus',[]) }}">Depot DF Status</a></li>
                    @endif

                    @if(isMenuRender('InventoryReportsController@getBrandWiseDFStatus',$menu_list))
                        <li @if($current_location=='InventoryReportsController@getBrandWiseDFStatus') class="active-item" @endif><a href="{{ route('inventoryreports.getBrandWiseDFStatus',[]) }}">Brand Wise DF Status</a></li>
                    @endif
<!--
                    @if(isMenuRender('InventoryReportsController@getSizeWiseDistributorDFStatus',$menu_list))
                        <li @if($current_location=='InventoryReportsController@getSizeWiseDistributorDFStatus') class="active-item" @endif><a href="{{ route('inventoryreports.getSizeWiseDistributorDFStatus',[]) }}">Size Wise Distributor DF</a></li>
                    @endif

                    @if(isMenuRender('InventoryReportsController@getSizeWiseDFStatus',$menu_list))
                        <li @if($current_location=='InventoryReportsController@getSizeWiseDFStatus') class="active-item" @endif><a href="{{ route('inventoryreports.getSizeWiseDFStatus',[]) }}">Size Wise Retailer DF</a></li>
                    @endif
-->
                </ul>
            </li>
        @endif
        <!-- Purchase and Inventory end=======-->

        <!-- Requisition Start-->
        <!--
        @if(isMenuRender('InventoryReportsController@index',$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['RequisitionController']) }}">
                <a><span>Requisition</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('RequisitionController@index',$menu_list))
                        <li @if($current_location=='InventoryReportsController@index') class="active-item" @endif><a href="{{ route('inventoryreports.index',[]) }}">Depot wise Requisition</a></li>
                    @endif

                </ul>
            </li>
        @endif
    -->
        <!-- Requisition end=======-->

        <!-- Service Start-->
        @if(isMenuRender('ServiceReportsController@index',$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['ServiceReportsController']) }}">
                <a><span>Service</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('ServiceReportsController@index',$menu_list))
                        <li @if($current_location=='ServiceReportsController@index') class="active-item" @endif><a href="{{ route('servicereports.index',[]) }}">Token Search</a></li>
                    @endif

                    @if(isMenuRender('ServiceReportsController@dfWiseComplain',$menu_list))
                        <li @if($current_location=='ServiceReportsController@dfWiseComplain') class="active-item" @endif><a href="{{ route('servicereports.dfWiseComplain',[]) }}">DF Wise Complain</a></li>
                    @endif

                    @if(isMenuRender('ServiceReportsController@sizeWiseComplain',$menu_list))
                        <li @if($current_location=='ServiceReportsController@sizeWiseComplain') class="active-item" @endif><a href="{{ route('servicereports.sizeWiseComplain',[]) }}">Size Wise Complain</a></li>
                    @endif

                    @if(isMenuRender('ServiceReportsController@typeWiseComplain',$menu_list))
                        <li @if($current_location=='ServiceReportsController@typeWiseComplain') class="active-item" @endif><a href="{{ route('servicereports.typeWiseComplain',[]) }}">Type Wise Complain</a></li>
                    @endif

                    @if(isMenuRender('ServiceReportsController@dateWiseComplain',$menu_list))
                        <li @if($current_location=='ServiceReportsController@dateWiseComplain') class="active-item" @endif><a href="{{ route('servicereports.dateWiseComplain',[]) }}">Date Wise Complain</a></li>
                    @endif

                    @if(isMenuRender('ServiceReportsController@longPendingComplain',$menu_list))
                        <li @if($current_location=='ServiceReportsController@longPendingComplain') class="active-item" @endif><a href="{{ route('servicereports.longPendingComplain',[]) }}">Long Pending Complain</a></li>
                    @endif

                    @if(isMenuRender('ServiceReportsController@jobCardComplain',$menu_list))
                        <li @if($current_location=='ServiceReportsController@jobCardComplain') class="active-item" @endif><a href="{{ route('servicereports.jobCardComplain',[]) }}">Job Card Complain</a></li>
                    @endif

                    @if(isMenuRender('ServiceReportsController@damagedLists',$menu_list))
                        <li @if($current_location=='ServiceReportsController@damagedLists') class="active-item" @endif><a href="{{ route('servicereports.damagedLists',[]) }}">Damaged Lists</a></li>
                    @endif

                </ul>
            </li>
        @endif
        <!-- Service end=======-->

    </ul>
</li>
