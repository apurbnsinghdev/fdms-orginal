<div class="col-md-4">
    <h4 class="section-subtitle"><b>Return DF</b> Status </h4>
    <div class="panel">
        <div class="row dash-box-height fourBox">
            @foreach ($df_returns as $key=>$val)
                <div class="col-md-6">
                    <a href="{{ route('returns.index',[$key]) }}">
                        <div class="dash-box-heightIn">
                            <h4 class="subtitle">
                                @if ($key=='new')
                                   Pending
                                @else
                                    {{ mystudy_case($key) }}
                                @endif
                            </h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5 class="title color-primary">{{$val}}</h5>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img class="svg" src="{{ asset('storage/images/dashboard-icon/'.$key.'.png') }}" alt="dfno">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>