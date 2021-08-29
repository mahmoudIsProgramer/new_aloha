<?php

namespace App\Models;

use Carbon\Carbon;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use \Astrotomic\Translatable\Translatable;

  use SoftDeletes; //add this line

  protected $guarded = [];
  public $translatedAttributes = ['name', 'short_description', 'description', 'seo_key', 'seo_description'];
  protected $appends = ['image_path', 'total'];

  ////////////////////////////// start attributes ///////////////////////////////////
  public function getImagePathAttribute()
  {
    return asset('uploads/products/' . $this->image);
  } // end of image path attribute

  public function getTotalAttribute()
  {
    $price = $this->selling_price;

    #if have discount
    if ($this->discount != 0) {
      $price = $this->selling_price - $this->discount;
    }

    return $price;
  } // end of image path attribute

  public function getTotal($seller_id = null)
  {
    $seller = $this->selectedSeller(request()->seller_id ?? $seller_id);
    return $seller->pivot->selling_price - $seller->pivot->discount;
  } // end of image path attribute

  public function getDiscount($seller_id = null)
  {

    $seller = $this->selectedSeller(request()->seller_id, $seller_id);

    return $seller->pivot->discount;
  } // end of image path attribute

  public function getDiscountPercentAttribute($seller_id = null)
  {
    $seller = $this->selectedSeller(request()->seller_id, $seller_id);

    $total  = $seller->pivot->selling_price - $seller->pivot->discount;
    if ($total != $seller->pivot->selling_price) {
      return "<li>" .
        (1 - ($total /  $seller->pivot->selling_price)) * 100   . " " . "%"
        . __('site.Off') . "</li>";
    }

    return true;
  } // end of image path attribute

  public function getTotalBladeAttribute()
  {
    return  $this->total . ' ' . config('site_options.currency');
  } // end of image path attribute

  public function getVariationsBladeAttribute()
  {
    $txt = '';
    if ($color = $this->color) {
      $txt .= $color->title .  " - ";
    }
    if ($size = $this->size) {
      $txt .= $size->title .  " - ";
    }
    if ($capacity = $this->capacity) {
      $txt .= $capacity->title .  " - ";
    }
    if ($ram = $this->ram) {
      $txt .= $ram->title .  " - ";
    }
    if ($sim = $this->sim) {
      $txt .= $sim->title .  " - ";
    }
    if ($material = $this->material) {
      $txt .= $material->title .  " - ";
    }
    if ($type = $this->type) {
      $txt .= $type->title .  " - ";
    }
    return  $txt;
  } // end of image path attribute

  // get selected seller
  public function selectedSeller($seller_id = null)
  {
    if ($seller_id) {

      return $this->sellers()->find($seller_id);
    } else {

      return $this->sellers()->orderByRaw('(product_seller.selling_price - product_seller.discount) asc')->first();
    }
  }

  public function getSalePriceBladeAttribute()
  {
    return   config('site_options.currency')  . ' ' . $this->selling_price;
  } // end of image path attribute



  public function getInStockAttribute()
  {
    return   $this->stock > 0 ? true : false;
  } // end of image path attribute

  public function getInStockBladeAttribute()
  {
    return   $this->stock > 0 ? __('site.in stock') : __('site.Out Of Stock');
  } // end of image path attribute

  public function getIsFavoiredAttribute()
  {
    if ($customer = getCustomer()) {

      return  in_array($this->id, $customer->favoirtes()->pluck('product_id')->toArray());
    } //end of if

    return false;
  } // end of getIsFavoredAttribute

  public function getIsFavoiredClassAttribute()
  {
    if (getCustomer()) {

      return  $this->IsFavoired ? 'red_icon_heart' : '';
    } //end of if

    return '';
  } // end of getIsFavoredAttribute

  public function getInCartAttribute()
  {
    if ($customer = getCustomer()) {

      return $customer->products->where('id', $this->id)->count() > 0 ? true : false;
    } //end of if

    return false;
  } // end of getIsFavoredAttribute

  public function getQtyInCartAttribute()
  {

    $qty = 1;
    if ($this->inCart) {

      $product  = getCustomer()->products->where('id', $this->id)->first();

      $qty = $product->pivot->qty;
    }

    return $qty;
  } // end of image path attribute

  public function getTotalCartAttribute($noOffer = false)
  {

    $total = 0;

    if ($this->inCart) {

      $product  = getCustomer()->products->where('id', $this->id)->first();

      $total = $product->pivot->qty * $this->total;
    }

    return $total;
  } // end of image path attribute

  public function getInCartClassAttribute()
  {
    return  $this->inCart ? 'red_icon_cart' : '';
  } // end of getIsFavoredAttribute
  public function getCartTextAttribute()
  {
    return  $this->inCart ?  __('site.Remove From Cart') :  __('site.Add To Cart');
  } // end of getIsFavoredAttribute
  public function getFavoiredTextAttribute()
  {
    return  $this->isFavoired ? __('site.Remove From Favoirtes') : __('site.Add To Favoirtes');
  } // end of getIsFavoredAttribute

  // return  product total price which  has no offers
  public function getProductTotalHasNotOfferAttribute()
  {

    if ($this->checkIfHasOffer() || $this->discount > 0 || $this->hot_deal == 1)
      return 0;

    $total = 0;

    if ($this->inCart) {

      $product  = getCustomer()->products->where('id', $this->id)->first();

      $total = $product->pivot->qty * $this->total;
    }

    return $total;
  } // end of image path attribute

  public function getVideoHtmlAttribute()
  {
    $embed = Embed::make($this->video)->parseUrl();

    if (!$embed)
      return '';

    $embed->setAttribute(['width' => 800]);
    return $embed->getHtml();
  }

  // //////////////////////////// end  attributes ///////////////////////////////////
  public function  productHasOffer()
  {

    if ($this->checkIfHasOffer() || $this->discount > 0 || $this->hot_deal == 1) {
      return true;
    } else {
      return false;
    }
  }

  public function checkIfHasOffer()
  {
    $offer = Offer::when($this->category_id, function ($q) {
      // \Log::info('cat'.$this->category_id);

      return $q->where('category_id', $this->category_id);
    })->when($this->subcategory_id != null, function ($q) {
      // \Log::info('sub'.$this->subcategory_id);

      return $q->orWhere('subcategory_id', $this->subcategory_id);
    })->when($this->brand_id != null, function ($q) {
      // \Log::info('brand'.$this->brand_id);

      return $q->orWhere('brand_id', $this->brand_id);
    })->first();

    return $offer;
  }

  ######################### start relationships    ##########################
  public function customers()
  {
    return $this->belongsToMany(Customer::class, 'customer_product_seller', 'customer_id', 'product_id')->withPivot(['qty']);
  }

  public function sellers()
  {
    return $this->belongsToMany(Seller::class, 'product_seller', 'seller_id', 'product_id')->withPivot([
      'stock', 'selling_price', 'discount', 'sku', 'seller_notes', 'status',
      // 'importance',
    ]);
  }

  public function quantity()
  {
    return $this->belongsToMany(Customer::class, 'customer_quantity', 'customer_id', 'product_id')->withPivot(['qty', 'total']);
  }

  public function category()
  {
    return $this->belongsTo(Category::class)->withDefault(['name' => '']);
  } //end fo category

  public function subcategory()
  {
    return $this->belongsTo(Subcategory::class)->withDefault(['name' => '']);
  } //end fo category

  public function subsubcategory()
  {
    return $this->belongsTo(Subsubcategory::class)->withDefault(['name' => '']);
  } //end fo category

  public function brand()
  {
    return $this->belongsTo(Brand::class)->withDefault([
      'name' => '',
    ]);
  } //end fo category

  public function reviews()
  {
    return $this->hasMany(Review::class);
  } //end fo category

  public function favoirtes()
  {
    return $this->belongsToMany(Customer::class, 'favoirtes', 'customer_id', 'product_id');
  }

  public function orders()
  {
    return $this->belongsToMany(Order::class, 'order_product', 'order_id', 'product_id')->withPivot('qty', 'price', 'price_before_discount', 'total', 'status');
  } // end of parameters

  public function requestPricerOders()
  {
    return $this->belongsToMany(RequestPriceOrder::class, 'request_price_order_products', 'request_price_orders_id', 'product_id')->withPivot('qty', 'color', 'price', 'total');
  } // end of parameters

  public function variations()
  {
    return $this->belongsToMany(Variation::class, 'product_variations', 'variation_id', 'product_id')->withPivot('qty');
  } // end of parameters

  public function productImages()
  {
    return $this->hasMany(ProductImage::class);
  } // end of user

  public function color()
  {
    return $this->belongsTo(Color::class);
  } // end of user

  public function size()
  {
    return $this->belongsTo(Size::class);
  } // end of user

  public function ram()
  {
    return $this->belongsTo(Ram::class);
  } // end of user

  public function capacity()
  {
    return $this->belongsTo(Capacity::class);
  } // end of user

  public function sim()
  {
    return $this->belongsTo(Sim::class);
  } // end of user

  public function material()
  {
    return $this->belongsTo(Material::class);
  } // end of user

  public function type()
  {
    return $this->belongsTo(Type::class);
  } // end of user

  public function details()
  {
    return $this->hasMany(Detail::class, 'product_id', 'id');
  }

  // public function specifications()
  // {
  //   return $this->belongsToMany(Specification::class, 'product_specification', 'product_id', 'specification_id');
  // } //end of products


  ######################### end relationships    ##########################

  ////////////////////////////////   start scopes //////////////////////////////
  public function scopeOnSale($query)
  {
    return $query->where('on_sale', 1);
  }

  public function scopeIsCompo($query)
  {
    return $query->where('is_compo', 1);
  }

  public function scopeTrending($query)
  {
    return $query->where('trending', 1);
  }

  public function getIsNewAttribute($query)
  {
    Carbon::parse($this->created_at)->addMonth()->isPast() ? true : false;
  }

  public function scopeFeatured($query)
  {
    return $query->where('featured', 1);
  }

  public function scopeActive($query)
  {
    return $query->where('status', 1);
  }

  public function scopeBestSeller($query)
  {
    //return $query->orderBy('count_solid','desc');
    return $query->where('best_seller', 1);
  }

  public function scopeHotDeal($query)
  {
    return $query->where('hot_deal', 1);
  }

  public function scopeOff50($query)
  {
    return $query->where('discount_percent', 50);
  }

  public function scopeWhenSearch($query, $search)
  {

    return $query->whereTranslationLike('name', '%' . $search . '%')
      ->orWhereTranslationLike('short_description', '%' . $search . '%')
      ->orWhereTranslationLike('description', '%' . $search . '%');
  } // end of scopeWhenSearch

  public function scopeWhenCategory($query, $category)
  {
    return $query->when($category, function ($q) use ($category) {

      return $q->whereHas('category', function ($qu) use ($category) {

        return $qu->where('category_id', $category);
      });
    });
  } // end of

  public function scopeWhenSubcategory($query, $subcategory)
  {
    return $query->when($subcategory, function ($q) use ($subcategory) {

      return $q->whereHas('subcategory', function ($qu) use ($subcategory) {

        return $qu->where('subcategory_id', $subcategory);
      });
    });
  } // end of

  public function scopeWhenBrand($query, $brands)
  {
    return $query->when($brands, function ($q) use ($brands) {

      return $q->whereHas('brand', function ($qu) use ($brands) {

        return $qu->whereIn('brand_id', $brands);
      });
    });
  } // end of

  public function scopeWhenColor($query, $color_id)
  {
    return $query->where('color_id', $color_id);
    // dd($color_id);
    // return $query->when($color_id, function ($q) use ($color_id) {

    //   return $q->whereHas('color', function ($qu) use ($color_id) {

    //     return $qu->where('color_id', $color_id);
    //   });
    // });
  }

  public function scopeWhenSize($query, $size_id)
  {
    return $query->when($size_id, function ($q) use ($size_id) {

      return $q->whereHas('size', function ($qu) use ($size_id) {

        return $qu->where('subcategory_id', $size_id);
      });
    });
  } // end of

  public function scopeWhenFromPrice($query)
  {
    if (request()->from_price != null) {
      return $query->where('selling_price', '>=', request()->from_price);
    }
  } // end of

  public function scopeWhenToPrice($query)
  {
    if (request()->to_price != null) {
      return $query->where('selling_price', '<=', request()->to_price);
    }
  } // end of

  ////////////////////////////////   start scopes //////////////////////////////
}//end of model
