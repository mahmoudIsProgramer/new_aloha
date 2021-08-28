<?php

namespace App\Http\Requests\Dashboard;
 
use Illuminate\Foundation\Http\FormRequest;

class PromocodeFormRequest extends FormRequest
{

    public $rules = [

        'status' => ['required', 'in:0,1'],
        // 'for_customers_has_one_order' => ['required', 'in:0,1'],
        'code' => ['required', 'max:30', 'unique:promocodes'],
        // 'startDate' => ['required', 'date', 'after:yesterday',],
        'endDate' => ['required', 'date', 'after:yesterday'],
        'startTime' => ['nullable', 'date_format:H:i', ],
        'endTime' => ['nullable', 'date_format:H:i', ],
        'type' => ['required', 'in:percent,value'],
        'limit' => ['required', 'integer'],

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

        $this->rules+=[

            'discount_amount' => ['required', 'integer',function ($attribute, $value, $fail) {

                if(request()->type=='percent'&&request()->discount_amount>100){
                    $fail( __('site.Discount percent Must Not Excesed 100'));
                }

            }],

            'startDate' => ['required', 'date',function ($attribute, $value, $fail) {

                $msg = $this->validateDateTime();
                if( $msg ){
                    $fail( $msg );
                }

            }],

        ];

        return $this->rules;
    }

    public function updateRules(){

        $promocode =$this->route('promocode');

        $this->rules+=[

            'code' => ['required', 'max:30', 'unique:promocodes,code,'.$promocode->id],
            'discount_amount' => ['required', 'integer',function ($attribute, $value, $fail) {

                if(request()->type=='percent'&&request()->discount_amount>100){
                    $fail( __('site.Discount percent Must Not Excesed 100'));
                }

            }],

            'startDate' => ['required', 'date',function ($attribute, $value, $fail) {

                $msg = $this->validateDateTime();
                if( $msg ){
                    $fail( $msg );
                }

            }],

        ];

        return $this->rules;

    }

    public function validateDateTime(){

        $msg = '' ;
        $startDate=request('startDate');
        $endDate=request('endDate');
        $startTime=request('startTime');
        $endTime=request('endTime');

        $startDateTime =  date('Y-m-d H:i:s', strtotime("$startDate $startTime"));
        $endtDateTime =  date('Y-m-d H:i:s', strtotime("$endDate $endTime"));

        if( $endtDateTime <= $startDateTime  ){
            $msg  = __('site.End DateTime Must Be After start DateTime');
        }

        if( $startDateTime < now() || $endtDateTime < now() ){
            $msg  = __('site.Date Should Be In Present');
        }

        return $msg ;

    }

}
