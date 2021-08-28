<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');

    }//end fo category

    public function state()
    {
        return $this->belongsTo(State::class);

    }//end fo category

    public function regoin()
    {
        return $this->belongsTo(Regoin::class);

    }//end fo category

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }//end of products

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
