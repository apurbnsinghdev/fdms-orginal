@extends('layouts.admin')
@section('content')
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">UI Elements</a></li>
            <li><a>Accordions</a></li>
        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <!--ACCORDIONS OPEN ITEMS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle">Accordions <b>Open mode</b></h4>
        <p class="section-text">Set to have open <span class="highlight">one</span> or <span class="highlight">multiple</span> panels at the same time</p>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--SINGLE ITEM OPEN-->
                    <div class="col-md-6">
                        <h5><b>Single</b> item open</h5>
                        <div class="panel-group" id="accordion_group">
                            <div class="panel panel-accordion">
                                <div class="panel-header bg-scale-0">
                                    <a class="panel-title" data-toggle="collapse" data-parent="#accordion_group" href="#accordion1">
                                        Accordion 1
                                    </a>
                                </div>
                                <div id="accordion1" class="panel-collapse collapse in">
                                    <div class="panel-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion ">
                                <div class="panel-header bg-scale-0">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group" href="#accordion2">
                                        Accordion 2
                                    </a>
                                </div>
                                <div id="accordion2" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header bg-scale-0">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group" href="#accordion3">
                                        Accordion 3
                                    </a>
                                </div>
                                <div id="accordion3" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>To have only one item open at once, add the property <span class="highlight">"data-parent"</span> to each of the items with the id of the div that wrap the accordions.</p>
                        <p>Example, <span class="code">data-parent="#accordion_group"</span></p>
                    </div>
                    <!--MULTIPLES ITEMS OPEN-->
                    <div class="col-md-6">
                        <h5><b>Multiples</b> items open</h5>
                        <div class="panel-group" id="accordion_group2">
                            <div class="panel panel-accordion">
                                <div class="panel-header bg-scale-0">
                                    <a class="panel-title" data-toggle="collapse" href="#accordion4">
                                        Accordion 1
                                    </a>
                                </div>
                                <div id="accordion4" class="panel-collapse collapse in">
                                    <div class="panel-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header bg-scale-0">
                                    <a class="panel-title collapsed" data-toggle="collapse" href="#accordion5">
                                        Accordion 2
                                    </a>
                                </div>
                                <div id="accordion5" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header bg-scale-0">
                                    <a class="panel-title collapsed" data-toggle="collapse" href="#accordion6">
                                        Accordion 3
                                    </a>
                                </div>
                                <div id="accordion6" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
    <!--ACCORDIONS COLORS-->
    <div class="col-sm-12">
        <h4 class="section-subtitle mt-xlg">Accordions <b>Colors</b></h4>
        <p class="section-text">Set <span class="highlight">Background</span> or <span class="highlight">Border</span> colors to the header of the items</p>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <!--BACKGROUNDS CORLORS-->
                    <div class="col-md-6">
                        <h5><b>Background</b> colors</h5>
                        <p>Add to the div.panel-header the class <small class="code ">.panel-[name]</small></p>
                        <div class="panel-group" id="accordion_group4">
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-success">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group4" href="#accordion-bg-1">
                                        Accordion Success
                                    </a>
                                </div>
                                <div id="accordion-bg-1" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-warning">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group4" href="#accordion-bg-2">
                                        Accordion Warning
                                    </a>
                                </div>
                                <div id="accordion-bg-2" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-danger">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group4" href="#accordion-bg-3">
                                        Accordion Danger
                                    </a>
                                </div>
                                <div id="accordion-bg-3" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-info">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group4" href="#accordion-bg-4">
                                        Accordion Info
                                    </a>
                                </div>
                                <div id="accordion-bg-4" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion_group6">
                            <p>And the primary color and its light and dark versions as background color</p>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-darker-1">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group6" href="#accordion-bg-5">
                                        Accordion Darker-1
                                    </a>
                                </div>
                                <div id="accordion-bg-5" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-primary">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group6" href="#accordion-bg-6">
                                        Accordion Primary
                                    </a>
                                </div>
                                <div id="accordion-bg-6" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-lighter-1">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group6" href="#accordion-bg-7">
                                        Accordion Lighter-1
                                    </a>
                                </div>
                                <div id="accordion-bg-7" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--BORDER COLORS TABS-->
                    <div class="col-md-6">
                        <h5><b>Border</b> colors</h5>
                        <p>Add to the div.panel-header the class <small class="code ">.panel-[name]</small> and
                            <small class="code">.border</small>
                        </p>
                        <div class="panel-group" id="accordion_group3">
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-success border">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group3" href="#accordion-border-1">
                                        Accordion Success
                                    </a>
                                </div>
                                <div id="accordion-border-1" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-warning border">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group3" href="#accordion-border-2">
                                        Accordion Warning
                                    </a>
                                </div>
                                <div id="accordion-border-2" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-danger border">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group3" href="#accordion-border-3">
                                        Accordion Danger
                                    </a>
                                </div>
                                <div id="accordion-border-3" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-info border">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group3" href="#accordion-border-4">
                                        Accordion Info
                                    </a>
                                </div>
                                <div id="accordion-border-4" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion_group5">
                            <p>You can use the primary color and its light and dark versions as border color</p>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-darker-1 border">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group3" href="#accordion-border-5">
                                        Accordion Darker-1
                                    </a>
                                </div>
                                <div id="accordion-border-5" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-primary border">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group3" href="#accordion-border-6">
                                        Accordion Primary
                                    </a>
                                </div>
                                <div id="accordion-border-6" class="panel-collapse collapse">
                                    <div class="panel-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae tellus tincidunt, mattis odio eu, accumsan quam. Duis ultricies, erat nec suscipit mattis, risus est efficitur enim, sed finibus lacus nisi et mauris. Ut sed accumsan ipsum. Aliquam vel nibh et turpis euismod porttitor. In diam odio, cursus eget faucibus quis, efficitur id erat. Aliquam euismod in justo sit amet ornare. Quisque eu fringilla libero. Donec iaculis sit amet nibh non laoreet. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-accordion">
                                <div class="panel-header panel-lighter-1 border">
                                    <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion_group3" href="#accordion-border-7">
                                        Accordion Lighter-1
                                    </a>
                                </div>
                                <div id="accordion-border-7" class="panel-collapse collapse">
                                    <div class="panel-content">
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
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
@endsection