<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.inventory')) }}">
    <a><i class="fa fa-archive" aria-hidden="true"></i><span>Inventory Module</span></a>
     <ul class="nav child-nav level-1">

          <!-- Supplier Managements start-->
        @if(isMenuRender(['SuppliersController@create','SuppliersController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['SuppliersController']) }}">
                <a><span>Supplier Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('SuppliersController@create',$menu_list))
                        <li @if($current_location=='SuppliersController@create') class="active-item" @endif><a href="{{ route('suppliers.create',[]) }}">Add Supplier</a></li>
                    @endif
                    @if(isMenuRender('SuppliersController@index',$menu_list))
                        <li @if($current_location=='SuppliersController@index') class="active-item" @endif><a href="{{ route('suppliers.index',[]) }}">Supplier Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Supplier Managements end-->

          <!-- stockCreate start-->
        @if(isMenuRender('InventoriesControler@stockCreate',$menu_list))
             <li @if($current_location=='InventoriesControler@stockCreate') class="active-item" @endif>
                <a href="{{ route('inventories.stockCreate',[]) }}">Create Stock</a>
            </li>
        @endif
        <!-- stockCreate end=======-->

        <!-- generateDFCode start-->
        @if(isMenuRender('InventoriesControler@generateDFCode',$menu_list))
             <li @if($current_location=='InventoriesControler@generateDFCode') class="active-item" @endif>
                <a href="{{ route('inventories.generateDFCode',[]) }}">Generate DF Code</a>
            </li>
        @endif
        <!-- generateDFCode end=======-->

         <!-- stockIndex start-->
        @if(isMenuRender('InventoriesControler@stockIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@stockIndex') class="active-item" @endif>
                <a href="{{ route('inventories.stockIndex',[]) }}">Stock Lists</a>
            </li>
        @endif
        <!-- stockIndex end=======-->

        <!-- allocatedStockIndex start-->
        @if(isMenuRender('InventoriesControler@allocatedStockIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@allocatedStockIndex') class="active-item" @endif>
                <a href="{{ route('inventories.allocatedStockIndex',[]) }}">Allocation Lists</a>
            </li>
        @endif
        <!-- allocatedStockIndex end=======-->

        <!-- depotAllocatedStockIndex start-->
        @if(isMenuRender('InventoriesControler@depotAllocatedStockIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@depotAllocatedStockIndex') class="active-item" @endif>
                <a href="{{ route('inventories.depotAllocatedStockIndex',[]) }}">Depot Allocation Lists</a>
            </li>
        @endif
        <!-- depotAllocatedStockIndex end======-->

        <!-- itemIndex start-->
        @if(isMenuRender('InventoriesControler@itemIndex',$menu_list))
             <li @if($current_location=='InventoriesControler@itemIndex') class="active-item" @endif>
                <a href="{{ route('inventories.itemIndex',[]) }}">DF Lists</a>
            </li>
        @endif
        <!-- itemIndex end======-->

          <!-- Stock Transfer Managements start-->
        @if(isMenuRender(['InventoriesControler@stockTransferCreate','InventoriesControler@stockTransferLists'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['InventoriesControler']) }}">
                <a><span>Stock Transfer</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('InventoriesControler@stockTransferCreate',$menu_list))
                        <li @if($current_location=='InventoriesControler@stockTransferCreate') class="active-item" @endif><a href="{{ route('inventories.stockTransferCreate',[]) }}">Create</a></li>
                    @endif

                    @if(isMenuRender('InventoriesControler@stockTransferLists',$menu_list))
                        <li @if($current_location=='InventoriesControler@stockTransferLists') class="active-item" @endif><a href="{{ route('inventories.stockTransferLists',[]) }}">Lists</a></li>
                    @endif

                </ul>
            </li>
        @endif
        <!-- Supplier Managements end-->

    </ul>
</li>
