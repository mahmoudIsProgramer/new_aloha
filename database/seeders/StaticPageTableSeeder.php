<?php

namespace Database\Seeders;

use App\Models\StaticPage;
use Illuminate\Database\Seeder;

class StaticPageTableSeeder extends Seeder
{

  public function run()
  {

    $pages = ['about', 'terms', 'policy', 'returns_exchanges', 'shipping_delivery'];
    foreach ($pages as $item) {
      StaticPage::create([
        'pageName' => $item,
        'image' => 'default.png',
        'ar' => ['title' => 'title ar', 'short_description' => 'short description ar', 'description' => 'desc ar'],
        'en' => ['title' => 'title en', 'short_description' => 'short description en', 'description' => 'desc en'],
      ]);
    }
  } //end of run

}//end of seeder
