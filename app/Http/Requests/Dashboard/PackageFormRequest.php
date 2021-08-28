<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PackageFormRequest extends FormRequest
{
  public $rules = [
    'permissions' => 'required|array|min:1',
    'sale_price' => ['required', 'numeric'],
    'discount' => ['nullable', 'numeric', 'lt:sale_price'],
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

    $this->rules += [
      'name' => 'required|unique:roles,name',

    ];
    foreach (config('translatable.locales') as $locale) {
      $this->rules += [$locale . '.title' => ['required', Rule::unique('role_translations', 'title')]];
    } // end of  for each

    return $this->rules;
  }

  public function updateRules()
  {

    $role = $this->route('package');
    $role = Role::find($role);
    // dd($role);

    foreach (config('translatable.locales') as $locale) {
      $this->rules += [$locale . '.title' => ['required', Rule::unique('role_translations', 'title')->ignore($role->id, 'role_id')]];
    } // end of  for each

    $this->rules += [
      'name' => 'required|unique:roles,name,' . $role->id,
    ];


    return $this->rules;
  }
}
