<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['title', 'description','short_description'];
}
