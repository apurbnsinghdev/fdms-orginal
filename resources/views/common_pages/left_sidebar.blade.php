@php
    $current_location=class_basename(Route::currentRouteAction());
@endphp
<div class="left-sidebar">
    <!-- left sidebar HEADER -->
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">&nbsp;</div>
        <div onclick="addcollapsibleclass('left-sidebar-collapsed')" class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
            <span></span>
        </div>
    </div>
    <!-- ==========================NAVIGATION =====================-->
    <div id="left-nav" class="nano">
        <div class="nano-content">
            <nav>
                <ul class="nav nav-left-lines" id="main-nav">
                    <!--HOME-->
                    <li @if($current_location=='HomeController@index') class="active-item" @endif>
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- =========Configuraion Module start===================-->
                    @if(isMenuRender(config('myconfig.menu.configaration'),$controller_list))
                        @include('common_pages.menu_modules.configuration')
                    @endif
                    <!-- ==============Configuraion Module end================-->

                    <!-- ==============User Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.user'),$controller_list))
                        @include('common_pages.menu_modules.user')
                    @endif
                    <!-- ==============User Module end========================-->

                     <!-- ==============SMS Promotionals Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.sms_promotionals'),$controller_list))
                        @include('common_pages.menu_modules.sms_promotionals')
                    @endif
                    <!-- ==============SMS Promotionals Module end========================-->

                    <!-- ==============Inventory Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.inventory'),$controller_list))
                        @include('common_pages.menu_modules.inventory')
                    @endif
                    <!-- =============Inventory Module end============-->

                    <!-- ==========Requisition Module start===================-->
                    @if(isMenuRender(config('myconfig.menu.requisition'),$controller_list))
                        @include('common_pages.menu_modules.requisition')
                     @endif
                    <!-- =============Requisition Module end============-->

                    <!-- ==============Services Module start====================-->
                     @if(isMenuRender(config('myconfig.menu.service'),$controller_list))
                        @include('common_pages.menu_modules.service')
                     @endif
                    <!-- =============Services Module end============-->

                     <!-- ==============Return Module start====================-->
                     @if(isMenuRender(config('myconfig.menu.return'),$controller_list))
                        @include('common_pages.menu_modules.return')
                     @endif
                    <!-- =============Return Module end============-->

                     <!-- ==============settlement start====================-->
                     @if(isMenuRender(config('myconfig.menu.settlement'),$controller_list))
                        @include('common_pages.menu_modules.settlement')
                     @endif
                    <!-- =============settlement end============-->

                    <!-- ==============Uploads Module start====================-->
                    @if(isMenuRender(['UploadsController'],$controller_list))
                        @include('common_pages.menu_modules.upload')
                    @endif
                    <!-- =============Uploads Module end============-->

                    <!-- ==============Rport Module start====================-->
                    @if(isMenuRender(config('myconfig.menu.report'),$controller_list))
                        @include('common_pages.menu_modules.report')
                     @endif
                    <!-- =============Report Module end============-->

                    @if (env('APP_ENV') === 'local')
                        @include('common_pages.menu_modules.template_menu')
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>