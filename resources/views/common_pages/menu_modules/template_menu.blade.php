 <li class=" has-child-item close-item">
    <a>
        <i class="fa fa-sitemap" aria-hidden="true"></i>
        <span>Template Menu</span>
    </a>
    <ul class="nav child-nav level-1">
         <!--UI ELEMENTENTS-->
        <li class="has-child-item close-item">
            <a><i class="fa fa-cubes" aria-hidden="true"></i><span>UI Elements</span></a>
            <ul class="nav child-nav level-2">
                <li><a href="{{ route('template',array('ui-elements_panels')) }}">Panels</a></li>
                <li><a href="{{ route('template',array('ui-elements_accordions')) }}">Accordions</a></li>
                <li><a href="{{ route('template',array('ui-elements_tabs')) }}">Tabs</a></li>
                <li><a href="{{ route('template',array('ui-elements_buttons')) }}">Buttons</a></li>
                <li><a href="{{ route('template',array('ui-elements_typography')) }}">Typography</a></li>
                <li><a href="{{ route('template',array('ui-elements_alerts')) }}">Alerts</a></li>
                <li><a href="{{ route('template',array('ui-elements_modals')) }}">Modals</a></li>
                <li><a href="{{ route('template',array('ui-elements_lightbox')) }}">Lightbox</a></li>
                <li class="has-child-item close-item">
                    <a>Notifications</a>
                    <ul class="nav child-nav level-3 ">
                        <li><a href="{{ route('template',array('ui-elements_notifications-pnotify')) }}">PNotify</a></li>
                        <li><a href="{{ route('template',array('ui-elements_notifications-toastr')) }}">Toastr</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('template',array('ui-elements_animations-appear')) }}">Animations</a></li>
                <li><a href="{{ route('template',array('ui-elements_badges-tags')) }}">Badge & Tags</a></li>
            </ul>
        </li>
        <!--CHARTS-->
        <li class="has-child-item close-item">
            <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Charts</span> </a>
            <ul class="nav child-nav level-2">
                <li><a href="{{ route('template',array('charts_chart-js')) }}">CharJS</a></li>
                <li><a href="{{ route('template',array('charts_morris')) }}">Morris</a></li>
                <li><a href="{{ route('template',array('charts_peity')) }}">Peity</a></li>
            </ul>
        </li>
        <!--FORMS-->
        <li class="has-child-item close-item">
            <a><i class="fa fa-columns" aria-hidden="true"></i><span>Forms </span></a>
            <ul class="nav child-nav level-2">
                <li><a href="{{ route('template',array('forms_layouts')) }}">Layouts</a></li>
                <li><a href="{{ route('template',array('forms_elements')) }}">Elements</a></li>
                <li><a href="{{ route('template',array('forms_advanced')) }}">Advanced</a></li>
                <li><a href="{{ route('template',array('forms_validation')) }}">Validation</a></li>
                <li><a href="{{ route('template',array('forms_wizard')) }}">Wizard</a></li>
            </ul>
        </li>
        <!--TABLES-->
        <li class="has-child-item close-item">
            <a><i class="fa fa-table" aria-hidden="true"></i><span>Tables</span></a>
            <ul class="nav child-nav level-2">
                <li><a href="{{ route('template',array('tables_basic')) }}">Basic</a></li>
                <li><a href="{{ route('template',array('tables_data-tables')) }}">DataTable</a></li>
                <li><a href="{{ route('template',array('tables_responsive')) }}">Responsive</a></li>
            </ul>
        </li>
        <!--PAGES-->
        <li class="has-child-item close-item">
            <a><i class="fa fa-files-o" aria-hidden="true"></i><span>Pages</span></a>
            <ul class="nav child-nav level-2">
                <li><a href="{{ route('template',array('pages_sign-in')) }}">Sign in</a></li>
                <li><a href="{{ route('template',array('pages_register')) }}">Register</a></li>
                <li><a href="{{ route('template',array('pages_lock-screen')) }}">Lock screen</a></li>
                <li><a href="{{ route('template',array('pages_forgot-password')) }}">Forgot password</a></li>
                <li class="has-child-item close-item">
                    <a>Error pages</a>
                    <ul class="nav child-nav level-3 ">
                        <li><a href="{{ route('template',array('pages_error-404-content')) }}">Error 404 content</a></li>
                        <li><a href="{{ route('template',array('pages_error-404')) }}">Error 404 page</a></li>
                        <li><a href="{{ route('template',array('pages_error-500')) }}">Error 500</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('template',array('pages_faq')) }}">FAQ</a></li>
                <li><a href="{{ route('template',array('pages_user-profile')) }}">User profile</a></li>
                <li class="has-child-item close-item">
                    <a>Search results<span></a>
                    <ul class="nav child-nav level-3 ">
                        <li><a href="{{ route('template',array('pages_search-results-list')) }}">List style</a></li>
                        <li><a href="{{ route('template',array('pages_search-results-grid')) }}">Grid Style</a></li>
                    </ul>
                </li>
                <li class="has-child-item close-item">
                    <a>Projects<span></a>
                    <ul class="nav child-nav level-3 ">
                        <li><a href="{{ route('template',array('pages_project-list')) }}">List</a></li>
                        <li><a href="{{ route('template',array('pages_project-detail')) }}">Detail</a></li>
                    </ul>
                </li>

            </ul>
        </li>
        <!--WIDGETS-->
        <li class="has-child-item close-item">
            <a><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Widgets</span></a>
            <ul class="nav child-nav level-2">
                <li><a href="{{ route('template',array('widgets_boxes')) }}">Boxes</a></li>
                <li><a href="{{ route('template',array('widgets_lists')) }}">Lists</a></li>
                <li><a href="{{ route('template',array('widgets_posts')) }}">Posts</a></li>
                <li><a href="{{ route('template',array('widgets_timelines')) }}">Timelines</a></li>
            </ul>
        </li>
        <!--HELPERS-->
        <li class="has-child-item close-item">
            <a><i class="fa fa-magic" aria-hidden="true"></i><span>Helpers</span></a>
            <ul class="nav child-nav level-2">
                <li><a href="{{ route('template',array('helpers_background-border')) }}">Background & Border</a></li>
                <li><a href="{{ route('template',array('helpers_margin-padding')) }}">Margin & Padding</a></li>
            </ul>
        </li>

    </ul>
</li>