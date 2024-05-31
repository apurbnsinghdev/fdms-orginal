<li class=" has-child-item{{ check_menu_active($current_location,config('myconfig.menu.user')) }}">
    <a><i class="fa fa-user" aria-hidden="true"></i><span>User Module</span></a>
     <ul class="nav child-nav level-1">

         <!-- Profile start-->
        @if(isMenuRender('RegisterController@showUser',$menu_list))
             <li @if($current_location=='RegisterController@showUser') class="active-item" @endif>
                <a href="{{ route('users.show',[]) }}">View Profile</a>
            </li>
        @endif
        <!-- Profile end=======-->

        <!-- changePassword start-->
        @if(isMenuRender('RegisterController@changePassword',$menu_list))
             <li @if($current_location=='RegisterController@changePassword') class="active-item" @endif>
                <a href="{{ route('password.change',[]) }}">Change Your Password</a>
            </li>
        @endif
        <!-- changePassword end=======-->

        <!-- Role Managements start-->
        @if(isMenuRender(['RolesController@create','RolesController@index'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['RolesController']) }}">
                <a><span>Role Setup</span></a>
                 <ul class="nav child-nav level-2">
                @if(isMenuRender('RolesController@create',$menu_list))
                    <li @if($current_location=='RolesController@create') class="active-item" @endif><a href="{{ route('roles.create',[]) }}">Add Role</a></li>
                @endif
                 @if(isMenuRender('RolesController@index',$menu_list))
                    <li @if($current_location=='RolesController@index') class="active-item" @endif><a href="{{ route('roles.index',[]) }}">Role Lists</a></li>
                @endif
                </ul>
            </li>
        @endif
        <!-- Role Managements end-->

        <!-- User Managements start-->
         @if(isMenuRender(['RegisterController@showRegistrationForm','RegisterController@showUserLists','ImpersonatesController@syncCreate','ImpersonatesController@syncList'],$menu_list))
            <li class="has-child-item{{ check_menu_active($current_location,['RegisterController','ImpersonatesController']) }}">
                <a><span>User Setup</span></a>
                <ul class="nav child-nav level-2">
                    @if(isMenuRender('RegisterController@showRegistrationForm',$menu_list))
                        <li @if($current_location=='RegisterController@showRegistrationForm') class="active-item" @endif><a href="{{ route('register',[]) }}">Add User</a></li>
                    @endif
                    @if(isMenuRender('RegisterController@showUserLists',$menu_list))
                        <li @if($current_location=='RegisterController@showUserLists') class="active-item" @endif><a href="{{ route('users.index',[]) }}">User Lists</a></li>
                    @endif
                    @if(isMenuRender('ImpersonatesController@syncCreate',$menu_list))
                        <li @if ($current_location=='ImpersonatesController@syncCreate')class="active-item"@endif>
                            <a href="{{ route('users.syncCreate') }}">Create Sync</a>
                        </li>
                    @endif
                    @if(isMenuRender('ImpersonatesController@syncList',$menu_list))
                        <li @if ($current_location=='ImpersonatesController@syncList')class="active-item"@endif>
                            <a href="{{ route('users.syncList') }}">Sync List</a>
                        </li>
                    @endif
                    @if(isMenuRender(['ImpersonatesController@SwitchAmongAllUsers'],$menu_list))
                        <li @if($current_location=='ImpersonatesController@SwitchAmongAllUsers') class="active-item" @endif>
                            <a href="{{ route('users.SwitchAmongAllUsers') }}">Switch Among All</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
    <!-- User Managements end-->
    </ul>
</li>
