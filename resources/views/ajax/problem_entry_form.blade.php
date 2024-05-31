<form id="problemEntry" style="position: relative;overflow: hidden;" action="{{ route('services.problemEntry') }}" method="post">
  {{ csrf_field() }}

@if ($error)
  <div class="row">
     <div class="col-md-12 mt-md form-group">
          {{Form::text('serail',$serial,array('placeholder'=>'Input your transaction ID','class' => 'form-control','id'=>'serial_no'))}}
          <p class="text-danger">Item does not match by this serial. Please try another.</p>
    </div>
    <div class="col-md-4 mt-md form-group">
        <button type="button" class="btn btn-success" id="confirm-btn" onclick="showModal(document.getElementById('serial_no').value)">Search By Serial</button>
    </div>
  </div>
@else
  {{Form::hidden('region_id',$item->shop->region_id)}} {{-- shop region id --}}
  {{Form::hidden('depot_id',$item->depot_id)}} {{-- shop depot id --}}

  @if ($item->shop->is_distributor)
     {{Form::hidden('distributor_id',$item->shop->id)}}
  @else
     {{Form::hidden('distributor_id',$item->shop->distributor_id)}}
  @endif
  {{Form::hidden('sender',auth()->user()->name.'('.auth()->user()->designation->short_name.'),'.auth()->user()->mobile)}} {{-- use for sms --}}
  {{Form::hidden('shop_id',$item->shop->id)}}
  {{Form::hidden('outlet_name',$item->shop->outlet_name)}}
  {{Form::hidden('proprietor_name',$item->shop->proprietor_name)}}
  {{Form::hidden('mobile',$item->shop->mobile)}}
  {{Form::hidden('address',$item->shop->address)}}

  {{Form::hidden('df_code',$item->serial_no)}}
  {{Form::hidden('df_size',$item->size->name)}}
  <table class="table table-hover table-striped">
     <tr>
      <th>DF Code</th>
      <td>{{ $item->serial_no }}</td>
    </tr>
     <tr>
      <th>Depot</th>
      <td>{{ $item->depot->name or '' }}</td>
    </tr>
    <tr>
      <th>Outlet</th>
      <td>{{ $item->shop->outlet_name or '' }}</td>
    </tr>
    <tr>
      <th>Proprietor</th>
      <td>{{ $item->shop->proprietor_name or '' }}</td>
    </tr>
    <tr>
      <th>Mobile</th>
      <td>{{ $item->shop->mobile or '' }}</td>
    </tr>
    <tr>
      <th>Address</th>
      <td>{{ $item->shop->address or '' }}</td>
    </tr>
    <tr>
      <th>DF Size</th>
      <td>DF-{{ $item->size->name or '' }}</td>
    </tr>
  </table>
  <div class="row">
    <div class="col-md-12 form-group">
          {{Form::label('Select Problem Type',null,array('class' => 'control-label'))}}
          {{Form::select('problem_type_ids[]',$problemTypes,null,array('class' => 'form-control select2','multiple'=>true))}}
    </div>
     <div class="col-md-12 form-group">
          {{Form::label('Comments',null,array('class' => 'control-label'))}}
          {{Form::textarea('comments',null,array('class' => 'form-control','rows'=>4))}}
    </div>
    <div class="col-md-4 form-group">
        <button type="submit" class="btn btn-success" id="confirm-btn">Submit Entry</button>
    </div>
  </div>
@endif

</form>