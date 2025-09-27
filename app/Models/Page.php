<?php
namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Page extends Model
{
    use SoftDeletes, Translatable;

    public $translatedAttributes = ['title', 'details', 'keywords'];
    protected $fillable = ['image'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at', 'translations'];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }


    public function getImageAttribute($value)
    {
        return $value? url('uploads/pages/' . $value) : null;
    }


    public function getHomepageImageAttribute($value)
    {
        return $value? url('uploads/pages/' . $value) : null;
    }




}

