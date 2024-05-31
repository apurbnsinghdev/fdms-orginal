<form id="problemEntry" style="position: relative;overflow: hidden;" action="{{ route('services.problemEntry') }}" method="post">
  {{ csrf_field() }}
  {{Form::hidden('df_code','personal')}}
  {{Form::hidden('sender',auth()->user()->name.'('.auth()->user()->designation->short_name.'),'.auth()->user()->mobile)}} {{-- use for sms --}}
  <div class="row">
    @if ($depot_id)
      {{Form::hidden('depot_id',$depot_id)}}
      <div class="col-md-12 form-group">
          {{Form::label('Select Distributor',null,array('class' => 'control-label'))}}
          {{Form::select('distributor_id',$distributors,null,array('class' => 'form-control'))}}
      </div>
    @else
      <div class="col-md-12 form-group">
          {{Form::label('Select Depot',null,array('class' => 'control-label'))}}
          {{Form::select('depot_id',$depots,null,array('id'=>'depot_id','class' => 'form-control','onchange'=>'getDepotDistributor(this.value)'))}}
      </div>
      <div class="col-md-12 form-group">
          {{Form::label('Select Distributor',null,array('class' => 'control-label'))}}
          <span id="shop-list">{{Form::select('distributor_id',$distributors,null,array('id'=>'shop_id','class' => 'form-control'))}}</span>
      </div>
    @endif
    <div class="col-md-12 form-group">
          {{Form::label('df_size',null,array('class' => 'control-label'))}}
          {{Form::number('df_size',null,array('required','class' => 'form-control'))}}
    </div>

    <div class="col-md-12 form-group">
          {{Form::label('outlet_name',null,array('class' => 'control-label'))}}
          {{Form::text('outlet_name',null,array('required','class' => 'form-control'))}}
    </div>
     <div class="col-md-12 form-group">
          {{Form::label('proprietor_name',null,array('class' => 'control-label'))}}
          {{Form::text('proprietor_name',null,array('required','class' => 'form-control'))}}
    </div>
     <div class="col-md-12 form-group">
          {{Form::label('mobile',null,array('class' => 'control-label'))}}
          {{Form::text('mobile',null,array('required','class' => 'form-control max-length','maxlength'=>11))}}
    </div>
    <div class="col-md-12 form-group">
          {{Form::label('address',null,array('class' => 'control-label'))}}
          {{Form::textarea('address',null,array('required','rows'=>4,'class' => 'form-control max-length','maxlength'=>255))}}
    </div>
    <div class="col-md-12 form-group">
          {{Form::label('Select Problem Type',null,array('class' => 'control-label'))}}
          {{Form::select('problem_type_ids[]',$problemTypes,null,array('class' => 'form-control select2','multiple'=>true))}}
    </div>
     <div class="col-md-12 form-group">
          {{Form::label('comments',null,array('class' => 'control-label'))}}
          {{Form::textarea('comments',null,array('class' => 'form-control max-length','maxlength'=>250,'rows'=>4))}}
    </div>
    <div class="col-md-4 form-group">
        <button type="submit" class="btn btn-success" id="confirm-btn">Submit Entry</button>
    </div>
  </div>
</form>
<script>
  $('.max-length').maxlength({
            alwaysShow: true,
            placement: 'top-right-inside'
        });
</script>