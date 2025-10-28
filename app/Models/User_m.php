<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User_m extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'users';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token'];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }
}
