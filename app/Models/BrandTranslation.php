<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model
{

    protected $guarded = [];

    public $timestamps = false;
    protected $fillable = ['name','title', 'description','short_description'];


}
