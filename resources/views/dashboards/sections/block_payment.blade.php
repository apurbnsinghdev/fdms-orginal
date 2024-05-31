<div class="col-md-4">
    <h4 class="section-subtitle"><b>Payment</b> Verify </h4>
    <div class="panel">
        <div class="panel-content">
            <div class="widget-list list-left-element list-sm  nano has-scrollbar">
                <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                 @if($payment->count())
                 @foreach($payment as $value)
                    <li>
                        <a href="{{ route('requisitions.payment_verify',[$value->id]) }}">
                            <div class="left-element">{{mystudy_case($value->payment_methods)}}</div>
                            <div class="text">
                                <span class="title">{{$value->receive_amount}}Tk (@if($value->shop){{$value->shop->outlet_name}}@endif)</span>
                                <span>&nbsp;&nbsp;Verify</span>
                            </div>
                        </a>
                    </li>
                    @endforeach
                @else
                <li class="text-danger middle-align"> There is no payment to verify</li>
                @endif
                </ul>
            </div>
        </div>
    </div>
</div>