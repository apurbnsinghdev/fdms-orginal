<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.configaration')) }}">
    <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>Configuration</span></a>
     <ul class="nav child-nav level-1">

        <!-- SiteSettings start-->
        @if(isMenuRender('SiteSettingsController@edit',$menu_list))
            @if(!empty($site_settings->logo))
            <li @if($current_location=='SiteSettingsController@edit') class="active-item" @endif><a href="{{ route('site_settings.edit',[$site_settings->id]) }}">Site Setting</a></li>
            @else
             <li @if($current_location=='SiteSettingsController@edit') class="active-item" @endif><a href="{{ route('site_settings.edit',[1]) }}">Site Setting</a></li>
            @endif
        @endif
        <!-- SiteSettings end=======-->

        <!-- Designation Managements start-->
        @if(isMenuRender(['DesignationsController@create','DesignationsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['DesignationsController']) }}">
                <a><span>Designation Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('DesignationsController@create',$menu_list))
                        <li @if($current_location=='DesignationsController@create') class="active-item" @endif><a href="{{ route('designations.create',[]) }}">Add Designation</a></li>
                    @endif
                    @if(isMenuRender('DesignationsController@index',$menu_list))
                        <li @if($current_location=='DesignationsController@index') class="active-item" @endif><a href="{{ route('designations.index',[]) }}">Designation Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Designation Managements end-->

        <!-- Brand Managements start-->
        @if(isMenuRender(['BrandsController@create','BrandsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['BrandsController']) }}">
                <a><span>DF Brand Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('BrandsController@create',$menu_list))
                        <li @if($current_location=='BrandsController@create') class="active-item" @endif><a href="{{ route('brands.create',[]) }}">Add Brand</a></li>
                    @endif
                    @if(isMenuRender('BrandsController@index',$menu_list))
                        <li @if($current_location=='BrandsController@index') class="active-item" @endif><a href="{{ route('brands.index',[]) }}">Brand Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Brand Managements end-->

        <!-- Size Managements start-->
        @if(isMenuRender(['SizesController@create','SizesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['SizesController']) }}">
                <a><span>DF Size Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('SizesController@create',$menu_list))
                        <li @if($current_location=='SizesController@create') class="active-item" @endif><a href="{{ route('sizes.create',[]) }}">Add Size</a></li>
                    @endif
                    @if(isMenuRender('SizesController@index',$menu_list))
                        <li @if($current_location=='SizesController@index') class="active-item" @endif><a href="{{ route('sizes.index',[]) }}">Size Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Size Managements end-->

        <!-- Location Managements start-->
        @if(isMenuRender(['LocationsController@create','LocationsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['LocationsController']) }}">
                <a><span>Location Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('LocationsController@create',$menu_list))
                        <li @if($current_location=='LocationsController@create') class="active-item" @endif><a href="{{ route('locations.create',['0']) }}">Add Location</a></li>
                    @endif
                    @if(isMenuRender('LocationsController@index',$menu_list))
                        <li @if($current_location=='LocationsController@index') class="active-item" @endif><a href="{{ route('locations.index',[]) }}">Location Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Location Managements end-->

        <!-- zone Managements start-->
        @if(isMenuRender(['ZonesController@create','ZonesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['ZonesController']) }}">
                <a><span>Zone Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('ZonesController@create',$menu_list))
                        <li @if($current_location=='ZonesController@create') class="active-item" @endif><a href="{{ route('zones.create',['0']) }}">Add Zone</a></li>
                    @endif
                    @if(isMenuRender('ZonesController@index',$menu_list))
                        <li @if($current_location=='ZonesController@index') class="active-item" @endif><a href="{{ route('zones.index',[]) }}">Zone Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- zone Managements end-->

        <!-- depot Managements start-->
        @if(isMenuRender(['DepotsController@create','DepotsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['DepotsController']) }}">
                <a><span>Depot Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('DepotsController@create',$menu_list))
                        <li @if($current_location=='DepotsController@create') class="active-item" @endif><a href="{{ route('depots.create',[]) }}">Add Depot</a></li>
                    @endif
                    @if(isMenuRender('DepotsController@index',$menu_list))
                        <li @if($current_location=='DepotsController@index') class="active-item" @endif><a href="{{ route('depots.index',[]) }}">Depot Lists</a></li>
                    @endif
                    @if(isMenuRender('DepotsController@holdDFQty',$menu_list))
                        <li @if($current_location=='DepotsController@holdDFQty') class="active-item" @endif><a href="{{ route('depots.holdDFQty',[]) }}">Hold DF Qty.</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- depot Managements end-->
        
		<!-- Distributor Managements start-->
        @if(isMenuRender(['DistributorsController@create','DistributorsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['DistributorsController']) }}">
                <a><span>Distributor Setup</span></a>
                 <ul class="nav child-nav level-2">
                    @if(isMenuRender('DistributorsController@showProfile',$menu_list))
                        <li @if($current_location=='DistributorsController@showProfile') class="active-item" @endif><a href="{{ route('distributors.showProfile') }}">Distributor Profile</a></li>
                    @endif

                    @if(isMenuRender('DistributorsController@create',$menu_list))
                        <li @if($current_location=='DistributorsController@create') class="active-item" @endif><a href="{{ route('distributors.create',[]) }}">Add Distributor</a></li>
                    @endif
                    @if(isMenuRender('DistributorsController@index',$menu_list))
                        <li @if($current_location=='DistributorsController@index') class="active-item" @endif><a href="{{ route('distributors.index',[]) }}">Distributor Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Distributor Managements end-->

        <!-- Damage Type Managements start-->
        @if(isMenuRender(['DamageTypesController@create','DamageTypesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['DamageTypesController']) }}">
                <a><span>Damage Type Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('DamageTypesController@create',$menu_list))
                        <li @if($current_location=='DamageTypesController@create') class="active-item" @endif><a href="{{ route('damage_types.create',[]) }}">Add Damage Type</a></li>
                    @endif
                    @if(isMenuRender('DamageTypesController@index',$menu_list))
                        <li @if($current_location=='DamageTypesController@index') class="active-item" @endif><a href="{{ route('damage_types.index',[]) }}">Damage Type Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Damage Type Managements end-->

        <!-- Stage Managements start-->
        @if(isMenuRender(['StagingsController@create','StagingsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['StagingsController']) }}">
                <a><span>Stage Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('StagingsController@create',$menu_list))
                        <li @if($current_location=='StagingsController@create') class="active-item" @endif><a href="{{ route('stages.create',['requisition']) }}">Add Stage</a></li>
                    @endif
                    @if(isMenuRender('StagingsController@index',$menu_list))
                        <li @if($current_location=='StagingsController@index') class="active-item" @endif><a href="{{ route('stages.index',['requisition']) }}">Stage Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Stage Managements end-->
         <!-- Sms Managements start-->
        @if(isMenuRender(['SmsController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['SmsController']) }}">
                <a><span>SMS Setup</span></a>
                 <ul class="nav child-nav level-2">
                    @if(isMenuRender('SmsController@index',$menu_list))
                        <li @if($current_location=='SmsController@index') class="active-item" @endif><a href="{{ route('sms.index',[]) }}">SMS Lists</a></li>
                    @endif
                    
                </ul>
            </li>
        @endif
        <!-- Sms Managements end-->

    </ul>
</li>
