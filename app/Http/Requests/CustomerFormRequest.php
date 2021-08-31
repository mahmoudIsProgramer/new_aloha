<?php

namespace App\Http\Requests;

use App\Rules\CheckEmailExist;
use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
{

  protected $errorBag = 'register';

  public $rules = [
    'full_name' => 'required|string|max:255',
    'phone' => 'required|string|max:255',
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
      'email' => ['required', 'email', 'unique:customers', new CheckEmailExist("customers")],
      // 'phone'=>'required|unique:customers',
      'password' => ['required', 'string', 'min:6'],
      'password_confirmation' => ['required', 'same:password', 'min:6'],
      'image' => validateImage(),
    ];
    return $this->rules;
  }
  public function updateRules()
  {
    $customer = $this->route('customer');
    $this->rules += [
      'email' => ['required', 'email', 'unique:customers,email,' . $customer->id, new CheckEmailExist("customers")],
      'phone' => 'required|unique:customers,phone,' . $customer->id,
      'image' => validateImage(),
      'password' => 'nullable|confirmed',

    ];
    return $this->rules;
  }
}
