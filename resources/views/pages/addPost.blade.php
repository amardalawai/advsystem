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
            {!! Form::open(array('url' => 'savePost' ,'method' => 'POST','class'=>'form-horizontal','name'=>'frmAddPost','id'=>'frmAddPost','enctype'=>'multipart/form-data')) !!}
            <div class="box-body">
				@if(Session::has('message'))
				<p class="alert alert-success">{{ Session::get('message') }}</p>
				@endif
			
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
                        {!! Form::text('title',Input::old('title',''), array("class"=>"form-control","id"=>"title", "placeholder"=>"Post title")) !!}
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
                        {!! Form::file('image', array("class"=>"form-control","id"=>"image","onchange"=>"loadFile(event)")) !!}
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
                        {!! Form::file('audio', array("class"=>"form-control","id"=>"audio")) !!}
                        {!! $errors->first('audio', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

                <div class="form-group {{ $errors->first('video')? 'has-error':'' }}" id='vidInput'>
                    <label for="video" class="col-sm-3 control-label">Video &nbsp;</label>
                    <div class="col-sm-9">
                        {!! Form::file('video', array("class"=>"form-control","id"=>"video")) !!}
                        {!! $errors->first('video', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>

				<div class="form-group {{ $errors->first('title')? 'has-error':'' }}">
                    <label for="expdate" class="col-sm-3 control-label">Expire Date <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
						<input type="date" name="expdate" id="expdate" class="form-control" value="{{ Input::old('expdate','') }}"/>
                        {!! $errors->first('expdate', '<span class="text-danger">:message</span>') !!}  
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="button" class="btn btn-primary pull-right" onclick="savePost()"><i class="fa fa-save"></i> Save changes</button>
            </div><!-- /.box-footer -->
            {!! Form::close() !!}
			
        </div><!-- /.box -->

    </div>
</div>
@stop

@section('include_js')
<script>
function savePost(){
	var title = $('#title').val();
	var expdate = $('#expdate').val();
	
	if(!title){
		show_warning("Please provide post title");
	}
	else if(!expdate){
		show_warning("Please provide post expire date");
	}
	else{
		document.frmAddPost.submit();
	}
	
}

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

$('#video').bind('change', function() {
	if(this.files[0].size>15000000){
		alert("Please choose video less then 15MB");
		document.frmAddPost.reset();
	}
});

$('#image').bind('change', function() {
	if(this.files[0].size>5000000){
		alert("Please choose image less then 5MB");
		document.frmAddPost.reset();
	}
});

$('#audio').bind('change', function() {
	if(this.files[0].size>10000000){
		alert("Please choose audio less then 10MB");
		document.frmAddPost.reset();
	}
});

var loadFile = function (event) {
	if(event.target.files[0].size<5000000){
		var image_url = URL.createObjectURL(event.target.files[0]);
		var strImage = image_url;
		if (strImage != '') {
			$.post(base_url + "/imageCrop", {strImage: strImage, strSquare: '0'}, function (result) {
				$('#commonTitle').html('Crop area of image');
				$('#commonBody').html(result);
			});
			$('#commonBox').modal('show');
		}
	}
};
</script>
@stop