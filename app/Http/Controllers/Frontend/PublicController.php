<?php

namespace App\Http\Controllers\Frontend;

use App\Models\State;
use App\Models\Regoin;
use App\Models\RegoinTranslation;
use App\Models\StateTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{

  public function getStates(Request $request)
  {
    if (\request()->ajax()) {
      // get statse
      if (\request()->has('city_id') &&  \request()->get('getData') == 'states') {
        $states_ids  = State::where('city_id', request('city_id'))->pluck('id');
        $select = (\request()->has('select') && \request()->get('select') != '') ? \request()->get('select')  :  "";

        return \Form::select(
          'state_id',

          StateTranslation::join('states', 'state_translations.state_id', '=', 'states.id')
            ->where('state_translations.locale', \App::getLocale())
            ->whereIn('states.id', $states_ids)
            ->pluck('state_translations.name', 'states.id'),
          $select,
          ['required' => true, 'class' => 'form-control select2 state_id', 'style' => 'width: 100%;', 'placeholder' => trans('site.states')]
        );
      }
      // end get states

    }
  }

  public function getRegoins(Request $request)
  {
    if (\request()->ajax()) {
      // get statse
      if (\request()->has('state_id') &&  \request()->get('getData') == 'regoins') {
        $regoins_ids  = Regoin::where('state_id', request('state_id'))->pluck('id');
        $select = (\request()->has('select') && \request()->get('select') != '') ? \request()->get('select')  :  "";

        return \Form::select(
          'regoin_id',

          RegoinTranslation::join('regoins', 'regoin_translations.regoin_id', '=', 'regoins.id')
            ->where('regoin_translations.locale', \App::getLocale())
            ->whereIn('regoins.id', $regoins_ids)
            ->pluck('regoin_translations.name', 'regoins.id'),
          $select,
          ['required' => true, 'class' => 'form-control select2 regoin_id', 'style' => 'width: 100%;', 'placeholder' => trans('site.regoins')]
        );
      }
      // end get regoins

    }
  }

  public function getSubcategories()
  {

    if (\request()->ajax()) {
      // get statse
      if (\request()->has('category_id') &&  \request()->get('getData') == 'subcategories') {

        $category =  Category::find(request('category_id'));
        $subcategories =  $category->subcategories()->pluck('id');
        $select = (\request()->has('select') && \request()->get('select') != '') ? \request()->get('select')  :  "";

        return \Form::select(
          'subcategory_id',
          SubcategoryTranslation::join('subcategories', 'subcategory_translations.subcategory_id', '=', 'subcategories.id')
            ->where('subcategory_translations.locale', \App::getLocale())
            ->whereIn('subcategories.id', $subcategories)
            ->pluck('subcategory_translations.name', 'subcategories.id'),
          $select,
          ['required' => true, 'class' => 'form-control select2 subcategory_id', 'style' => 'width: 100%;', 'placeholder' => trans('site.subcategories')]
        );
      }
      // end get states
    }
  }
}
