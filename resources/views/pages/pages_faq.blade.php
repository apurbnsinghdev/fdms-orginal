@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-copy" aria-hidden="true"></i><a href="#">Pages</a></li>
            <li><a>FAQ</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="animated fadeInUp">
    <div class="row">
        <!--SEARCH-->
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
    <div class="row">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--QUESTIONS-->
        <div class="col-sm-12 col-md-8">
            <div class="panel">
                <div class="panel-content">
                    <!--GENERAL QUESTIONS-->
                    <h4><b>General questions</b></h4>
                    <div class="panel-group faq-accordion" id="accordion_faq">
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title" data-toggle="collapse" data-parent="#accordion_faq" href="#q1">
                                    <span class="color-primary text-bold">Q:</span> Lorem ipsum dolor sit amet?
                                </a>
                            </div>
                            <div id="q1" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <h5><b>Anim pariatur cliche reprehenderit</b></h5>
                                    <p>Enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_faq" href="#q2">
                                    <span class="color-primary text-bold">Q:</span> Accusamus, harum illo molestiae officia quis reiciendis?
                                </a>
                            </div>
                            <div id="q2" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aspernatur corporis dicta dolores eum eveniet maxime quis sint ut vitae.</p>
                                    <h5><b>Aliquam aspernatur:</b></h5>
                                    <p>Rint suscipit voluptas. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste laudantium nostrum porro. Architecto eum non officia perferendis saepe?</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_faq" href="#q3">
                                    <span class="color-primary text-bold">Q:</span> Consectetur adipisicing elit. Quo, ratione?
                                </a>
                            </div>
                            <div id="q3" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <p>Consectetur adipisicing elit. Aliquid aperiam aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis, dicta eos fuga inventore mollitia nemo quam repudiandae sed? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, id! consequatur consequuntur, doloribus eius, eveniet facilis modi nulla quidem ratione sequi ut!</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_faq" href="#q4">
                                    <span class="color-primary text-bold">Q:</span> Enim eiusmod high life accusamus terry?
                                </a>
                            </div>
                            <div id="q4" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <h5><b>Rariatur perferendis praesentium:</b></h5>
                                    <p> Adipisci aliquam autem consequuntur esse excepturi harum hic iusto molestias nostrum, officiis ratione reprehenderit ut.</p>
                                    <h5><b>Adipisicing elit:</b></h5>
                                    <p>Rem ipsum dolor sit amet, consectetur adipisicing elit. Debitis harum neque placeat quam ullam.</p>
                                    <ul>
                                        <li>Lorem ipsum dolor sit.</li>
                                        <li>Eligendi facilis rem repellendus.</li>
                                        <li>Dicta fugit molestiae rerum.</li>
                                        <li>Deserunt molestias saepe sit!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_faq" href="#q5">
                                    <span class="color-primary text-bold">Q:</span> Mesciunt you probably haven't heard of them accusamus labore sustainable?
                                </a>
                            </div>
                            <div id="q5" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <p>Peeas sit amet, consectetur adipisicing elit. Ab nobis, repellendus? Alias assumenda, cupiditate deleniti earum eius enim expedita, fuga in magnam perferendis praesentium quis repellendus sapiente totam vel voluptatum?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--SHIPPING QUESTIONS-->
                    <h4><b>Shipping questions</b></h4>
                    <div class="panel-group faq-accordion" id="accordion_faq2">
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title" data-toggle="collapse" data-parent="#accordion_faq2" href="#q1-ship">
                                    <span class="color-primary text-bold">Q:</span> Dolor sit amet orem ipsum dolor sit amet?
                                </a>
                            </div>
                            <div id="q1-ship" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <h5><b>Rariatur perferendis praesentium:</b></h5>
                                    <p> Adipisci aliquam autem consequuntur esse excepturi harum hic iusto molestias nostrum, officiis ratione reprehenderit ut.</p>
                                    <h5><b>Adipisicing elit:</b></h5>
                                    <p>Rem ipsum dolor sit amet, consectetur adipisicing elit. Debitis harum neque placeat quam ullam.</p>
                                    <ul>
                                        <li>Lorem ipsum dolor sit.</li>
                                        <li>Eligendi facilis rem repellendus.</li>
                                        <li>Dicta fugit molestiae rerum.</li>
                                        <li>Deserunt molestias saepe sit!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_faq2" href="#q2-ship">
                                    <span class="color-primary text-bold">Q:</span> Accusamus, harum illo molestiae officia quis reiciendis?
                                </a>
                            </div>
                            <div id="q2-ship" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aspernatur corporis dicta dolores eum eveniet maxime quis sint ut vitae.</p>
                                    <h5><b>Aliquam aspernatur:</b></h5>
                                    <p>Rint suscipit voluptas. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste laudantium nostrum porro. Architecto eum non officia perferendis saepe?</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_faq2" href="#q3-ship">
                                    <span class="color-primary text-bold">Q:</span> Consectetur adipisicing elit. Quo, ratione?
                                </a>
                            </div>
                            <div id="q3-ship" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <p>Consectetur adipisicing elit. Aliquid aperiam aspernatur Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquid corporis, dicta eos fuga inventore mollitia nemo quam repudiandae sed? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, id! consequatur consequuntur, doloribus eius, eveniet facilis modi nulla quidem ratione sequi ut!</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-accordion">
                            <div class="panel-header bg-scale-0">
                                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_faq2" href="#q4-ship">
                                    <span class="color-primary text-bold">Q:</span> Enim eiusmod high life accusamus terry?
                                </a>
                            </div>
                            <div id="q4-ship" class="panel-collapse collapse">
                                <div class="panel-content">
                                    <h5><b>Anim pariatur cliche reprehenderit</b></h5>
                                    <p>Enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--RIGHT SIDE OPTIONS-->
        <div class="col-sm-12 col-md-4">
            <!--CONTACT SUPPORT-->
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <h4 class="mb-md"> Contact Support </h4>
                    <ul class="list-unstyled ml-sm">
                        <li>
                            <h6><i class="mr-sm fa fa-clock-o"></i>Mon-Fri 8:00 - 18:00</h6></li>
                        <li>
                            <h6><i class="mr-sm fa fa-phone"></i>(012) 234 4321</h6></li>
                        <li>
                            <h6><i class="mr-sm fa fa-envelope"></i>contac@yourcomapany.com</h6></li>
                    </ul>
                </div>
            </div>
            <!--SUBMIT A TICKET-->
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <h4 class="mb-md">Submit ticket</h4>
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="question" class="control-label">Question</label>
                            <textarea class="form-control" rows="3" id="question" placeholder="Write your question"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection