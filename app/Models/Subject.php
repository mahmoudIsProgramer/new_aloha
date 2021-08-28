<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    use \Astrotomic\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);

    } //end fo category

    public function products()
    {
        return $this->hasMany(Product::class);

    } //end fo category


}
