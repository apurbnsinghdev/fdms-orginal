<div class="header-section hidden-xs" id="notice-headerbox">
    <!--check list-->
    <div class="notice" id="checklist-notice">
        <i class="fa fa-check-square-o" aria-hidden="true"></i>
        <div class="dropdown-box basic">
            <div class="drop-header">
                <h3><i class="fa fa-check-square-o" aria-hidden="true"></i> To-Do List</h3>
            </div>
            <div class="drop-content">
                <div class="widget-list list-to-do">
                    <ul>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-s1" value="option1">
                                <label class="check" for="check-s1">Accusantium eveniet ipsam neque</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-s2" value="option1" checked>
                                <label class="check" for="check-s2">Lorem ipsum dolor sit</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-s3" value="option1">
                                <label class="check" for="check-s3">Dolor eligendi in ipsum sapiente</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-s4" value="option1">
                                <label class="check" for="check-s4">Natus recusandae vel</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-s5" value="option1">
                                <label class="check" for="check-s5">Adipisci amet officia tempore ut</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="drop-footer">
                <a>See all Items</a>
            </div>
        </div>
    </div>
    <!--messages-->
    <div class="notice" id="messages-notice">
        <i class="fa fa-comments-o" aria-hidden="true"><span class="badge badge-xs badge-top-right x-danger"><i class="fa fa-exclamation"></i></span>
        </i>
        <div class="dropdown-box basic">
            <div class="drop-header ">
                <h3><i class="fa fa-comments" aria-hidden="true"></i> Messages</h3>
                <span class="badge x-danger b-rounded">120</span>
            </div>
            <div class="drop-content">
                <div class="widget-list list-left-element">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="left-element"><img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_1.jpg') }}" /></div>
                                <div class="text">
                                    <span class="title">John Doe</span>
                                    <span class="subtitle">hello world</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_2.jpg') }}" /></div>
                                <div class="text">
                                    <span class="title">Alice Smith</span>
                                    <span class="subtitle">hello world</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_3.jpg') }}" /></div>
                                <div class="text">
                                    <span class="title">Klaus Wolf</span>
                                    <span class="subtitle">hello world</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_4.jpg') }}" /></div>
                                <div class="text">
                                    <span class="title">Sun Li</span>
                                    <span class="subtitle">hello world</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_5.jpg') }}" /></div>
                                <div class="text">
                                    <span class="title">Sonia Valera</span>
                                    <span class="subtitle">hello world</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="drop-footer">
                <a>See all messages</a>
            </div>
        </div>
    </div>
    <!--alerts notices-->
    <div class="notice" id="alerts-notice">
        <i class="fa fa-bell-o" aria-hidden="true"><span class="badge badge-xs badge-top-right x-danger">7</span></i>

        <div class="dropdown-box basic">
            <div class="drop-header">
                <h3><i class="fa fa-bell-o" aria-hidden="true"></i> Notifications</h3>
                <span class="badge x-danger b-rounded">7</span>

            </div>
            <div class="drop-content">
                <div class="widget-list list-left-element list-sm">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-warning color-warning"></i></div>
                                <div class="text">
                                    <span class="title">8 Bugs</span>
                                    <span class="subtitle">reported today</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-flag color-danger"></i></div>
                                <div class="text">
                                    <span class="title">Error</span>
                                    <span class="subtitle">sevidor C down</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-cog color-dark"></i></div>
                                <div class="text">
                                    <span class="title">New Configuration</span>
                                    <span class="subtitle"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-tasks color-success"></i></div>
                                <div class="text">
                                    <span class="title">14 Task</span>
                                    <span class="subtitle">completed</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-envelope color-primary"></i></div>
                                <div class="text">
                                    <span class="title">21 Menssage</span>
                                    <span class="subtitle"> (see more)</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="drop-footer">
                <a>See all notifications</a>
            </div>
        </div>
    </div>
    <div class="header-separator"></div>
</div>