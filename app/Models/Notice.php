<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    
    use SoftDeletes;
    protected $table = 'notices';
    protected $fillable = ['user_id', 'title', 'description', 'start_date', 'end_date'];
    protected $hidden = ['updated_at', 'deleted_at'];


}