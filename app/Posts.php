<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use File;


class Posts extends Model {

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'deleted_at'];

    public function postTitle() {
        return ucfirst($this->name);
    }
	
	public function expired() {
		if(time()<$this->expdate){
			return FALSE;
		}
		else{
			return TRUE;
		}
    }

    public function postImage() {
        $image = $this->image;
        if (File::exists('post_images/' . $image) && !empty($image)) {
            $url = url('post_images/' . $this->image);
        } else {
            $url = url('img/default.png');
        }
        return $url;
    }
	
	public function audio() {
        $audio = $this->audio;
        if (File::exists('post_audios/' . $audio) && !empty($audio)) {
            $url = url('post_audios/' . $this->audio);
        } else {
            $url = '';
        }
        return $url;
    }
	
	public function video() {
        $video = $this->video;
        if (File::exists('post_videos/' . $video) && !empty($video)) {
            $url = url('post_videos/' . $this->video);
        } else {
            $url = '';
        }
        return $url;
    }
	

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
	
	public function deptName() {
        return $this->hasOne('App\Departments', 'id', 'dept');
    }
}
