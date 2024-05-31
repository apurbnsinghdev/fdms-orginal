<div class="panel">
  <div class="panel-content">
    {{ Form::model(request()->old(),array('route' => array('inventories.generateDFCode'))) }}
      <div class="row">
        <div class="col-md-2 form-group">
            {{Form::label('brand',null,array('class' => 'control-label require'))}}
            {{Form::select('brand',$brands,null,array('class' => 'form-control'))}}
            {!! $errors->first('brand', '<p class="text-danger">:message</p>' ) !!}
        </div>
         <div class="col-md-2 form-group">
            {{Form::label('size',null,array('class' => 'control-label require'))}}
            {{Form::select('size',$sizes,null,array('class' => 'form-control'))}}
            {!! $errors->first('size', '<p class="text-danger">:message</p>' ) !!}
        </div>
         <div class="col-md-2 form-group">
            @php
              $firstYear = (int)date('Y')-1;
              $lastYear = $firstYear + 5;
            @endphp
            {{Form::label('year',null,array('class' => 'control-label require'))}}
            {{Form::selectYear('year',$firstYear, $lastYear,null,array('class' => 'form-control'))}}
            {!! $errors->first('year', '<p class="text-danger">:message</p>' ) !!}
        </div>
         <div class="col-md-2 form-group">
            {{Form::label('qty',null,array('class' => 'control-label require'))}}
            {{Form::number('qty',null,array('class' => 'form-control','min'=>1))}}
            {!! $errors->first('qty', '<p class="text-danger">:message</p>' ) !!}
        </div>
        @if (!$max)
          <div class="col-md-2 form-group">
              {{Form::label('initial_qty',null,array('class' => 'control-label require'))}}
              {{Form::number('initial_qty',null,array('class' => 'form-control','min'=>1))}}
              {!! $errors->first('initial_qty', '<p class="text-danger">:message</p>' ) !!}
          </div>
        @endif
        <div class="col-md-2 form-group">
            {{Form::label('',null,array('class' => 'control-label hidden-xs hidden-sm'))}}
           <button type="submit" class="btn btn-primary form-control">
                  Generate
            </button>
        </div>
      </div>
    {{ Form::close() }}
  </div>
</div>


