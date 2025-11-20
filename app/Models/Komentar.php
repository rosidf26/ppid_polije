<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Komentar extends Model
{
    use CrudTrait;

    protected $table = 'comments';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];


}
