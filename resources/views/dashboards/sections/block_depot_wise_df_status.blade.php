<div class="col-md-4">
    <h4 class="section-subtitle"><b>DF Status:</b> Depot Wise </h4>
    @php
    	$depotDfStatus=['injected'=>0,'stock'=>0,'low_cooling'=>0,'support'=>0];
    @endphp
    <div class="panel">
        <div class="panel-content">
            <div class="widget-list list-left-element list-sm minwidth nano has-scrollbar">
                <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                @if(count($depostDfStatus))
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Depot</th>
                                <th>Injected</th>
                                <th>Stock</th>
                                <th>Low Cooling</th>
                                <th>Support</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($depostDfStatus as $key => $value)
                        	@php
                        		$newArr = array_merge($depotDfStatus,$value);
                        	@endphp
                            <tr>
                                <td>{{$depots[$key]}}</td>
                                @foreach($newArr as $k => $vl)
                                <td>{{$vl}}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                 <ul style="position: relative;" class="dash-box-height-2 nano-content dashboard">
                    <li class="text-danger middle-align"> There is no inventory</li>
                 </ul>
                @endif
            </div>
        </div>
    </div>
</div>