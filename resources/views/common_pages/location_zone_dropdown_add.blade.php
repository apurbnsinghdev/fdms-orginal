<div class="row">
    <div class="col-md-6">
        <h5 class="mb-lg"><b>Select Location </b></h5>
        <div class="form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
            {{Form::label('Division:',null,array('class' => 'control-label col-sm-4 require'))}}
            <div class="col-md-8">
                {{Form::select('division_id',[''=>'Please Select Division']+$divisions->toArray(),null,array('class' => 'form-control','v-model'=>'division_id', '@change'=>'getDistricts'))}}
                {!! $errors->first('division_id', '<p class="text-danger">:message</p>' ) !!}
            </div>
        </div>
        <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
            {{Form::label('District:',null,array('class' => 'control-label col-sm-4 require'))}}
            <div class="col-md-8">
                <select name="district_id" class="form-control col-sm-2" v-model="district_id" @change="getThanas">
                    <option value="">Please Select District</option>
                    <option v-for="(name,id) in districts" v-bind:value="id" v-text="name"></option>
                </select>
                {!! $errors->first('district_id', '<p class="text-danger">:message</p>' ) !!}
            </div>
        </div>
        <div class="form-group{{ $errors->has('thana_id') ? ' has-error' : '' }}">
            {{Form::label('Thana:',null,array('class' => 'control-label col-sm-4 require'))}}
            <div class="col-md-8">
                <select name="thana_id" v-model="thana_id" class="form-control col-sm-2">
                    <option value="">Please Select Thana</option>
                    <option v-for="(name,id) in thanas" v-bind:value="id" v-text="name"></option>
                </select>
                {!! $errors->first('thana_id', '<p class="text-danger">:message</p>' ) !!}
            </div>
        </div>
         <hr class="hidden-lg hidden-md">
    </div>
    <div class="col-md-6">
         <h5 class="mb-lg"><b>Select Zone</b></h5>
         @if ($regions && !empty($regionId))
            {{ Form::hidden('region_id',$regionId) }}

            <div class="form-group">
                {{Form::label('Region:',null,array('class' => 'control-label col-sm-2'))}}
                <div class="col-md-8 mt-xs">
                    <strong>{{ $regions->name }}</strong>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('Area:',null,array('class' => 'control-label col-sm-2'))}}
                <div class="col-md-8">
                    {{Form::select('area_id',[''=>'Please Select Area']+$areas->toArray(),null,array('class' => 'form-control','v-model'=>'area_id' ))}}
                </div>
            </div>
         @else
        <div class="form-group{{ $errors->has('region_id') ? ' has-error' : '' }}">
            {{Form::label('Region:',null,array('class' => 'control-label col-sm-2 require'))}}
            <div class="col-md-8">
                {{Form::select('region_id',[''=>'Please Select Region']+$regions->toArray(),null,array('class' => 'form-control','v-model'=>'region_id', '@change'=>'getAreas'))}}
                {!! $errors->first('region_id', '<p class="text-danger">:message</p>' ) !!}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('Area:',null,array('class' => 'control-label col-sm-2'))}}
            <div class="col-md-8">
                <select name="area_id" v-model="area_id" class="form-control col-sm-2">
                    <option value="">Please Select Area</option>
                    <option v-for="(name,id) in areas" v-bind:value="id" v-text="name"></option>
                </select>
            </div>
        </div>
        @endif
    </div>
</div>
