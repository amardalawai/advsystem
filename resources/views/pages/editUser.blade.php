@extends('pages.layout.master')
@section('title', 'Edit '.$user->name. '\'s profile')
@section('title-info', 'Please fill in valid information')
@section('content')
@parent
<div class="row">
    <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Profile</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => 'updateProfile' ,'method' => 'POST','class'=>'form-horizontal','name'=>'FrmuserEdit','id'=>'FrmuserEdit','enctype'=>'multipart/form-data')) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->first('name')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Avatar &nbsp;</label>
                    <div class="col-sm-2">
                        <img src="{{ url($user->userImage()) }}" class="img-thumbnail" alt="User Image">
                    </div>
                    <div class="col-sm-7">
                        {!! Form::file('image', array("class"=>"form-control","onchange"=>"loadFile(event)")) !!}
                        {!! $errors->first('image', '<span class="text-danger">:message</span>') !!}  
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="hidden" id="old_image" name="old_image" value="profiles/{{ $user->image }}"/>
                    </div>
                </div>
                <div class="form-group {{ $errors->first('name')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        {!! Form::text('name',Input::old('name',$user->name), array("class"=>"form-control", "placeholder"=>"User name")) !!}
                        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>
                <div class="form-group {{ $errors->first('email')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Email address <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        {!! Form::text('email',Input::old('email',$user->email), array("class"=>"form-control", "placeholder"=>"Email address")) !!}
                        {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('gender')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Gender <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        {!! Form::radio('gender', 'male', (Input::old('gender',$user->gender) =='male')?'true':''); !!} Male
                        {!! Form::radio('gender', 'female', (Input::old('gender',$user->gender)!='male')?'true':''); !!} Female
                        {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>
                <div class="form-group {{ $errors->first('contact')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Contact No. &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::text('contact',Input::old('contact',$user->contact), array("class"=>"form-control", "placeholder"=>"Contact number")) !!}
                        {!! $errors->first('contact', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>
                <div class="form-group {{ $errors->first('country_id')? 'has-error':'' }}">
                    <label for="country_id" class="col-sm-3 control-label">Country &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::select('country_id', $country, $user->country_id ,array("class"=>"form-control")); !!}
                        {!! $errors->first('country_id', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('state_id')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Type &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::select('state_id', $state, $user->state_id ,array("class"=>"form-control")); !!}
                        {!! $errors->first('state_id', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('city')? 'has-error':'' }}">
                    <label for="city" class="col-sm-3 control-label">Current living city &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::text('city',Input::old('contact',$user->city), array("class"=>"form-control", "placeholder"=>"Place you live")) !!}
                        {!! $errors->first('city', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('about')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">About &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::textarea('about',Input::old('about',$user->about), array("class"=>"form-control", "placeholder"=>"Brief information about you")) !!}
                        {!! $errors->first('about', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save changes</button>
            </div><!-- /.box-footer -->
            {!! Form::close() !!}
        </div><!-- /.box -->

    </div>
</div>
@stop

@section('include_js')
<script type="text/javascript" src="{{ URL::asset('plugins/custom/userEdit.js') }}"></script>   
@stop