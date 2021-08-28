<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{

  public function run()
  {

    for ($i = 1; $i <= 3; $i++) {
      $product =  Product::create([

        'ar' => [
          'name' => 'product ' . $i, 'short_description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.", 'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum" . $i
        ],
        'en' => [
          'name' => 'product ' . $i, 'short_description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.", 'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum" . $i
        ],
        'category_id' => rand(1, 4),
        // 'subcategory_id'=>1,
        // 'brand_id'=>1,
        'status' => rand(0, 1),
        'featured' => rand(0, 1),
        'trending' => rand(0, 1),
        // 'is_new'=>1,
        // 'best_seller'=>1,
        // 'off_50'=>1,
        'on_sale' => rand(0, 1),
        'hot_deal' => 0,
        // 'hot_deal_price'=>120,
        // 'expire_date_hot_deal'=>now()->addDays(5)->toDateTimeString(),
        'product_code' => 'porduct_sku_code',
        'porduct_sku_code' => 'porduct_sku_code',
        'product_serial_number' => 'product_serial_number',
        'link_youtube' => 'link_youtube',
        'stock' => 10,
        'stock_limit_alert' => 5,
        'count_solid' => '10',
        // 'number_views'=>100,
        // 'number_clicks'=>200,
        // 'review'=>4,
        // 'total_number_review'=>150,
        'purchase_price' => 50,
        'selling_price' => 100,
        'discount' => 20,
        'image' => rand(1, 10) . '.jpg',
      ]);

      $productImate = ProductImage::insert([
        [
          'product_id' => $product->id,
          'image' => rand(1, 10) . '.jpg',
        ],
        [
          'product_id' => $product->id,
          'image' => rand(1, 10) . '.jpg',
        ],
        [
          'product_id' => $product->id,
          'image' => rand(1, 10) . '.jpg',
        ],
        [
          'product_id' => $product->id,
          'image' => rand(1, 10) . '.jpg',
        ]
      ]);
    }
  }
}
