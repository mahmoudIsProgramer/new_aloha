<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use \Astrotomic\Translatable\Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['title', 'description','short_description'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/staticPage/' . $this->image);
    }//end of image path attribute


}
