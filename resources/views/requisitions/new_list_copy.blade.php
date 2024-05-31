<table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="no-sort">SI NO.</th>
        @if (!$isExecutive)
             <th class="no-sort">ASE/SE</th>
        @endif
        <th class="no-sort">Creator</th>
        <th class="no-sort">Outlet Name</th>
        <th class="no-sort">Address</th>
        <th>Required Df Size</th>
        <th class="no-sort">Mobile Number</th>
        <th>Payment Mode</th>
        <th>Receive Amount</th>
        <th class="no-sort">Others Company Df</th>
        <th>Exclusive Outlet</th>
        <th>Distance From Dist. Point</th>
        <th>Market Category</th>
        <th class="no-sort">Visibility Of DF</th>
        <th>Estemated Sales</th>
        <th>Stage</th>
        <th>Last Action By</th>
        <th>Status</th>
        @if (!$isExecutive)
            <th class="no-sort">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @php ($i=1)
      @foreach ($requisitions as $data)
      <tr>
        <td>{{$i}}</td>
        @if (!$isExecutive)
            <td>{{ $data->user->name or '' }}</td>
        @endif
        <td>{{ $data->creator->name or '' }}</td>
      	<td>{{$data->shop->outlet_name or ''}}</td>
        <td>{{$data->shop->address or ''}}</td>
        <td>DF-{{$data->size->name or ''}}</td>
        <td>{{$data->shop->mobile or ''}}</td>
        <td>{{config('myconfig.payment_modes')[$data->payment_modes]}}</td>
        <td>{{$data->receive_amount or '0'}}</td>
        <td>@if ($data->other_company_df=='no') NO @else {{ $data->other_company_df}}@endif</td>
        <td>{{config('myconfig.boolArr')[$data->exclusive_outlet]}}</td>
        <td>{{$data->distance_from_dist or ''}} km.</td>
        <td>{{config('myconfig.shop_category')[$data->shop->category]}}</td>
        <td>{{$data->visibility_of_df or ''}}</td>
        <td>{{$data->shop->estimated_sales or ''}}</td>
        <td>{{$data->stage or '0'}}</td>
        <td>
            @if ($data->action_by!=auth()->user()->id)
               {{ $data->stager->name or '' }}
            @else
                Self
            @endif
        </td>
        <td>{{ config('myconfig.application_status')[$data->status] }}</td>
        @if (!$isExecutive)
            <td>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Action
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        @if($payment_verify)
                           <li>{!! link_to_route('requisitions.payment_verify',mystudy_case('payment_verify') , [$data->id]) !!}</li>
                        @endif
                        @if($document_verify)
                          <li>{!! link_to_route('requisitions.document_verify',mystudy_case('document_verify') , [$data->id]) !!}</li>
                        @endif
                        @if ($x=$actionsArr->get(0))
                          @foreach (json_decode($x) as $val)
                            <li><a href="javascript:void(0)" class="text-capitalize" data-id="{{ $data->id }}" data-stage="{{ $data->stage }}" data-name="{{ $val }}" onclick="showModal(this)">{{ $val }}</a></li>
                          @endforeach
                        @endif
                    </ul>
                </div>
            </td>
        @endif
      </tr>
      @php ($i=$i+1)
    @endforeach
    </tbody>
</table>