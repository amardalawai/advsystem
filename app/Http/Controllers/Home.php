<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\tbl_activities;
use App\Departments;

class Home extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home() {
        $departments = Departments::all();
        return view('home')->with('departments', $departments);
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
