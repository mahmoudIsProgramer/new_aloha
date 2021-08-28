<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddImage extends Model
{

    protected $table = 'add_images';
    protected $appends = ['image_path'];

    public function ads()
    {
        return $this->belongsTo(Add::class);
    }//end of user

    public function getImagePathAttribute()
    {
        return asset('uploads/ads/' . $this->image);

    } //end of get image path

}
