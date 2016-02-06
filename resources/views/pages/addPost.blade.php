@extends('pages.layout.master')
@section('title', 'Add post')
@section('title-info', 'Please fill in post information')
@section('content')
@parent
<div class="row">
    <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Post</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => 'savePost' ,'method' => 'POST','class'=>'form-horizontal','name'=>'FrmuserEdit','id'=>'FrmuserEdit','enctype'=>'multipart/form-data')) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->first('dept')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Department/Category &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::select('dept', $arrDept, '' ,array("class"=>"form-control")); !!}
                        {!! $errors->first('dept', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>
                
                <div class="form-group {{ $errors->first('title')? 'has-error':'' }}">
                    <label for="title" class="col-sm-3 control-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        {!! Form::text('title',Input::old('title',''), array("class"=>"form-control", "placeholder"=>"Post title")) !!}
                        {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('state_id')? 'has-error':'' }}">
                    <label for="name" class="col-sm-3 control-label">Advertise type &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::select('type', $arrType, '' ,array("class"=>"form-control","onchange"=>"setType(this.value)")); !!}
                        {!! $errors->first('type', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>
                
                

                <div class="form-group {{ $errors->first('description')? 'has-error':'' }}" id='desInput'>
                    <label for="name" class="col-sm-3 control-label">Description &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::textarea('description',Input::old('description',''), array("class"=>"form-control", "placeholder"=>"Brief information about post")) !!}
                        {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('name')? 'has-error':'' }}" id='imgInput'>
                    <label for="name" class="col-sm-3 control-label">Image &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::file('image', array("class"=>"form-control","onchange"=>"loadFile(event)")) !!}
                        {!! $errors->first('image', '<span class="text-danger">:message</span>') !!}  
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="hidden" id="old_image" name="old_image" value="profiles/"/>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('audio')? 'has-error':'' }}" id='audInput'>
                    <label for="name" class="col-sm-3 control-label">Audio &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::file('audio', array("class"=>"form-control")) !!}
                        {!! $errors->first('audio', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('video')? 'has-error':'' }}" id='vidInput'>
                    <label for="video" class="col-sm-3 control-label">Video &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::file('video', array("class"=>"form-control")) !!}
                        {!! $errors->first('video', '<span class="text-danger">:message</span>') !!}  
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

<script>
function setType(val){
    if(val==0){
        $('#desInput').show();
        $('#imgInput').show();
        $('#audInput').hide();
        $('#vidInput').hide();
    }
    else if(val==1){
        $('#imgInput').show();
        $('#desInput').hide();
        $('#audInput').hide();
        $('#vidInput').hide();
    }
    else if(val==2){
        $('#imgInput').hide();
        $('#desInput').hide();
        $('#audInput').show();
        $('#vidInput').hide();
    }
    else if(val==3){
        $('#imgInput').hide();
        $('#desInput').hide();
        $('#audInput').hide();
        $('#vidInput').show();
    }
}

$(document).ready(function(){
    setType(0);
});
</script>
@stop