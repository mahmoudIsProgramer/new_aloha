<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    protected $guarded = [];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        $image=null;
        if($this->image){
            $image= asset('uploads/backgrounds/' . $this->image);
        }
        return $image;
    }//end of image path attribute

}
