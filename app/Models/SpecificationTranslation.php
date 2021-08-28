<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','title', 'description','short_description'];

}
