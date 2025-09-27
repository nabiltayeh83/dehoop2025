<?php
namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjectMedia extends Model
{
    use SoftDeletes;
    protected $table = 'projects_media';
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at', 'type'];

    public function getFileAttribute($value)
    {
        return url('uploads/projects_media/' . $value);
    }

}

