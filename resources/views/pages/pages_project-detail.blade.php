@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-copy" aria-hidden="true"></i><a href="#">Pages</a></li>
            <li><a>Projects</a></li>
            <li><a>Datail</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row  animated fadeInRight">
    <div class="col-md-12 col-lg-8">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--HEADER INFO-->
        <div class="panel  project-detail">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12 p-project">
                        <div class="p-progress"><span class="donut">63/100</span><span class="value"> 63%</span></div>
                        <div class="p-data">
                            <h5 class="p-name">Update the Central Admin System, The Great Company</h5>
                            <div class="p-update">Last update: <span class="highlight">3 days ago</span></div>
                            <div class="p-status"><small>Status:</small> <span class="badge x-warning">Puased</span></div>
                            <div class="p-deadline"><small>Deadline: </small><b>1 week</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--PROJECT INFO-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel  b-primary bt-sm">
                    <div class="panel-header">
                        <h5 class="panel-title">Project Info</h5>
                    </div>
                    <div class="panel-content">
                        <div class="p-info">
                            <ul>
                                <li><span>Client</span> The Great Company</li>
                                <li><span>Created</span> 05-08-16</li>
                                <li><span>Costs</span> $24.500,00</li>
                                <li><span>In charge</span> Johanna Ferris</li>
                            </ul>
                            <ul>
                                <li><span>Contact Person</span>Daniel Tomas</li>
                                <li><span>Contact Phone</span>234.45.56.78</li>
                                <li><span>Contact Email</span> projects@greatcompany.com</li>
                                <li><span>Tags</span> <a href="#" class="badge x-primary b-rounded">Update</a> <a href="#" class="badge x-primary b-rounded">System</a>
                                    <a href="#" class="badge x-primary b-rounded"></i>Admin</a>
                                </li>
                            </ul>
                            <div class="p-description">
                                <span>Description</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. At consequuntur cupiditate delectus error, facere, fugit hic modi obcaecati pariatur qui quia temporibus velit, veniam! Aut debitis eligendi exercitationem harum libero nam nihil, porro. Distinctio est ex illum? Adipisci, atque, aut beatae blanditiis eaque, fuga laborum non placeat quidem reiciendis repudiandae.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel b-primary bt-sm ">
                    <div class="panel-header">
                        <h5 class="panel-title">Team Work</h5>
                    </div>
                    <div class="panel-content" style="height:300px">
                        <div class="nano">
                            <div class="nano-content">
                                <div class="widget-list list-left-element">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{ asset('images/helsinki.jpg') }}" /></div>
                                                <div class="text">
                                                    <span class="title">John Clark</span>
                                                    <span class="subtitle">Project Lider</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{ asset('images/helsinki.jpg') }}" /></div>
                                                <div class="text">
                                                    <span class="title">Ana Smith</span>
                                                    <span class="subtitle">Designer</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{ asset('images/helsinki.jpg') }}" /></div>
                                                <div class="text">
                                                    <span class="title">Javier Lopez</span>
                                                    <span class="subtitle">Developer</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{ asset('images/helsinki.jpg') }}" /></div>
                                                <div class="text">
                                                    <span class="title">Lisa Steal</span>
                                                    <span class="subtitle">Developer</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{ asset('images/helsinki.jpg') }}" /></div>
                                                <div class="text">
                                                    <span class="title">Laura Wasser</span>
                                                    <span class="subtitle">Developer</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{ asset('images/helsinki.jpg') }}" /></div>
                                                <div class="text">
                                                    <span class="title">Jess Green</span>
                                                    <span class="subtitle">Account manager</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel b-primary bt-sm ">
                    <div class="panel-header">
                        <h5 class="panel-title">To Do</h5>
                    </div>
                    <div class="panel-content" style="height:300px">
                        <div class="nano">
                            <div class="nano-content">
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
                                                <label class="check" for="check-simple1">Accusantium eveniet ipsam neque</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-primary">
                                                <input type="checkbox" id="check-simple6" value="option1" checked>
                                                <label class="check" for="check-simple5">Adipisci amet officia tempore ut</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-primary">
                                                <input type="checkbox" id="check-simple7" value="option1" checked>
                                                <label class="check" for="check-simple3">Dolor eligendi in ipsum sapiente</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-custom checkbox-primary">
                                                <input type="checkbox" id="check-simple8" value="option1">
                                                <label class="check" for="check-simple2">Lorem ipsum dolor sit</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--GALLERY-->
            <div class="col-sm-12">
                @include('pages.gallery')
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--TIMELINE-->
        <div class="timeline">
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-phone"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">Ello impedit iusto</h4> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
                </div>
                <div class="timeline-footer">
                    <span>Today. 14:25</span>
                </div>
            </div>
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-tasks"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">consectetur adipisicing </h4> Lorem ipsum dolor sit amet. Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
                </div>
                <div class="timeline-footer">
                    <span>Today. 10:55</span>
                </div>
            </div>
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-file"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">Impedit iusto minima nisi</h4> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur distinctio illo impedit iusto minima nisi quo tempora ut!
                </div>
                <div class="timeline-footer">
                    <span>Today. 9:20</span>
                </div>
            </div>
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-check"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">Consequatur distinctio illo</h4> tempora ut Lorem ipsum dolor sitga inventore magni molestiae porro quas sit. Amet corporis debitis deleniti excepturi nemo officia possimus quo sed voluptas? Necessitatibus, reprehenderit!
                </div>
                <div class="timeline-footer">
                    <span>Yesteday. 16:30</span>
                </div>
            </div>
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-phone"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">Tenetur totam veniam voluptatum</h4> Ab aperiam assumenda, consequatur culpa cumque delectus dicta ecessitatibus nemo nostrum numquam optio pariatur perferendis quae quis quos rem saepe suscipit tenetur totam veniam voluptatum?
                </div>
                <div class="timeline-footer">
                    <span>Yesteday. 9:30</span>
                </div>
            </div>
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-dollar"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">Lorem ipsum dolor sit</h4> Tinctio illo impedit iusto minima nisi quo tempora ut!
                </div>
                <div class="timeline-footer">
                    <span>24-11-16. 18:28</span>
                </div>
            </div>
            <div class="timeline-box">
                <div class="timeline-icon bg-primary">
                    <i class="fa fa-tasks"></i>
                </div>
                <div class="timeline-content">
                    <h4 class="tl-title">Iusto minima nisi</h4> Iillo impedit iusto minima nisi quo tempora ut Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam dolore molestias similique ut velit voluptate?
                </div>
                <div class="timeline-footer">
                    <span>24-11-16. 8:47</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection
@section('css')
  <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}">
@stop
@section('script')
   <!--peity chart-->
    <script src="{{ asset('vendor/peity-chart/jquery.peity.min.js') }}"></script>
    <script>
        $(".donut").peity("donut", {
            radius: 45,
            innerRadius: 25,
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

        //MAGNIFIC POPUP GALLERY
        $(function() {
            $('.gallery-wrap').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1]
                },
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-no-margins mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300
                }
            });
        });
    </script>
@stop
