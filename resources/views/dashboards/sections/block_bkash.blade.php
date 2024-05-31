<div class="col-md-4">
    <h4 class="section-subtitle"><b>bKash</b> Payment Verify </h4>
    <div class="panel">
        <div class="panel-content">
            <div class="widget-list list-left-element list-sm nano has-scrollbar">
                <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                 @if($bkash->count())
                 @foreach($bkash as $value)
                    <li>
                        <a href="{{ route('requisitions.bkash_verify',[$value->id]) }}">
                            <div class="left-element">{{$value->payment_methods}}</div>
                            <div class="text">
                                <span class="title">{{$value->receive_amount}}Tk (@if($value->shop){{$value->shop->outlet_name}}@endif)</span>
                                <span>&nbsp;&nbsp;Verify</span>
                            </div>
                        </a>
                    </li>
                    @endforeach
                @else
                <li class="text-danger middle-align"> There is no bKash payment to verify</li>
                @endif
                </ul>
            </div>
        </div>
    </div>
</div>