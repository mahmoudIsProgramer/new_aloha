<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }//end fo category

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }//end fo category

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id')->withPivot();
    }//end fo category

}
