<?php

namespace App\Http\Requests;

use App\Rules\CheckEmailExist;
use Illuminate\Foundation\Http\FormRequest;

class SellerFormRequest extends FormRequest
{

  protected $errorBag = 'register';

  public $rules = [

    'full_name' => 'required|string|max:255',
    'city_id' => 'required|exists:cities,id',
    'state_id' => 'required|exists:states,id',
    // 'status'=>'required|in:1,2',
    // 'gender' => 'required|in:male,female',
  ];

  protected function getRedirectUrl()
  {
    $url = $this->redirector->getUrlGenerator();
    return $url->previous();
  }

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
      'email' => ['required', 'email', 'unique:sellers', new CheckEmailExist("sellers")],
      // 'phone'=>'required|unique:sellers',
      'password' => ['required', 'string', 'min:6'],
      'password_confirmation' => ['required', 'same:password', 'min:6'],
      'image' => validateImage(),
    ];
    return $this->rules;
  }
  public function updateRules()
  {
    $seller = $this->route('seller');
    $this->rules += [
      'email' => ['required', 'email', 'unique:sellers,email,' . $seller->id, new CheckEmailExist("sellers")],
      'phone' => 'required|unique:sellers,phone,' . $seller->id,
      'image' => validateImage(),
      'password' => 'nullable|confirmed',

    ];
    // dd($this->rules);
    return $this->rules;
  }
}
