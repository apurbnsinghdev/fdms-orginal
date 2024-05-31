<table id="basic-table" class="data-table table table-striped table-hover action-table" cellspacing="0" width="100%">
    <thead>
      <tr>
      	@if ($param == 'new' && $approve_all)
      	 <th class="no-sort">
      	 	<div class="checkbox-custom checkbox-success th-custom-check">
          		<input type="checkbox" name="select_all" value="1" id="datatable-select-all">
          		<label for="datatable-select-all" class="check"></label>
      		</div>

         </th>
      	@endif
        <th class="no-sort">Type</th>
        {{-- <th class="no-sort">Reference</th> --}}
        @if (!$isExecutive)
             <th class="no-sort">Sender</th>
        @endif
        <th class="no-sort">Creator</th>
        <th>Depot</th>
        <th>Distributor</th>
        <th class="no-sort">Outlet Name</th>
        <th>Req. Df Size</th>
        <th class="no-sort">Mobile No.</th>
        <th>Payment Mode</th>
        @if ($param !='draft')
            <th class="no-sort">Last Action By</th>
            <th class="no-sort">Verification</th>
        @endif
        <th class="no-sort text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($requisitions as $data)
      <tr @if($data->physical_visits->count() != 3) style="background-color:#D3D3D3" @endif>
      	@if ($param == 'new' && $approve_all)
      	<td>
      		<div class="checkbox-custom checkbox-success">
          		<input type="checkbox" id="checkboxCustom{{$loop->iteration}}" name="ids[]" value="{{$data->id}}">
          		<label for="checkboxCustom{{$loop->iteration}}" class="check"></label>
      		</div>
      	</td>
      	@endif
        <td @if ($data->type=='replace') class="text-danger" @endif>
            {{ mystudy_case($data->type) }}
            @if ($data->df_return_id)
            <a class="text-danger" style="cursor:pointer; text-decoration: underline;" title="View Shop" onclick="shopCompareModal('{{ $data->df_return_id}}')"><span class="text-danger">(Transfer)</span></a>

            @endif
        </td>
        {{-- <td>{{ $data->reference_id or '' }}</td> --}}
        @if (!$isExecutive)
            <td>{{ $data->user->name or '' }}</td>
        @endif
        <td>{{ $data->creator->name or '' }}</td>
        <td>{{ $data->depot->name or '' }}</td>
        <td>{!! $data->distributor->outlet_name or '' !!}</td>
        <td><a style="cursor: pointer;" onclick="getShopDetails('{{ $data->shop->id or '0' }}')">{!! $data->shop->outlet_name or '' !!}</a></td>
        <td>DF-{{$data->size->name or ''}}</td>
        <td>{{$data->shop->mobile or ''}}</td>
        <td>
            {{config('myconfig.payment_modes')[$data->payment_modes]}}
            @if ($data->payment_modes != 'without_rent')
                ({{ $data->payment_methods }})
            @endif
        </td>
        @if ($param !='draft')
        <td>
            @if ($data->action_by!=$authUserId)
               {{ $data->stager->name or '' }}
            @else
                Self
            @endif
        </td>
        <td>
            @if ($data->doc_verified =='yes') <i class="fa fa-check text-success"></i>Doc @else <i class="fa fa-times text-danger"></i>Doc @endif
            @if ($data->payment_modes != 'without_rent')
                <br>
                @if ($data->payment_verified =='yes') <i class="fa fa-check text-success"></i>Payment @else <i class="fa fa-times text-danger"></i>Payment @endif
            @endif
            <br>
             @if ($data->validate_by) <i class="fa fa-check text-success"></i>Validate @else <i class="fa fa-times text-danger"></i>Validate @endif
            <br>
            @if ($data->item_id) <i class="fa fa-check text-success"></i>DF @else <i class="fa fa-times text-danger"></i>DF @endif
        </td>
        @endif
        <td class="text-center action-box">
          @include('requisitions.'.$param.'_list')
        </td>
      </tr>
    @endforeach
    </tbody>
</table>