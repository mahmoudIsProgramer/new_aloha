<?php

namespace App\Traits\Models;

use App\Models\Product;


trait FavoirteTrait
{

  public function update_favorite()
  {

    $product = Product::find(request('product_id'));

    $customer = getCustomer();

    $product->is_favoired ? $customer->favoirtes()->detach($product->id) : $customer->favoirtes()->attach($product->id);

    return true;
  }

  public function get_favorites()
  {
    return getCustomer()->favoirtes()->paginate(10);
  }
}
