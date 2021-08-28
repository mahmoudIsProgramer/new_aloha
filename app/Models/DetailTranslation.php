<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','title', 'description'];
}
