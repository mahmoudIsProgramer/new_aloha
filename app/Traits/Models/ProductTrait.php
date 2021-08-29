<?php

namespace App\Traits\Models;

use App\Models\Detail;
use App\Models\Seller;
use App\Models\Product;
use App\Models\ProductImage;

trait ProductTrait
{
  use UploadFileTrait;

  public function getRequestData()
  {

    return  request()->except([
      'products',
      'expire_hot_deal_time',
      'expire_hot_deal_date',
      'expire_time',
      'attachments',
      'images',
      'product_files',
      'password',
      'password_confirmation',
      'address',
      'image',
      'levels',
      'stock',
    ]);
  }

  public function insertProduct($request)
  {
    $request_data = $this->getRequestData();

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'products/', '');
    } // end of if

    $product = Product::create($request_data);

    if (request('products')) {
      $product->grouped_products = implode(',', request()->products) . "," . $product->id;
      $product->save();
    } else {
      $product->grouped_products =  $product->id;
      $product->save();
    }

    if ($request->attachments) {
      $this->insertImages($request->attachments, $product->id);
    }

    $seller = Seller::find(request('seller_id'));
    $this->attachProductToSeller($product, $seller);

    return true;
  }

  public function updateProduct($product, $request)
  {
    $request_data = $this->getRequestData();

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'products/', $product->image);
    } //end of if

    if ($product->grouped_products) {

      Product::whereIn('id', explode(',', $product->grouped_products))
        ->update(['grouped_products' => ""]);
    }

    if (request('products')) {

      Product::whereIn(
        'id',
        request('products')
      )->update([
        'grouped_products' => implode(',', request()->products)
      ]);
    }

    if ($request->attachments) {
      $this->insertImages($request->attachments, $product->id);
    } // end of if

    $product->update($request_data);

    return true;
  }

  public function destroyProduct($Product)
  {
    $Product->delete();

    return true;
  }

  public function hotDealDateTime($request_data, $request)
  {

    $endDate = $request->expire_hot_deal_date;
    $endTime = $request->expire_hot_deal_time;

    $hotDealendtDateTime =  date('Y-m-d H:i:s', strtotime("$endDate $endTime"));

    $request_data['expire_date_hot_deal'] = $hotDealendtDateTime;

    return $request_data;
  }

  function insertImages($attachments, $product_id)
  {
    $attachments = $this->MultipleUploadImages($attachments, 'product_images/');

    foreach ($attachments as $file_name) {
      $create = ProductImage::create([
        'product_id' => $product_id,
        'image' => $file_name,
      ]);
    }
  }

  public function copyProduct(Product $product)
  {

    $clone = $product->replicate();
    $clone->push();

    $copy = $clone->update([
      'ar' => [
        'name' => $product->translate('ar')->name . ' نسخة اخري  ',
        'description'  => $product->description,
        'short_description' => $product->short_description,
      ],
      'en' => [
        'name' => $product->translate('en')->name . ' another copy',
        'description'  => $product->description,
        'short_description' => $product->short_description,
      ],
      'grouped_products' =>
      $product->grouped_products
        ? $product->grouped_products . "," . $clone->id
        : $clone->id,
      'image' => 'default.png',
      'status' => 0,
    ]);

    //start  fill Specifications
    if ($details = $product->details) {
      foreach ($details as $key => $value) {
        Detail::create([
          'product_id' => $clone->id,
          'specification_id' => $value->specification_id,
          'ar' => [
            'name' => $value->translate('ar')->name,
          ],
          'en' => [
            'name' => $value->translate('en')->name,
          ],
        ]);
      }
    } //end   fill Specifications

    return redirect()->back();
  } //end of duplicate

  public function attachProductToSeller($product, $seller)
  {
    $product->sellers()->syncWithoutDetaching([
      $seller->id  => [
        'stock' => request('stock') ?? 1,
        'selling_price' => request()->selling_price,
        'discount' => request()->discount,
        'sku' => request()->sku,
        'seller_notes' => request()->seller_notes,
        'discount' => request()->discount,
        'status' => request()->status,
      ]
    ]);

    return true;
  }
}
