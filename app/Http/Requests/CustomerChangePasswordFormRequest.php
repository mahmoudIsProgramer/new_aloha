<?php

namespace App\Http\Requests;

use App\Rules\CustomerValidateOldPassword;
use Illuminate\Foundation\Http\FormRequest;

class CustomerChangePasswordFormRequest extends FormRequest
{

  public $rules = [
    'password' => 'required|string|min:6',
    'password_confirmation' => 'required|same:password|min:6',
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
      'old_password' => ['required', new CustomerValidateOldPassword()],
    ];
    return $this->rules;
  }
  public function updateRules()
  {
    $this->rules += [];
    return $this->rules;
  }
}
