<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description','short_description'];

}
