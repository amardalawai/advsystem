<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
use App\Posts;
use App\Departments;
use Input;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class Post extends Controller {

    public function index() {
        
    }

    public function addPost() {
        $arrDept = array();
        $arrType = array('Text', 'Image', 'Audio', 'Video');
        $post = array(
            'title' => ''
        );
        $arrDept = Departments::lists('name', 'id');
        return view('pages.addPost', array('arrDept' => $arrDept, 'arrType' => $arrType, 'post' => $post, 'arrDept' => $arrDept));
    }

    public function savePost(Request $request) {
		
        $input = Input::except('_token', 'image', 'x', 'y', 'w', 'h', 'old_image');
        $update = new Posts;
        foreach ($input as $key => $value) {
            $update->$key = $value;
        }
		$update->user_id = Auth::user()->id;
        $update->save();
        $inserted_id = $update->id;
        
        $image = Input::file('image');
		
        if (!empty($image)) {
			
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('post_images/' . $filename);

            $image_x = $request->x;
            $image_y = $request->y;
            $image_width = $request->w;
            $image_height = $request->h;
            $old_image = $request->old_image;

            Image::make($image->getRealPath())->crop($image_width, $image_height, $image_x, $image_y)->resize(640, 360)->save($path);

            File::delete($old_image);

            $imgUpdate = Posts::find($inserted_id);
            $imgUpdate->image = $filename;
            $imgUpdate->save();
        }


        $audio = Input::file('audio');
        if (!empty($audio)) {

            $filename = time() . '.' . $audio->getClientOriginalExtension();
            $path = public_path('post_audios/');

            $request->file('audio')->move($path, $filename);

            $update = Posts::find($inserted_id);
            $update->audio = $filename;
            $update->save();
        }
        
        $video = Input::file('video');
        if (!empty($video)) {

            $filename = time() . '.' . $video->getClientOriginalExtension();
            $path = public_path('post_videos/');

            $request->file('video')->move($path, $filename);

            $update = Posts::find($inserted_id);
            $update->video = $filename;
            $update->save();
        }

        return Redirect::back()->with('message', 'Posted Successfully');
    }
	
	public function managePost(){
		$user_id =Auth::user()->id;
		if($user_id==1){
			$arrPost = Posts::all();
		}
		else{
			$arrPost = Posts::where('user_id','=',$user_id)->get();
		}
		return view('pages.managePost', array('arrPost' => $arrPost));
	}

	public function processSetStatus(Request $request) {
		$intPostId = $request->intPostId;
		$intStatusId = $request->intStatusId;
		$Post = Posts::find($intPostId);
		$Post->active = $intStatusId;
		echo $Post->save();
	}
	
	public function processDeletePost(Request $request){
		$intPostId = $request->intPostId;
		$Post = Posts::find($intPostId);
		echo $Post->delete();
	}
}
