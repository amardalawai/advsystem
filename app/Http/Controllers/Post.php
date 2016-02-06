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

            Image::make($image->getRealPath())->crop($image_width, $image_height, $image_x, $image_y)->resize(250, 250)->save($path);

            File::delete($old_image);

            $update = Posts::find($inserted_id);
            $update->image = $filename;
            $update->save();
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

        return Redirect::back();
    }

}
