<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

use App\Models\Project;
use App\Models\Donation;


class ProjectType extends Model
{

    use SoftDeletes, Translatable;
    public $translatedAttributes = ['title', 'details'];
    protected $table = 'project_types';
    protected $hidden = ['status', 'created_at', 'updated_at', 'deleted_at','translations'];


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    
    public function getImageAttribute($value)
    {
        return url('uploads/project_types/' . $value);
    }


    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    
    
        public function donations()
    {
        return $this->hasMany(Donation::class);
    }


}
