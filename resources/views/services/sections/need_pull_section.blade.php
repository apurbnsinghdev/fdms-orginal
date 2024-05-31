{{ Form::model($dfproblems,array('route' => array('services.problemEntryEdit',$dfproblems->id),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
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
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-2">
            {!! Html::decode(link_to_route('services.generateClaimCopy','<i class="fa fa-print" aria-hidden="true"></i> Print Claim Copy' , [$dfproblems->id],['class'=>'btn btn-o btn-danger'])) !!}
        </div>
    </div>

    @if($dfproblems->df_code != 'personal')
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-6">
                <div class="checkbox-custom checkbox-success">
                    {{Form::checkbox('support',1,null,array('id'=>'checkboxCustom2','v-model'=>'cvb1'))}}
                    <label for="checkboxCustom2" class="check">Need Support DF</label>
                </div>
            </div>
        </div>
        <div class="form-group{{ $errors->has('item_id') ? ' has-error' : '' }}" v-if="$root.cvb1">
            {{Form::label('Assign support DF:',null,array('class' => 'control-label col-sm-2 col-xs-12 require'))}}
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
    @endif

    <div class="form-group">
        <div class="col-md-6 col-md-offset-2">
            <button type="submit" name="submit" value="processing" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
{{ Form::close() }}