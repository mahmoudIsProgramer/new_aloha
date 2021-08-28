<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{

  public function index(Request $request)
  {
    $reviews = Review::when($request->search, function ($q) use ($request) {
      return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->latest()->paginate(50);
    return view('dashboard.reviews.index', compact('reviews'));
  } //end of index

  public function create()
  {
    return view('dashboard.reviews.create');
  } //end of create

  public function store(Request $request)
  {
    $request->validate($this->validateData());
    $request_data = $request->all();
    $reviews = Review::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.reviews.index');
  } //end of store

  public function show(Review $reviews)
  {
    //
  }

  public function edit(Review $review)
  {

    if ($review->status == 1) {
      Review::where('id', $review->id)
        ->update(['status' => 0]);
    } else {
      Review::where('id', $review->id)
        ->update(['status' => 1]);
    }

    session()->flash('success', __('site.edited_successfuly'));
    return redirect()->route('dashboard.reviews.index');
  } //end of edit

  public function update(Request $request, Review $level)
  {

    $request->validate($this->validateData($level->id));
    $request_data = $request->all();

    $level->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.reviews.index');
  } //end of update

  public function destroy($reviews)
  {
    $reviews = Review::find($reviews);
    if (!$reviews) {
      return redirect()->back();
    }

    $reviews->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.reviews.index');
  } //end of destroy
}
