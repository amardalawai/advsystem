<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Posts;
use File;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function userName() {
        return ucfirst($this->name);
    }

    public function userImage() {
        $image = $this->image;
        if (File::exists('profiles/' . $image) && !empty($image)) {
            $url = url('profiles/' . $this->image);
        } else {
            $url = url('profiles/default.png');
        }
        return $url;
    }

    public function location() {
        if (!empty($this->country->name) && !empty($this->state->name) && !empty($this->city)) {
            $loc = array($this->country->name, $this->state->name, $this->city);

            $loc = implode(', ', $loc);
        } else {
            $loc = 'N/A';
        }

        return $loc;
    }

    public function getSinceDate() {
        return date("d M Y", strtotime($this->created_at));
    }

    public function post() {
        return $this->belongsTo('App\Posts', 'user_id', 'id');
    }

    public function country() {
        return $this->hasOne('App\tbl_country', 'id', 'country_id');
    }

    public function state() {
        return $this->hasOne('App\tbl_state', 'id', 'state_id');
    }

}
