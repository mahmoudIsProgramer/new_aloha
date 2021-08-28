<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnitFormRequest extends FormRequest
{
    public $rules = [
    ];

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if( $this->isMethod('post') ) {
            return $this->createRules();
        } elseif ( $this->isMethod('put') ) {
            return $this->updateRules();
        }
    }

    public function createRules(){

        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.name' => ['required', Rule::unique('unit_translations', 'name')]];
        } // end of  for each

        $this->rules+=[
        ];
        return $this->rules;
    }

    public function updateRules(){

        $unit =$this->route('unit');

        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.name' => ['required', Rule::unique('unit_translations', 'name')->ignore($unit->id, 'unit_id')]];
        } // end of  for each

        dd($this->rules);
        $this->rules+=[
        ];

        return $this->rules;

    }

}
