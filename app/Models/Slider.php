<?php
namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Slider extends Model
{
    use SoftDeletes, Translatable;

    public $translatedAttributes = ['guiding_title1', 'guiding_title2', 'title'];
    protected $fillable = ['image'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at', 'translations'];


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }


    public function getImageAttribute($value)
    {
        return url('uploads/sliders/' . $value);
    }

}

