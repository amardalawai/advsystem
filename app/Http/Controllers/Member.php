<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use App\User;
use Auth;
use Input;
use App\tbl_user_follow;
use App\tbl_country;
use App\tbl_state;
use App\tbl_activities;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\View;

class Member extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($strType = 'F', $userId = NULL) {

        if (!empty($userId)) {
            $data = array(
                'strType' => $strType,
                'follower' => User::find($userId)->followers,
                'following' => User::find($userId)->following,
                'userName' => User::find($userId)->userName()
            );
        } else {
            $data = array(
                'strType' => $strType,
                'follower' => Auth::user()->followers,
                'following' => Auth::user()->following,
                'userName' => Auth::user()->userName()
            );
        }


        return view('pages/follower', $data);
    }

    public function editUser() {
        $data = array(
            'user' => User::find(Auth::user()->id),
            'country' => tbl_country::lists('name', 'id'),
            'state' => tbl_state::lists('name', 'id'),
        );
        return view('pages/editUser', $data);
    }

    public function updateProfile(Request $request) {

        $input = Input::except('_token', 'image', 'x', 'y', 'w', 'h', 'old_image');
        foreach ($input as $key => $value) {
            $update = User::find(Auth::user()->id);
            $update->$key = $value;
            $update->save();
        }


        $image = Input::file('image');
        if (!empty($image)) {


            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('profiles/' . $filename);

            $image_x = $request->x;
            $image_y = $request->y;
            $image_width = $request->w;
            $image_height = $request->h;
            $old_image = $request->old_image;

            Image::make($image->getRealPath())->crop($image_width, $image_height, $image_x, $image_y)->resize(250, 250)->save($path);

            File::delete($old_image);

            $update = User::find(Auth::user()->id);
            $update->image = $filename;
            $update->save();
        }

        return Redirect::back();
    }

    public function viewImageCrop(Request $request) {
        $image = $request->strImage;
        $strSquare = $request->strSquare;
        if (empty($strSquare)) {
            $strSquare = '';
        }
        echo View::make('pages/viewImageCrop', ['image' => $image, 'strSquare' => $strSquare])->render();
    }

    function users() {
        $data = array(
            'users' => User::all()
        );
        return view('pages/manageUsers', $data);
    }

}
