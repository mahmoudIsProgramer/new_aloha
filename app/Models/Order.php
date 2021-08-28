<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }//end fo category

    public function products()
    {
        return $this->belongsToMany(Product::class , 'order_product','order_id','product_id' )->withPivot('qty','price','price_before_discount','total','status');
    } // end of parameters

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault([
          'name'=>'',
        ]);
    }
}
