@if($distributors->count())
	@if(!$notForm)
    	{{ Form::model(request()->old(),array('route' => array('shops.destroy',$id),'enctype'=>'multipart/form-data')) }}
    	<input name="_method" type="hidden" value="DELETE">
    	<div class="col-md-12 form-group">
              {{Form::label('Select Distributor for alter this',null,array('class' => 'control-label'))}}
              {{Form::select('distributor_id',$distributors->toArray(),null,array('class' => 'form-control'))}}
        </div>
       
        <div class="form-group text-right">
        	<button type="submit" class="btn btn-success" id="confirm-btn">Confirm</button>
        </div>
    	 {{ Form::close() }}
	 @else
	 	<div class="col-md-12 form-group">
          {{Form::label('Select Distributor for alter this',null,array('class' => 'control-label'))}}
          {{Form::select('distributor_id',$distributors->toArray(),null,array('class' => 'form-control'))}}
    	</div>
        <div class="form-group text-right">
        	<button type="submit" class="btn btn-success" id="confirm-btn">Submit</button>
        </div>
	 @endif
@else
 <p>You have to create another distributor under this depot. and then delete this.    
@endif
