<div class="col-md-4">
    <h4 class="section-subtitle"><b>DF Status</b> At A Glance</h4>
    <div class="panel">
        @if ($items['purchased']>0)
            <div class="row dash-box-height fourBox">
                <div class="col-md-6">
                    <a href="{{ route('inventoryreports.index',[1]) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Purchased</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['purchased'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/purchase.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('inventories.itemIndex',['injected_dF']) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Injected</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['injected'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/inject.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="#">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Stock</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['stock'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/stock.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('inventories.itemIndex',['in_sip_dF']) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">SIP</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['in_sip'],0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/in_sip.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @else
            <div class="dash-box-height">
                <div class="manageHgt">
                    <a href="{{ route('inventories.itemIndex',['injected_dF']) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Injected</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['injected'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/inject.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @if ($items['stock']>0)
                <div class="manageHgt">
                    <a href="#">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">Stock</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['stock'], 0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/stock.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="manageHgt">
                    <a href="{{ route('inventories.itemIndex',['in_sip_dF']) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">SIP</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{number_format($items['in_sip'],0)}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/in_sip.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>