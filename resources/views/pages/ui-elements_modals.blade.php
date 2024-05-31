@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Modals</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row">
    <div class="col-md-6">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--BASIC MODALS-->
        <h4 class="section-subtitle"><b>Basic</b> Modal</h4>
        <div class="panel">
            <div class="panel-content">
                <p>Basic <span class="highlight">bootstrap</span> modals</p>
                <!--DEFAULT modal-->
                <button type="button" class="btn btn-wide btn-primary btn-o" data-toggle="modal" data-target="#default-modal">Default</button>
                <!-- Modal -->
                <div class="modal fade" id="default-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-label">Default Modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--NO HEADER modal-->
                <button type="button" class="btn btn-wide  btn-primary btn-o" data-toggle="modal" data-target="#noheader-modal">No Header</button>
                <!-- Modal -->
                <div class="modal fade" id="noheader-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--NO FOOTER modal-->
                <button type="button" class="btn btn-wide  btn-primary btn-o" data-toggle="modal" data-target="#nofooter-modal">No Footer</button>
                <!-- Modal -->
                <div class="modal fade" id="nofooter-modal" tabindex="-1" role="dialog" aria-labelledby="modal-nofooter-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-nofooter-label">No Footer Modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--SIZES MODALS-->
        <h4 class="section-subtitle"><b>Sizes</b> of the Modals</h4>
        <div class="panel">
            <div class="panel-content">
                <p>Add the class <span class="code">.[size]-modal</span> to change the size of the modal</p>
                <!--LARGE modal-->
                <button type="button" class="btn btn-wide btn-primary" data-toggle="modal" data-target="#lg-modal">lg size</button>
                <!-- Modal -->
                <div class="modal fade" id="lg-modal" tabindex="-1" role="dialog" aria-labelledby="modal-large-label">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-large-label">Large modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur dignissimos minima nostrum omnis sapiente! Aut, culpa cum cupiditate, delectus dolor eos esse, harum id illo in maxime minima molestiae nostrum odio recusandae sunt voluptates? Autem esse ipsum libero saepe.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--MEDIUM modal-->
                <button type="button" class="btn btn-wide btn-primary" data-toggle="modal" data-target="#md-modal">default</button>
                <!-- Modal -->
                <div class="modal fade" id="md-modal" tabindex="-1" role="dialog" aria-labelledby="modal-default-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-default-label">Default modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--SMALL modal-->
                <button type="button" class="btn btn-wide btn-primary" data-toggle="modal" data-target="#sm-modal">sm size</button>
                <!-- Modal -->
                <div class="modal fade" id="sm-modal" tabindex="-1" role="dialog" aria-labelledby="modal-small-label">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-small-label">Small modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--STYLE MODALS-->
        <h4 class="section-subtitle"><b>Styles</b> of the Modals</h4>
        <div class="panel">
            <div class="panel-content">
                <p>Add the classes <span class="code">.state</span> & <span class="code">.[state-name]</span> to the modal header for states modals</p>
                <!--SUCCESS modal-->
                <button type="button" class="btn btn-wide btn-success" data-toggle="modal" data-target="#success-modal">Success</button>
                <!-- Modal -->
                <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="modal-success-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-success">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-success-label"><i class="fa fa-check"></i>Success Modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--WARNING modal-->
                <button type="button" class="btn btn-wide btn-warning" data-toggle="modal" data-target="#warning-modal">Warning</button>
                <!-- Modal -->
                <div class="modal fade" id="warning-modal" tabindex="-1" role="dialog" aria-labelledby="modal-warning-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-warning">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-warning-label"><i class="fa fa-exclamation"></i>Warning Modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--DANGER modal-->
                <button type="button" class="btn btn-wide btn-danger" data-toggle="modal" data-target="#error-modal">Danger</button>
                <!-- Modal -->
                <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="modal-error-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-danger">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-error-label"><i class="fa fa-warning"></i>Danger Modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--INFO modal-->
                <button type="button" class="btn btn-wide btn-info" data-toggle="modal" data-target="#info-modal">Info</button>
                <!-- Modal -->
                <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-info">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-info-label"><i class="fa fa-info"></i>Info Modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--PRIMARY modal-->
                <button type="button" class="btn btn-wide btn-primary" data-toggle="modal" data-target="#primary-modal">Primary</button>
                <!-- Modal -->
                <div class="modal fade" id="primary-modal" tabindex="-1" role="dialog" aria-labelledby="modal-primary-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-primary-label"><i class="fa fa-user"></i>Primary Modal</h4>
                            </div>
                            <div class="modal-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, magni suscipit. Dicta dolorem earum esse, fugiat harum minus neque nesciunt, quas reiciendis rem repudiandae rerum? Adipisci et labore laborum quidem!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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