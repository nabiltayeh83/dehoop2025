<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

use App\Models\ProjectType;
use App\Models\ProjectMedia;


class Project extends Model
{

    use SoftDeletes, Translatable;
    public $translatedAttributes = ['title', 'details', 'place'];
    protected $table = 'projects';
    protected $hidden = ['status', 'created_at', 'updated_at', 'deleted_at','translations'];


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
   
    public function project_type(){
        return $this->belongsTo(ProjectType::class)->withTrashed();
    }


    public function photos()
    {
        return $this->hasMany(ProjectMedia::class)->where('type', 'photo');
    }
    
    
    public function videos()
    {
        return $this->hasMany(ProjectMedia::class)->where('type', 'video');
    }



}
