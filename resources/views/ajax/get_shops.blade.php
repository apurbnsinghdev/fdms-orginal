@if($isDistributor)
	{{Form::select('distributor_id',[''=>'Please Select Distributor']+$shops->toArray(),request()->route()->parameters?:null,array('id'=>'shop_id','class' => 'form-control select2','data-placeholder'=>'Please Select Distributor'))}}
@else
	{{Form::select('shop_id',[''=>'Please Select Shop']+$shops->toArray(),request()->route()->parameters?:null,array('id'=>'shop_id','class' => 'form-control select2','data-placeholder'=>'Please Select Shop','onchange'=>'getCurrentDfs(this.value);getReturnDFSizes(this.value);'))}}
@endif
