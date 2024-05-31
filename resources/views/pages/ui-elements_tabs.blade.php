@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Tabs</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!--HORZONTAL TABS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Horizontal</b> Tabs</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--BASE TABS-->
                    <div class="col-md-12">
                        <h5><b>Basic</b> tabs</h5>
                        <div class="tabs">
                            <!-- Tabs Header -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                                <li><a href="#profile" data-toggle="tab">Profile</a></li>
                                <li><a href="#messages" data-toggle="tab">Messages</a></li>
                                <li><a href="#settings" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                            </ul>
                            <!-- Tabs Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <p><b>Home</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <p><b>Profile</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <p><b>Message</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="settings">
                                    <p><b>Settings</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--JUSTIFIED TABS-->
                    <div class="col-md-12">
                        <h5><b>Justified</b> tabs</h5>
                        <p>Add the class <span class="code">.nav-justified</span> to the div<span class="code">.nav-tabs</span></p>
                        <div class="tabs">
                            <!-- Tabs Header -->
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a href="#home2" data-toggle="tab">Home</a></li>
                                <li><a href="#profile2" data-toggle="tab">Profile</a></li>
                                <li><a href="#messages2" data-toggle="tab">Messages</a></li>
                                <li><a href="#settings2" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                            </ul>
                            <!-- Tabs Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home2">
                                    <p><b>Home</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="profile2">
                                    <p><b>Profile</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="messages2">
                                    <p><b>Message</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="settings2">
                                    <p><b>Settings</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--VERTICALS TABS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Vertical</b> Tabs</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--LEFT TABS-->
                    <div class="col-md-6">
                        <h5><b>Left</b> tabs</h5>
                        <p>Add the class <span class="code">.tabs-vertical</span> and <span class="code">.tabs-left</span> to the div<span class="code">.tabs</span></p>

                        <div class="tabs tabs-vertical tabs-left ">
                            <!-- Tabs Header -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home3" data-toggle="tab">Home</a></li>
                                <li><a href="#profile3" data-toggle="tab">Profile</a></li>
                                <li><a href="#messages3" data-toggle="tab">Messages</a></li>
                                <li><a href="#settings3" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                            </ul>
                            <!-- Tabs Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home3">
                                    <p><b>Home</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                                <div class="tab-pane fade" id="profile3">
                                    <p><b>Profile</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                                <div class="tab-pane fade" id="messages3">
                                    <p><b>Message</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                                <div class="tab-pane fade" id="settings3">
                                    <p><b>Settings</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--RIGHT TABS-->
                    <div class="col-md-6">
                        <h5><b>Right</b> tabs</h5>
                        <p>Add the class <span class="code">.tabs-vertical</span> and <span class="code">.tabs-right</span> to the div<span class="code">.tabs</span></p>
                        <div class="tabs tabs-vertical tabs-right">
                            <!-- Tabs Header -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home4" data-toggle="tab">Home</a></li>
                                <li><a href="#profile4" data-toggle="tab">Profile</a></li>
                                <li><a href="#messages4" data-toggle="tab">Messages</a></li>
                                <li><a href="#settings4" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                            </ul>
                            <!-- Tabs Content -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home4">
                                    <p><b>Home</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                                <div class="tab-pane fade" id="profile4">
                                    <p><b>Profile</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                                <div class="tab-pane fade" id="messages4">
                                    <p><b>Message</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                                <div class="tab-pane fade" id="settings4">
                                    <p><b>Settings</b> content</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
