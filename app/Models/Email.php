<?php

namespace App\Models;

use App\Admin;

use App\Models\Airport;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{

    use SoftDeletes;
    protected $table = 'emails';
    // protected $fillable = ['seen', 'replay'];

}

