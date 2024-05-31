@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-copy" aria-hidden="true"></i><a href="#">Pages</a></li>
            <li><a>Projects</a></li>
            <li><a>List</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="animated fadeInUp">
    <!--SEARCH-->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-content">
                    <form class="">
                        <div class="row pt-md">
                            <div class="form-group col-sm-9 col-lg-10">
                                    <span class="input-with-icon">
                                <input type="text" class="form-control" id="lefticon" placeholder="Search">
                                <i class="fa fa-search"></i>
                            </span>
                            </div>
                            <div class="form-group col-sm-3  col-lg-2 ">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--PROJECTS-->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-header bg-scale-0">
                    <h4>List of <span class="highlight">Projects</span> in the System</h4>
                    <h6 class="panel-subtitle">Total projects <b>57</b></h6>
                </div>
                <div class="panel-content">
                    <div class="projects-list">
                        <!--HEADER-->
                        <div class="row header-project-list">
                            <div class="col-sm-6 col-lg-6 h-project">
                                <div class="h-progress">Progress</div>
                                <div class="h-name">Project</div>
                            </div>
                            <div class="col-sm-2 col-lg-2 h-tags">Status</div>
                            <div class="col-sm-2 col-lg-2 h-deadline">Deadline</div>
                            <div class="col-sm-2 col-lg-2 h-options">Actions</div>
                        </div>
                        <!--ITEMS-->
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">55/100</span><span class="value"> 55%</span></div>
                                <h5 class="p-name">Lorem ipsum dolor sit amet consectetur adipisicing  consectetur officia.</h5>
                                <small class="p-update">Last update: <span class="highlight">4 days ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-danger">Stopped</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline days">5 days</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">90/100</span><span class="value"> 90%</span></div>
                                <h5 class="p-name">Consectetur adipisicing Lorem ipsum dolor sit amet</h5>
                                <small class="p-update">Last update: <span class="highlight">6 hours ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-success">Active</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline days">1 day</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">30/100</span><span class="value"> 30%</span></div>
                                <h5 class="p-name">Adipisicing el, quibusdam elit eleniti, officia.</h5>
                                <small class="p-update">Last update: <span class="highlight">1 week ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-warning">Puased</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline">2 weeks</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">70/100</span><span class="value"> 70%</span></div>
                                <h5 class="p-name">Fugit iste laborum laudantium magnam natus</h5>
                                <small class="p-update">Last update: <span class="highlight">3 hours ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-success">Active</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline days">3 days</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">45/100</span><span class="value"> 45%</span></div>
                                <h5 class="p-name">Necessitatibus pariatur possimus qui similique voluptates.</h5>
                                <small class="p-update">Last update: <span class="highlight">6 days ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-warning">Puased</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline">1 weeks</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">63/100</span><span class="value"> 63%</span></div>
                                <h5 class="p-name">Dolor ex excepturi explicabo facere,  quam sapiente, sit</h5>
                                <small class="p-update">Last update: <span class="highlight">1 week ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-warning">Puased</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline">3 weeks</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">100/100</span><span class="value"> 100%</span></div>
                                <h5 class="p-name">Adipisicing el, quibusdam elit eleniti, officia.</h5>
                                <small class="p-update">Last update: <span class="highlight">1 week ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge ">Completed</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline text-success">Deliver</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">84/100</span><span class="value"> 84%</span></div>
                                <h5 class="p-name">Officia quibusdam elit eleniti irtsum dolor sit amet, consectetur..</h5>
                                <small class="p-update">Last update: <span class="highlight">2 days ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-success">Active</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline days">6 days</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row item-project-list">
                            <div class="col-sm-12 col-lg-6 p-project">
                                <div class="p-progress"><span class="donut">14/100</span><span class="value"> 14%</span></div>
                                <h5 class="p-name">Adipisicing el, quibusdam elit eleniti, officia.</h5>
                                <small class="p-update">Last update: <span class="highlight">2 week ago</span></small>
                            </div>
                            <div class="col-sm-4 col-lg-2 p-tags"><span class="badge x-warning">Paused</span></div>
                            <div class="col-sm-4 col-lg-2 p-deadline">2 months</div>
                            <div class="col-sm-4 col-lg-2 p-options">
                                <div class="btn-group">
                                    <a href="pages_project-detail.html" class="btn fa fa-plus" data-toggle="tooltip" title="See more"></a><a class="btn fa fa-pencil" data-toggle="tooltip" title="Edit"></a><a class="btn  fa fa-trash" data-toggle="tooltip" title="Delete"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-caret-left"></i>
                                </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-caret-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('script')
   <!--peity chart-->
    <script src="{{ asset('vendor/peity-chart/jquery.peity.min.js') }}"></script>
    <script>
    $(".donut").peity("donut", {
        radius: 25,
        innerRadius: 16,
        fill: function(value, i) {

            if (i == 0) {

                if (value > 60) {
                    return "#88b93c";
                } else if (value > 30) {
                    return '#fea223';
                } else {
                    return '#d2322d';
                }
            } else {
                return '#ececec';
            }

        }
    })
</script>
@stop
