<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\CheckEmailExist;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DetailFormRequest extends FormRequest
{
  public $rules = [

    // 'full_name'=>'required|string|max:255',
    'product_id' => 'required|exists:products,id',
    'specification_id' => 'required|exists:specifications,id',
  ];

  public function authorize()
  {
    return true;
  }
  public function rules()
  {
    if ($this->isMethod('post')) {
      return $this->createRules();
    } elseif ($this->isMethod('put')) {
      return $this->updateRules();
    }
  }

  public function createRules()
  {

    foreach (config('translatable.locales') as $locale) {
      $this->rules += [$locale . '.name' => ['required', Rule::unique('detail_translations', 'name')]];
    } // end of  for each

    return $this->rules;
  }

  public function updateRules()
  {

    $detail = $this->route('detail');

    foreach (config('translatable.locales') as $locale) {
      $this->rules += [$locale . '.name' => ['required', Rule::unique('detail_translations', 'name')->ignore($detail->id, 'detail_id')]];
    } // end of  for each

    return $this->rules;
  }
}
