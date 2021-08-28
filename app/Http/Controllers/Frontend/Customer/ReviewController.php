<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
  public function add_review(Request $request)
  {

    $request->validate([
      'comment' => 'nullable',
      'product_id' => 'required|exists:products,id',
      'review' => 'required|integer|min:1|max:5',
    ]);

    // rall();

    getCustomer()->reviews()->updateOrCreate(['product_id' => $request->product_id], ['comment' => $request->comment, 'review' => $request->review, 'created_at' => now()]);
    $avgRate = Review::where('product_id', $request->product_id)->avg('review');
    $updateProduct = Product::where('id', $request->product_id)->update(['review' => $avgRate]);
    session()->flash('success', __('site.added_successfully'));
    return redirect()->back();
  }
}
