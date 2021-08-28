<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
{

  public $rules = [

    'status' => ['nullable', 'in:0,1'],
    'featured' => ['nullable', 'in:0,1'],
    // 'vendor_id'=>'required|exists:vendors,id',

  ];

  public function authorize()
  {
    return true;
  }
  
  public function rules()
  {

    foreach (config('translatable.locales') as $locale) {
      // $this->rules += [$locale . '.name' => 'required','max:255'];
      // $this->rules += [$locale . '.short_description' => 'required'];
      // $this->rules += [$locale . '.description' => 'nullable'];
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
      // 'attachments' => 'required',
      // 'attachments.*' =>'required|'.validateImage(),
      'image' => 'required|' . validateImage(),
    ];
    return $this->rules;
  }

  public function updateRules()
  {

    $product = $this->route('product');

    $this->rules += [
      'image' => 'nullable|' . validateImage(),
      // 'attachments' => 'nullable',
      // 'attachments.*' =>'nullable|'.validateImage(),
    ];

    return $this->rules;
  }
}
