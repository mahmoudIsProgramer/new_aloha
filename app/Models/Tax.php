<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use \Astrotomic\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


}
