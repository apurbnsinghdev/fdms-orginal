<div class="page-header">
    <!-- LEFTSIDE header -->
    <div class="leftside-header">
        <div class="logo">
            <h4>
               <a href="{{ route('dashboard') }}"> {{ $site_settings->site_title or '' }} </a>
            </h4>
            {{-- <a href="{{ route('dashboard') }}">
                @if(!empty($site_settings->logo))
                    <img alt="logo" src="{{ asset('storage/images/'.$site_settings->logo) }}" />
                @else
                    <img alt="logo" src="{{ asset('storage/images/header-logo.png') }}" />
                @endif
            </a> --}}
        </div>
        <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <!-- RIGHTSIDE header -->
    <div class="rightside-header">
        <div class="header-middle"></div>
        <!--SEARCH HEADERBOX-->
        {{-- @include('common_pages.sections.search_headerbox') --}}
        <!--NOCITE HEADERBOX-->
        {{-- @include('common_pages.sections.notice_headerbox') --}}
        <!--USER HEADERBOX -->
        @include('common_pages.sections.user_headerbox')

        <div class="header-separator"></div>
        <!--Log out -->
        <div class="header-section">
            <a href="{{ route('logout') }}"
                data-toggle="tooltip" data-placement="left" title="Logout"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out log-out" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
           {{--  <a href="{{ url('login') }}" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a> --}}
        </div>
    </div>
</div>