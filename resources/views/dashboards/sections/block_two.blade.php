<div class="col-md-4">
    <h4 class="section-subtitle hidden-sm hidden-xs">&nbsp;</h4>
    <div class="panel">
        <div class="dash-box-height">
            <div class="manageHgt">
                <a href="{{ route('inventories.itemIndex',['support_dF']) }}">
                    <div class="dash-box-heightIn">
                        <h4 class="subtitle">Support</h4>
                        <div class="row">
                            <div class="col-xs-6">
                                <h5 class="title color-primary">{{number_format($items['support'], 0)}}</h5>
                            </div>
                            <div class="col-xs-6 text-right">
                                <img class="svg" src="{{ asset('storage/images/dashboard-icon/support.png') }}" alt="dfno">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="manageHgt">
                <a href="{{ route('inventories.itemIndex',['low_cooling_dF']) }}">
                    <div class="dash-box-heightIn">
                        <h4 class="subtitle">Low Cooling</h4>
                        <div class="row">
                            <div class="col-xs-6">
                                <h5 class="title color-primary">{{number_format($items['low_cooling'], 0)}}</h5>
                            </div>
                            <div class="col-xs-6 text-right">
                                <img class="svg" src="{{ asset('storage/images/dashboard-icon/low_cooling.png') }}" alt="dfno">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="manageHgt">
                <a href="{{ route('inventories.itemIndex',['damage_dF']) }}">
                    <div class="dash-box-heightIn">
                        <h4 class="subtitle">Damaged</h4>
                        <div class="row">
                            <div class="col-xs-6">
                                <h5 class="title color-primary">{{number_format($items['damage'], 0)}}
                                    @if ($items['initial_damage'])
                                        (init:{{ $items['initial_damage'] }})
                                    @endif
                                </h5>
                            </div>
                            <div class="col-xs-6 text-right">
                                <img class="svg" src="{{ asset('storage/images/dashboard-icon/damage.png') }}" alt="dfno">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>