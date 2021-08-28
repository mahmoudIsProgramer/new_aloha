<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
  use \Astrotomic\Translatable\Translatable;

  protected $guarded = [];
  public $translatedAttributes = ['name'];
  protected $appends = ['image_path'];

  public function details()
  {
    return $this->hasMany(Detail::class, 'product_id', 'id');
  }

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }

  // public function products()
  // {
  //   return $this->belongsToMany(Product::class, 'product_specification', 'product_id', 'specification_id');
  // } //end of products



  // public function products()
  // {
  //     return $this->belongsToMany( Product::class);
  // }//end of products

  public function scopeWhenProduct($query, $product)
  {
    if ($product) {

      return $query->when($product, function ($q) use ($product) {

        return $q->where('category_id', $product->category_id);
      });
    }
  } // end of 

}
