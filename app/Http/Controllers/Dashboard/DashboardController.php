<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Tax;
use App\Models\City;
use App\Models\News;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\State;
use App\Models\Regoin;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Promocode;
use App\Models\Statistic;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

  public function index()
  {
    // dd(Auth::user()->permissions()->count());
    $inbox = DB::table('inboxes')->where('state', 2)->count();
    $categories = Category::count();
    $subcategories = Subcategory::count();
    $promocodes = Promocode::count();
    $deliveries = Delivery::count();
    $reviews = Review::count();
    $taxes = Tax::count();
    // $subjects = Subject::count();
    // $teachers = Teacher::count();
    $cities = City::count();
    $states = State::count();
    $products  = Product::count();
    $orders  = Order::count();
    $users  = User::count();
    $customers  = Customer::count();
    $brands  = Brand::count();
    $total_sale = Order::sum('total');
    $latest_products = Product::latest()->limit(10)->get();
    $latest_orders = Order::latest()->limit(10);

    $stocks = Product::count();
    $latest_customers = Customer::latest()->limit(8)->get();

    return view('dashboard.index', compact('total_sale', 'customers', 'latest_products', 'latest_orders', 'taxes', 'reviews', 'promocodes', 'deliveries', 'categories', 'subcategories', 'products', 'stocks', 'orders', 'inbox', 'cities', 'states', 'users', 'brands', 'latest_customers'));
  } //end of index

  public function statistics()
  {
    $total_views =  (Statistic::sum('views')  != 0)  ? Statistic::sum('views')  : 1;
    $total_clicks = (Statistic::sum('clicks') != 0)  ? Statistic::sum('clicks') : 1;

    $statistics  = Statistic::paginate(15);
    $percnet_of_clicks  = ceil(($total_clicks / $total_views) * 100);
    $total_orders  = Statistic::sum('orders');
    $Shift_ratio =  ceil(($total_orders / $total_clicks) * 100);
    return view('dashboard.statistics', compact('total_views', 'total_clicks', 'statistics', 'percnet_of_clicks', 'total_orders', 'Shift_ratio'));
  } //end of index

}//end of controller
