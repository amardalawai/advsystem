<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_country extends Model {

    protected $table = 'tbl_country';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function user() {
        return $this->belongsTo('App\User', 'country_id', 'id');
    }

}
