<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class WalletHistoryFormRequest extends FormRequest
{

  public $rules = [
    'customer_id' => 'required|exists:customers,id',
    'amount' => 'required|numeric',
    'operation_type' => 'required|in:withdraw,purchase',
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
    $this->rules += [];
    return $this->rules;
  }

  public function updateRules()
  {
    $customer = $this->route('customer');
    $this->rules += [];
    return $this->rules;
  }
}
