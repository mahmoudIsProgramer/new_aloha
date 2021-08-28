<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
  public $rules = [
    'status' => ['nullable', 'in:0,1'],
    'featured' => ['nullable', 'in:0,1'],
    'trending' => ['nullable', 'in:0,1'],
    // 'hot_deal' => ['nullable', 'in:0,1'],
    // 'hot_deal_price' => ['nullable', 'integer', 'lt:sale_price'],
    // 'expire_date'=>['nullable','date','after:today'],
    'stock' => ['nullable', 'integer'],
    'selling_price' => ['required', 'integer'],
    'discount' => ['nullable', 'integer', 'lt:selling_price'],
    // 'unit_value' => ['nullable', 'integer'],
    'category_id' => 'required|exists:categories,id',
    'subcategory_id' => 'nullable|exists:subcategories,id',
    'subsubcategory_id' => 'nullable|exists:subsubcategories,id',
    'brand_id' => 'nullable|exists:brands,id',
    'seller_id' => 'required|exists:sellers,id',
    'color_id' => 'nullable|exists:colors,id',
    'size_id' => 'nullable|exists:sizes,id',
    'ram_id' => 'nullable|exists:rams,id',
    'sim_id' => 'nullable|exists:sims,id',
    'capacity_id' => 'nullable|exists:capacities,id',
    'type_id' => 'nullable|exists:types,id',
    'material_id' => 'required|exists:materials,id',
    'products' => 'nullable|array|exists:products,id',

  ];

  public function authorize()
  {
    return true;
  }
  public function rules()
  {
    foreach (config('translatable.locales') as $locale) {
      $this->rules += [$locale . '.name' => 'required'];
      $this->rules += [$locale . '.short_description' => 'required'];
      $this->rules += [$locale . '.description' => 'required'];
    } // end of  for each

    if ($this->isMethod('post')) {
      return $this->createRules();
    } elseif ($this->isMethod('put')) {
      return $this->updateRules();
    }
  }

  public function createRules()
  {
    $this->rules += [
      'image' => 'required|' . validateImage(),
      'attachments' => 'required',
      'attachments.*' => 'required|' . validateImage(),

      'hot_deal' => ['nullable', function ($attribute, $value, $fail) {

        if (request('hot_deal') == 1) {
          $msg = $this->validateHotDealDateTime();
          if ($msg) {
            $fail($msg);
          }
        }
      }],

    ];
    return $this->rules;
  }

  public function updateRules()
  {

    $product = $this->route('product');

    $this->rules += [

      'image' => 'nullable|' . validateImage(),
      'attachments' => 'nullable',
      'attachments.*' => 'nullable|' . validateImage(),

      'hot_deal' => ['nullable', function ($attribute, $value, $fail) {

        if (request('hot_deal') == 1) {
          $msg = $this->validateHotDealDateTime();
          if ($msg) {
            $fail($msg);
          }
        }
      }],

    ];

    return $this->rules;
  }

  public function validateHotDealDateTime()
  {

    $msg = '';
    $endDate = request('expire_hot_deal_date');
    $endTime = request('expire_hot_deal_time');

    $endtDateTime =  date('Y-m-d H:i:s', strtotime("$endDate $endTime"));

    if ($endtDateTime <= now()->toDateTimeString()) {
      $msg  = __('site.End DateTime Must Be In Present');
    }

    return $msg;
  }
}
