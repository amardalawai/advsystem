<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use File;


class Departments extends Model {

    protected $table = 'Departments';
    protected $primaryKey = 'id';

    public function Post() {
        return $this->hasMany('App\Posts', 'dept', 'id');
    }
	
}
