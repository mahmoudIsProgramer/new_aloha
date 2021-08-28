<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded =[];

    public function category()
    {
        return $this->belongsTo(Category::class);
    } //end of products

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    } //end of products

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    } //end of products


}
