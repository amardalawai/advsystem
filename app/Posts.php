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

    public function postImage() {
        $image = $this->image;
        if (File::exists('post_images/' . $image) && !empty($image)) {
            $url = url('post_images/' . $this->image);
        } else {
            $url = url('img/default.png');
        }
        return $url;
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
}
