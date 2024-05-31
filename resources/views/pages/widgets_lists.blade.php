@extends('layouts.admin')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-paper-plane" aria-hidden="true"></i><a href="#">Widgets</a></li>
            <li><a>Post</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--TO DO LIST simple-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle">To do list <b>Simple</b></h4>
        <div class="panel">
            <div class="panel-content p-none">
                <div class="widget-list list-to-do">
                    <ul>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-simple1" value="option1">
                                <label class="check" for="check-simple1">Accusantium eveniet ipsam neque</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-simple2" value="option1" checked>
                                <label class="check" for="check-simple2">Lorem ipsum dolor sit</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-simple3" value="option1">
                                <label class="check" for="check-simple3">Dolor eligendi in ipsum sapiente</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-simple4" value="option1">
                                <label class="check" for="check-simple4">Natus recusandae vel</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-simple5" value="option1">
                                <label class="check" for="check-simple5">Adipisci amet officia tempore ut</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--TO DO LIST with header-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle">To do list <b>with header</b></h4>
        <div class="panel b-primary bt-md">
            <div class="panel-content p-none">
                <div class="widget-list list-to-do">
                    <h4 class="list-title">To do List</h4>
                    <button class="add-item btn btn-o btn-primary btn-xs"><i class="fa fa-plus"></i></button>
                    <ul>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-h1" value="option1">
                                <label class="check" for="check-h1">Accusantium eveniet ipsam neque</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-h2" value="option1" checked>
                                <label class="check" for="check-h2">Lorem ipsum dolor sit</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-h3" value="option1">
                                <label class="check" for="check-h3">Dolor eligendi in ipsum sapiente</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-h4" value="option1">
                                <label class="check" for="check-h4">Natus recusandae vel</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-h5" value="option1">
                                <label class="check" for="check-h5">Adipisci amet officia tempore ut</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--TO DO LIST with footer-->
    <div class="col-sm-6 col-md-4">
        <h4 class="section-subtitle">To do list <b>with footer</b></h4>
        <div class="panel b-primary bt-md">
            <div class="panel-content p-none">
                <div class="widget-list list-to-do">
                    <h4 class="list-title">To do List</h4>
                    <button class="add-item btn btn-o  btn-primary btn-xs"><i class="fa fa-plus"></i></button>
                    <ul>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-f1" value="option1">
                                <label class="check" for="check-f1">Accusantium eveniet ipsam neque</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-f2" value="option1" checked>
                                <label class="check" for="check-f2">Lorem ipsum dolor sit</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-f3" value="option1">
                                <label class="check" for="check-f3">Dolor eligendi in ipsum sapiente</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-f4" value="option1">
                                <label class="check" for="check-f4">Natus recusandae vel</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="check-f5" value="option1">
                                <label class="check" for="check-f5">Adipisci amet officia tempore ut</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-center x-light">
                <a href="#">See more</a>
            </div>
        </div>
    </div>
</div>
<div class="row animated fadeInUp">
    <div class="col-sm-6 col-md-4">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LEST ELEMENT LIST with IMAGES-->
        <h4 class="section-subtitle"><b>Left element</b> list with img</h4>
        <div class="panel">
            <div class="panel-content">
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
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!-- SMALL LEST ELEMENT LIST with IMAGES-->
        <h4 class="section-subtitle pt-xl"><b>Small</b> left element list</h4>
        <p class="section-text">Add the <span class="highlight">class</span> <span class="code">list-sm</span> for the small version</p>
        <div class="panel">
            <div class="panel-content">
                <div class="widget-list list-left-element list-sm">
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
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LEST ELEMENT LIST with ICON-->
        <h4 class="section-subtitle"><b>Left element</b> list with icon</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="widget-list list-left-element ">
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
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--SMALL LEST ELEMENT LIST with ICON-->
        <h4 class="section-subtitle pt-xl"><b>Small</b> left element list</h4>
        <p class="section-text">Add the <span class="highlight">class</span> <span class="code">list-sm</span> for the small version</p>
        <div class="panel">
            <div class="panel-content">
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
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LEFT ELEMENT LIST WITH FOOTER-->
        <h4 class="section-subtitle "><b>Left element</b> list with footer</h4>
        <div class="panel b-primary bt-md">
            <div class="panel-content">
                <div class="widget-list list-left-element ">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-warning"></i></div>
                                <div class="text">
                                    <span class="title">8 Bugs</span>
                                    <span class="subtitle">reported today</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-flag"></i></div>
                                <div class="text">
                                    <span class="title">Error</span>
                                    <span class="subtitle">sevidor C down</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-cog "></i></div>
                                <div class="text">
                                    <span class="title">New Configuration</span>
                                    <span class="subtitle"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-tasks "></i></div>
                                <div class="text">
                                    <span class="title">14 Task</span>
                                    <span class="subtitle">completed</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-envelope"></i></div>
                                <div class="text">
                                    <span class="title">21 Menssage</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-center ">
                <a href="#">See more</a>
            </div>
        </div>
        <!--left icon list SMALL-->
        <h4 class="section-subtitle pt-xl"><b>Small</b> left element list with footer</h4>
        <p class="section-text">Add the <span class="highlight">class</span> <span class="code">list-sm</span> for the small version</p>
        <div class="panel b-primary bt-sm">
            <div class="panel-content">
                <div class="widget-list list-left-element list-sm">
                    <ul>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-warning "></i></div>
                                <div class="text">
                                    <span class="title">8 Bugs</span>
                                    <span class="subtitle">reported today</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-flag "></i></div>
                                <div class="text">
                                    <span class="title">Error</span>
                                    <span class="subtitle">sevidor C down</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-cog "></i></div>
                                <div class="text">
                                    <span class="title">New Configuration</span>
                                    <span class="subtitle"></span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-tasks "></i></div>
                                <div class="text">
                                    <span class="title">14 Task</span>
                                    <span class="subtitle">completed</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="left-element"><i class="fa fa-envelope"></i></div>
                                <div class="text">
                                    <span class="title">21 Menssage</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-footer text-center">
                <a href="#">See more</a>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection