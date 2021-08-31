<?php

namespace App\Http\Controllers\Frontend;

use App\Models\City;
use App\Models\Brand;
use App\Models\Inbox;
use App\Models\Banner;
use App\Models\Client;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\StaticPage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{

  public function __construct()
  {
  }

  public function index(Request $request)
  {

    $mainSliders = Slider::whenPosition('main')->latest()->get();
    $rightSliders = Slider::whenPosition('right')->limit(3)->latest()->get();
    $bottomSliders = Slider::whenPosition('bottom')->limit(2)->latest()->get();

    $categoryHome = Category::showOnHomePage()->Active()->latest()->limit(20)->get();

    $brands   = Brand::active()->latest()->get();

    $products  = Product::active()->latest()->limit(10)->get();
    $hotDeals  = Product::active()->latest()->limit(10)->get();

    $home_page_1_banner = Banner::where('bannerLocation', 'home_page_1')->first();
    $home_page_2_banner = Banner::where('bannerLocation', 'home_page_2')->first();
    $home_page_3_banner = Banner::where('bannerLocation', 'home_page_3')->first();

    return view('frontend.welcome', compact(
      'mainSliders',
      'rightSliders',
      'bottomSliders',
      'brands',
      'categoryHome',
      'products',
      'home_page_1_banner',
      'home_page_2_banner',
      'home_page_3_banner',
    ));
  }


  public function search(Request $request)
  {

    if ($request->ajax()) {

      $data = Product::when($request->search, function ($search) use ($request) {
        return $search->whereTranslationLike('name', '%' . $request->search . '%')
          ->orWhereTranslationLike('short_description', '%' . $request->search . '%')
          ->orWhereTranslationLike('description', '%' . $request->search . '%');
      })->limit(15)->get();

      // dd($data->count());
      $output = '';

      if (count($data) > 0) {

        $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

        foreach ($data as $row) {

          $output .= '<a href="' . route('product', $row->id) . '"><li class="list-group-item searchItems" data-product-id="' . $row->id . '">' . $row->name . '</li></a>';
        }

        $output .= '</ul>';
      } else {

        $output .= '<li class="list-group-item searchItems">' . 'No results' . '</li>';
      }

      return $output;
    }
  }

  public function staticPages()
  {
    $staticPages = StaticPage::where('pageName',  request('page'))->firstOrFail();
    return view('frontend.staticPages.templatePage', compact('staticPages'));
  }


  public function Policy()
  {
    $policy = StaticPage::where('pageName', 'Policy')->first();
    return view('policy', compact('policy'));
  }

  public function profile()
  {
    $user_id  = Auth::guard('clients')->user()->id;
    $info = Client::where('id', $user_id)->first();
    $products = Product::where('client_id', $user_id)->where('clientType', 'client')->where('approved', 1)->get();
    $categories = Category::Active()->all();
    $cities  = City::all();

    return view('profile', compact('about', 'info', 'products', 'categories', 'cities', 'comforts'));
  }

  public function categories()
  {

    $categories = Category::Active()->paginate(24);

    return view('categories', compact('categories'));
  }

  public function contact()
  {
    dd(getCustomer());
    return view('frontend.contact');
  }

  public function contactPost(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'message' => 'required',
    ]);

    $Inbox = Inbox::create($request->all());
    $message = 'Congratulatin! Your Message Is Sent Successfully  ';
    // QuickSendEmail($request->email, $message);

    session()->flash('success', __('site.sent_done'));
    return redirect()->back();
  }  //end of register_exhibitor

}
