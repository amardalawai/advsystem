<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\tbl_activities;
use App\Departments;
use App\Posts;

class Home extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function homeOld() {
        $departments = Departments::all();
        return view('home')->with('departments', $departments);
    }

    public function home() {
        $posts = Posts::all();

        $allTxt = array();
        $i = 0;
        foreach ($posts as $post) {
            if ($post->active == 1 && !$post->expired() && $post->type == 0 && empty($post->image)) {
                $allTxt[$i] = array(
                    'title' => $post->title,
                    'description' => $post->description,
                    'uname' => $post->user->userName(),
                    'dateon' => date('d-M-y h:i a', strtotime($post->created_at)),
                    'deptname' => $post->deptName->name,
                );
                $i++;
            }
        }
        return view('newUI')->with('posts', $posts)->with('allTxt', $allTxt);
    }

    public function index($userId = NULL) {
        if (!empty($userId) && $userId != Auth::user()->id) {
            $user = User::find($userId);
        } else {
            $user = Auth::user();
        }

        $following = $user->following;
        $arrFollowing = array();
        $arrFollowing[] = $user->id;
        foreach ($following as $follow) {
            $arrFollowing[] = $follow->userInfo->id;
        }
        $strFollowing = implode(',', $arrFollowing);

        $activities = tbl_activities::whereRaw('( action_by IN (' . $strFollowing . ') or user_id IN (' . $strFollowing . ')) and active=1')->orderBy('created_at', 'desc')->simplePaginate(10);


        if (!empty($activities)) {
            $activities->setPath('');
        }

        return view('pages.home', array('user' => $user, 'activities' => $activities));
    }

    public function dashboard() {
        return view('pages.dashboard', array('user' => ''));
    }

}
