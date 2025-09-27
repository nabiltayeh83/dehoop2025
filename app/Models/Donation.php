<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

use App\Models\ProjectType;


class Donation extends Model
{

    use SoftDeletes;
    protected $table = 'donations';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

   
    public function project_type(){
        return $this->belongsTo(ProjectType::class)->withTrashed();
    }



}
