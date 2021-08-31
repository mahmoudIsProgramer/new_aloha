<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    ############################## start  site options  ##############################
    $siteOption = SiteOption::first();

    config([
      'site_options.currency' => $siteOption->currency,
      'site_options.minimum_order_to_apply_promocode' => $siteOption->minimum_order_to_apply_promocode,
      'site_options.minimum_order_option' => $siteOption->minimum_order_option,
      'site_options.copyRights' => $siteOption->copyRights,
    ]);

    ############################## end site options  ##############################

    $socialMedia = DB::table('socail_media')->get();
    // shown on sidebar
    $categoriesSidebar = Category::Active()->where('parent_id', null)->orWhere('parent_id', 0)->get();
    // dd($categoriesSidebar);
    // $categoriesSidebar = Category::Active()->whereHas('subcategories')->with(['subcategories' => function ($q) {

    //   $q->active()->whereHas('subsubcategories')->with(['subsubcategories' => function ($q) {

    //     $q->active();
    //   }]);
    // }])->get();

    // shown on main menu
    $categoriesMenu = Category::active()->menu()->limit(6)->get();

    View::share('socialMedia', $socialMedia);
    View::share('categoriesSidebar', $categoriesSidebar);
    View::share('categoriesMenu', $categoriesMenu);
    View::share('siteOption', $siteOption);
  }
}
