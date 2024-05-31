{{ Form::model(request()->old(),array('route' => array('services.problemEntryEdit',$dfproblems->id),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="form-group{{ $errors->has('work_description') ? ' has-error' : '' }}">
        <label class="col-sm-2 control-label text-right">Work Description</label>
        <div class="col-sm-6">
            {{Form::textarea('work_description',null,array('rows'=>4,'class' => 'form-control max-length','maxlength'=>150))}}
            {!! $errors->first('work_description', '<p class="text-danger">:message</p>' ) !!}
         </div>
    </div>
    <div class="form-group{{ $errors->has('attain_date') ? ' has-error' : '' }}">
        {{Form::label('attain_date:',null,array('class' => 'control-label col-sm-2 require'))}}
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                {{Form::text('attain_date',null,array('autocomplete'=>'off','class' => 'form-control datepicker'))}}
            </div>
             {!! $errors->first('attain_date', '<p class="text-danger">:message</p>' ) !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('done_date') ? ' has-error' : '' }}">
        {{Form::label('done_date:',null,array('class' => 'control-label col-sm-2 require'))}}
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                {{Form::text('done_date',null,array('autocomplete'=>'off','class' => 'form-control datepicker'))}}
            </div>
             {!! $errors->first('done_date', '<p class="text-danger">:message</p>' ) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-2">
            <button type="submit" name="submit" value="complete" class="btn btn-primary">
                Complete
            </button>
        </div>
    </div>
{{ Form::close() }}