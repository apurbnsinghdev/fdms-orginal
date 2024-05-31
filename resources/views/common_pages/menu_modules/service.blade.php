<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.service')) }}">
    <a><i class="fa fa-wpforms" aria-hidden="true"></i><span>Services Module</span></a>
     <ul class="nav child-nav level-1">

		<!-- Problem Type Managements start-->
        @if(isMenuRender(['ProblemTypesController@create','ProblemTypesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['ProblemTypesController']) }}">
                <a><span>Problem Type Setup</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('ProblemTypesController@create',$menu_list))
                        <li @if($current_location=='ProblemTypesController@create') class="active-item" @endif><a href="{{ route('problem_types.create',[]) }}">Add Problem Type</a></li>
                    @endif
                    @if(isMenuRender('ProblemTypesController@index',$menu_list))
                        <li @if($current_location=='ProblemTypesController@index') class="active-item" @endif><a href="{{ route('problem_types.index',[]) }}">Problem Type Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Problem Type Managements end-->

        <!-- Technician Managements start-->
        @if(isMenuRender(['TechniciansController@create','TechniciansController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['TechniciansController']) }}">
                <a><span>Technicians</span></a>
                 <ul class="nav child-nav level-2">

                    @if(isMenuRender('TechniciansController@create',$menu_list))
                        <li @if($current_location=='TechniciansController@create') class="active-item" @endif><a href="{{ route('technicians.create',[]) }}">Add Technician</a></li>
                    @endif
                    @if(isMenuRender('TechniciansController@index',$menu_list))
                        <li @if($current_location=='TechniciansController@index') class="active-item" @endif><a href="{{ route('technicians.index',[]) }}">Technician Lists</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Technician Managements end-->

        @if(isMenuRender('ServicesController@history',$menu_list))
            <li @if($current_location=='ServicesController@history') class="active-item" @endif><a href="{{ route('services.history',[]) }}">Service History</a></li>
        @endif

         @if(isMenuRender('ServicesController@problemEntry',$menu_list))
            <li @if($current_location=='ServicesController@problemEntry') class="active-item" @endif><a href="{{ route('services.problemEntry',[]) }}">Complain Entry</a></li>
        @endif
        @if(isMenuRender('ServicesController@problemEntryList',$menu_list))
            <li @if($current_location=='ServicesController@problemEntryList') class="active-item" @endif><a href="{{ route('services.problemEntryList',['new']) }}">Complain Lists</a></li>
        @endif
         @if(isMenuRender('ServicesController@damageApplicationList',$menu_list))
            <li @if($current_location=='ServicesController@damageApplicationList') class="active-item" @endif><a href="{{ route('services.damageApplicationList',['new']) }}">Damage Applications</a></li>
        @endif

    </ul>
</li>
