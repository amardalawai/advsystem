<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_state extends Model {

    protected $table = 'tbl_state';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function user() {
        return $this->belongsTo('App\User', 'state_id', 'id');
    }

}
