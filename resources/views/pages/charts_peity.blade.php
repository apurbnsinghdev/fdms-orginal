@extends('layouts.admin')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-pie-chart" aria-hidden="true"></i><a href="#">Charts</a></li>
            <li><a>Peity</a></li>
        </ul>
    </div>
</div>
<div class="animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="section-subtitle text-center"><b>Peity Chart</b></h4>
        </div>
        <div class="col-sm-8 col-sm-offset-2">
            <p class="section-text text-center  mb-xl"><span class="highlight">Peity</span> is a jQuery plugin that converts an element's content into a <code>&lt;svg&gt;</code> mini pie <span class="pie-chart">2/5</span> donut <span class="donut-chart">5,2,3</span> line <span class="line-chart">5,3,9,6,5,9,7,3,5,2</span> or bar chart <span class="bar-chart">5,3,9,6,5,9,7,3,5,2</span> and is compatible with any browser that supports <code>&lt;svg&gt;</code>: Chrome, Firefox, IE9+, Opera, Safari.  For more <a href="http://benpickles.github.io/peity/">Info</a></p>
        </div>
    </div>
    <div class="row">
        <!--LINE CHART-->
        <div class="col-sm-6">
            <h4 class="section-subtitle"><b>Line</b> Chart</h4>
            <div class="panel">
                <div class="panel-content">
                    <p>Options:
                        <span class="highlight">delimiter</span>,
                        <span class="highlight">fill</span>,
                        <span class="highlight">height</span>,
                        <span class="highlight">max</span>,
                        <span class="highlight">min</span>,
                        <span class="highlight">stroke</span>,
                        <span class="highlight">stroke</span>,
                        <span class="highlight">strokeWidth</span> and
                        <span class="highlight">width</span>
                      </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Chart</th>
                                <th>Code</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span class="line-chart">5,3,9,6,5,9,7,3,5,2</span></td>
                                <td><code>&lt;span class="line-chart"&gt;5,3,9,6,5,9,7,3,5,2&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="line-chart">5,3,2,-1,-3,-2,2,3,5,2</span></td>
                                <td><code>&lt;span class="line-chart"&gt;5,3,2,-1,-3,-2,2,3,5,2&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="line-chart">0,-3,-6,-4,-5,-4,-7,-3,-5,-2</span></td>
                                <td><code>&lt;span class="line-chart"&gt;0,-3,-6,-4,-5,-4,-7,-3,-5,-22&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="line-chart" data-peity='{"height": 50, "width": 60}'>0,-3,-6,-4,-5,-4,-7,-3,-5,-2</span></td>
                                <td><code>&lt;span class="line-chart" <span class="highlight">data-peity='{"height": 50, "width": 60}'</span>&gt;0,-3,-6,-4,-5,-4,-7,-3,-5,-22&lt/span&gt;</code></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--BAR CHART-->
        <div class="col-sm-6">
            <h4 class="section-subtitle"><b>Bar</b> Chart</h4>
            <div class="panel">
                <div class="panel-content">
                    <p>Options:
                        <span class="highlight">delimiter</span>,
                        <span class="highlight">fill</span>,
                        <span class="highlight">height</span>,
                        <span class="highlight">max</span>,
                        <span class="highlight">min</span>,
                        <span class="highlight">padding</span> and
                        <span class="highlight">width</span>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Chart</th>
                                <th>Code</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span class="bar-chart">5,3,9,6,5,9,7,3,5,2</span></td>
                                <td><code>&lt;span class="bar-chart"&gt;5,3,9,6,5,9,7,3,5,2&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="bar-chart">5,3,2,-1,-3,-2,2,3,5,2</span></td>
                                <td><code>&lt;span class="bar-chart"&gt;5,3,2,-1,-3,-2,2,3,5,2&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="bar-chart">0,-3,-6,-4,-5,-4,-7,-3,-5,-2</span></td>
                                <td><code>&lt;span class="bar-chart"&gt;0,-3,-6,-4,-5,-4,-7,-3,-5,-22&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="bar-chart" data-peity='{"height": 50, "width": 60}'>0,-3,-6,-4,-5,-4,-7,-3,-5,-2</span></td>
                                <td><code>&lt;span class="bar-chart" <span class="highlight">data-peity='{"height": 50, "width": 60}'</span>&gt;0,-3,-6,-4,-5,-4,-7,-3,-5,-22&lt/span&gt;</code></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row">
        <!--DONUT CHART-->
        <div class="col-sm-6">
            <h4 class="section-subtitle"><b>Donut</b> Chart</h4>
            <div class="panel">
                <div class="panel-content">
                    <p>Options:
                        <span class="highlight">delimiter</span>,
                        <span class="highlight">fill</span>,
                        <span class="highlight">height</span>,
                        <span class="highlight">radius</span>
                        <span class="highlight">innerRadius</span> and
                        <span class="highlight">width</span>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Chart</th>
                                <th>Code</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td><span class="donut-chart">1/5</span></td>
                                <td><code>&lt;span class="donut-chart"&gt;1/5&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="donut-chart">226/360</span></td>
                                <td><code>&lt;span class="donut-chart"&gt;226/360&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="donut-chart">0.52/1.561</span></td>
                                <td><code>&lt;span class="donut-chart"&gt;0.52/1.561&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="donut-chart">1,4</span></td>
                                <td><code>&lt;span class="donut-chart"&gt;1,42&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="donut-chart">226,134</span></td>
                                <td><code>&lt;span class="donut-chart"&gt;226,1342&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="donut-chart">0.52,1.041</span></td>
                                <td><code>&lt;span class="donut-chart"&gt;0.52,1.0412&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="donut-chart">1,2,3,2,2</span></td>
                                <td><code>&lt;span class="donut-chart"&gt;1,2,3,2,22&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="donut-chart" data-peity='{"innerRadius": 10, "radius": 30 }'>10,5</span></td>
                                <td><code>&lt;span class="donut-chart" <span class="highlight">data-peity='{"innerRadius": 10, "radius": 30 }'</span>&gt;10,52&lt/span&gt;</code></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--PIE CHART-->
        <div class="col-sm-6">
            <h4 class="section-subtitle"><b>Pie</b> Chart</h4>
            <div class="panel">
                <div class="panel-content">
                    <p>Options:
                        <span class="highlight">delimiter</span>,
                        <span class="highlight">fill</span>,
                        <span class="highlight">height</span>,
                        <span class="highlight">radius</span> and
                        <span class="highlight">width</span>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Chart</th>
                                <th>Code</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td><span class="pie-chart">1/5</span></td>
                                <td><code>&lt;span class="pie-chart"&gt;1/5&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="pie-chart">226/360</span></td>
                                <td><code>&lt;span class="pie-chart"&gt;226/360&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="pie-chart">0.52/1.561</span></td>
                                <td><code>&lt;span class="pie-chart"&gt;0.52/1.561&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="pie-chart">1,4</span></td>
                                <td><code>&lt;span class="pie-chart"&gt;1,42&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="pie-chart">226,134</span></td>
                                <td><code>&lt;span class="pie-chart"&gt;226,1342&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="pie-chart">0.52,1.041</span></td>
                                <td><code>&lt;span class="pie-chart"&gt;0.52,1.0412&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="pie-chart">1,2,3,2,2</span></td>
                                <td><code>&lt;span class="pie-chart"&gt;1,2,3,2,22&lt/span&gt;</code></td>
                            </tr>
                            <tr>
                                <td><span class="pie-chart" data-peity='{ "radius": 30 }'>24,5</span></td>
                                <td><code>&lt;span class="pie-chart" <span class="highlight">data-peity='{ "radius": 30 }'</span>&gt;24,52&lt/span&gt;</code></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
 <script src="{{ asset('vendor/peity-chart/jquery.peity.min.js') }}"></script>
@stop

