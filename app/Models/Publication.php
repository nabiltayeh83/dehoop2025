<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;


class Publication extends Model
{

    use SoftDeletes, Translatable;
    public $translatedAttributes = ['title', 'details'];
    protected $table = 'publications';
    protected $hidden = ['status', 'created_at', 'updated_at', 'deleted_at','translations'];


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
   
    public function getImageAttribute($value)
    {
        return url('uploads/publications/' . $value);
    }


    public function getFileAttribute($value)
    {
        return url('uploads/publications/' . $value);
    }




}
