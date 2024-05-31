{{ Form::model($dfproblems,array('route' => array('services.problemEntryEdit',$dfproblems->id),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="form-group{{ $errors->has('item_id') ? ' has-error' : '' }}">
        {{Form::label('Assign support DF:',null,array('class' => 'control-label col-sm-2 require'))}}
        <div class="col-sm-6 col-xs-8">
            {{Form::select('item_id',[''=>'Please Select..']+$supportDfList->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select..'))}}
            {!! $errors->first('item_id', '<p class="text-danger">:message</p>' ) !!}
        </div>

        <div class="col-sm-4 col-xs-4">
            <button type="submit" class="btn btn-o btn-danger" name="submit" value="support_df_gatepass">
               Gatepass
            </button>
        </div>
    </div>
{{ Form::close() }}