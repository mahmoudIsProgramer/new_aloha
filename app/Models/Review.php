<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $guarded = [];


    public function customer(){
        return $this->belongsTo( Customer::Class );
    }

    public function product(){
        return $this->belongsTo( Product::Class );
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getDateAttribute()
    {
      return date('Y-m-d', strtotime($this->created_at));
    } //end of image path attribute



}
