<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    use Translatable;
    public $translatedAttributes = ['title', 'address', 'description', 'keywords'];

    protected $hidden = ['created_at', 'updated_at', 'translations'];


    public function getLogoAttribute($logo)
    {
        return !is_null($logo)?url('uploads/settings/'.$logo):null;
    }


    public function getVideoAttribute($video)
    {
        return !is_null($video)?url('uploads/settings/'.$video):null;
    }


}
