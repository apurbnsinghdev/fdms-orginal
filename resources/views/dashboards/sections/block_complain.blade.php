<div class="col-md-4">
    <h4 class="section-subtitle"><b>Complain</b> Status</h4>
    <div class="panel">
        <div class="dash-box-height six-box">
            <div class="manageHgt">
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Latest Complain</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{ $complainStatus->get('latest')}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/latestC.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0)">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Last Complain</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{$complainStatus->get('last')}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/lastC.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="manageHgt">
                <div class="row">
                     <div class="col-md-6">
                        <a href="javascript:void(0)">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">This Month</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{$complainStatus->get('currentMonth')}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/currentmonth.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0)">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">This Month Solved</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{$complainStatus->get('currentMonthSolved')}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/thismonthsolve.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="manageHgt">
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Latest Solved</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{$complainStatus->get('latestSolved')}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/latestCsolve.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('servicereports.longPendingComplain') }}">
                            <div class="dash-box-heightIn">
                                <h4 class="subtitle">Long Pending</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5 class="title color-primary">{{$complainStatus->get('longPending')}}</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <img class="svg" src="{{ asset('storage/images/dashboard-icon/longpending.png') }}" alt="dfno">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>