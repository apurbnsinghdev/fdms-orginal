{{ Form::model($dfproblems,array('route' => array('services.problemEntryEdit',$dfproblems->id),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
    <div class="form-group{{ $errors->has('work_description') ? ' has-error' : '' }}">
        <label class="col-sm-2 control-label text-right">Work Description</label>
        <div class="col-sm-6">
            {{Form::textarea('work_description',null,array('rows'=>4,'class' => 'form-control max-length','maxlength'=>150))}}
            {!! $errors->first('work_description', '<p class="text-danger">:message</p>' ) !!}
         </div>
    </div>

    <div class="form-group{{ $errors->has('office_copy') ? ' has-error' : '' }}">
        {{Form::label('upload_office_copy',null,array('class' => 'control-label col-sm-2 col-xs-12'))}}
        {{Form::file('office_copy',['class'=>'col-sm-3 col-xs-6 pt-sm'])}}
        <div class="col-sm-4 col-xs-6">
            <button type="submit" class="btn btn-o btn-warning" name="submit" value="office_copy">
               Update File
            </button>
        </div>
        <div class="col-sm-3 col-xs-12 preview-div">
            @if(is_file(public_path('storage/images/problems/office_copy-'.$dfproblems->id.'.jpg')))
                {{ Form::hidden('old_office_copy',1) }}
                {{ HTML::image('storage/images/problems/office_copy-'.$dfproblems->id.'.jpg?='.time(),null,array('width'=>'70')) }}
            @else
            	{{ Form::hidden('old_office_copy',0) }}
            @endif
        </div>
        {!! $errors->first('office_copy', '<p class="text-danger">:message</p>' ) !!}
    </div>

    <div class="form-group{{ $errors->has('done_date') ? ' has-error' : '' }}">
        {{Form::label('done_date:',null,array('class' => 'control-label col-sm-2 col-xs-12 require'))}}
        <div class="col-sm-6 col-xs-8">
            <div class="input-group">
                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                {{Form::text('done_date',null,array('autocomplete'=>'off','class' => 'form-control datepicker'))}}
            </div>
             {!! $errors->first('done_date', '<p class="text-danger">:message</p>' ) !!}
        </div>
         <div class="col-sm-4 col-xs-4">
            <button type="submit" class="btn btn-o btn-danger" name="submit" value="pull_df_gatepass">
               Gatepass
            </button>
        </div>
    </div>

    <div class="form-group{{ $errors->has('claim_copy') ? ' has-error' : '' }}">
        {{Form::label('upload_claim_copy',null,array('class' => 'control-label col-sm-2 col-xs-12'))}}
        {{Form::file('claim_copy',['class'=>'col-sm-3 col-xs-6 pt-sm'])}}
        <div class="col-sm-4 col-xs-6">
            <button type="submit" class="btn btn-o btn-warning" name="submit" value="claim_copy">
               Update File
            </button>
        </div>
        <div class="col-sm-3 col-xs-12 preview-div">
            @if(is_file(public_path('storage/images/problems/claim_copy-'.$dfproblems->id.'.jpg')))
                {{ Form::hidden('old_claim_copy',1) }}
                {{ HTML::image('storage/images/problems/claim_copy-'.$dfproblems->id.'.jpg?='.time(),null,array('width'=>'70')) }}
            @else
            	{{ Form::hidden('old_claim_copy',0) }}
            @endif
        </div>
        {!! $errors->first('claim_copy', '<p class="text-danger">:message</p>' ) !!}
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-2">
            <button type="submit" name="submit" value="complete" class="btn btn-primary">
                Complete
            </button>
            @if($dfproblems->df_code !='personal')
                <button type="button" data-toggle="modal" data-target="#common-modal" class="btn btn-wide btn-info">Apply For Damage</button>
            @endif

        </div>
    </div>
{{ Form::close() }}
<!-- Modal for problem entry start-->
@component('common_pages.common_modal_component',['modalTitle'=>'Apply For Damage Aplication'])
    {{ Form::open(array('route' => array('services.applyForDamage'),'class'=>'form-horizontal')) }}
    	{{Form::hidden('df_problem_id',$dfproblems->id)}}
    	{{Form::hidden('shop_id',$dfproblems->shop_id)}}
    	{{Form::hidden('df_code',$dfproblems->df_code)}}
    	{{Form::hidden('depot_id',$dfproblems->depot_id)}}
        <div class="form-group{{ $errors->has('damage_type_id') ? ' has-error' : '' }}">
            {{Form::label('damage_type',null,array('class' => 'control-label col-sm-3 require'))}}
            <div class="col-md-9">
                {{Form::select('damage_type_id',$damageTypes,null,array('class' => 'form-control'))}}
                {!! $errors->first('damage_type_id', '<p class="text-danger">:message</p>' ) !!}
            </div>
        </div>

        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
            {{Form::label('remarks',null,array('class' => 'control-label col-sm-3 require'))}}
            <div class="col-md-9">
                {{Form::textarea('remarks',null,array('rows'=>3,'class' => 'form-control'))}}
                {!! $errors->first('remarks', '<p class="text-danger">:message</p>' ) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary">
                       Apply Now
                </button>
            </div>
        </div>
    {{ Form::close() }}
@endcomponent


