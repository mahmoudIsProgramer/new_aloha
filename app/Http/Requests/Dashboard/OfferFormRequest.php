<?php

namespace App\Http\Requests\Dashboard;

use App\Offer; 
use Illuminate\Foundation\Http\FormRequest;

class OfferFormRequest extends FormRequest
{
    public $rules = [

    ];
    public $activeStatus = 1;

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

            'percent'=>['required','integer','gt:0','max:100',function ($attribute, $value, $fail)  {

                if( request('category_id')==null && request('subcategory_id')==null && request('brand_id')==null ){
                    $fail( __('site.Please Select One At Least From Categoires Or Sucategoires Or Brands'));
                }


            }] ,
            'category_id' =>['bail','nullable','exists:categories,id',function ($attribute, $value, $fail)  {

                $cate = Offer::where('category_id',request('category_id'))->where('status',$this->activeStatus)->count();

                if($cate!=0){
                    $fail( __('site.Offer Already Exists'));
                }

            }] ,

            'subcategory_id' =>['bail','nullable','exists:subcategories,id',function ($attribute, $value, $fail)  {

                $subcate = Offer::where('subcategory_id',request('subcategory_id'))->where('status',$this->activeStatus)->count();

                if($subcate!=0){
                    $fail( __('site.Offer Already Exists'));
                }

            }] ,

            'brand_id' =>['bail','nullable','exists:brands,id',function ($attribute, $value, $fail)  {

                $brand = Offer::where('brand_id',request('brand_id'))->where('status',$this->activeStatus)->count();

                if($brand!=0){
                    $fail( __('site.Offer Already Exists'));
                }

            }] ,


        ];

        return $this->rules;
    }

    public function updateRules(){

        $offer =$this->route('offer');
        // dd($offer);
        $this->rules+=[

            'percent'=>['required','integer','gt:0','max:100',function ($attribute, $value, $fail) use($offer) {

                if( request('category_id')==null && request('subcategory_id')==null && request('brand_id')==null ){
                    $fail( __('site.Please Select One At Least From Categoires Or Sucategoires Or Brands'));
                }

            }] ,

            'category_id' =>['bail','nullable','exists:categories,id',function ($attribute, $value, $fail)  use($offer){

                $cate = Offer::where('id','!=',$offer->id)->where('category_id',request('category_id'))->where('status',$this->activeStatus)->count();

                if($cate!=0){
                    $fail( __('site.Offer Already Exists'));
                }

            }] ,

            'subcategory_id' =>['bail','nullable','exists:subcategories,id',function ($attribute, $value, $fail) use($offer) {

                $subcate = Offer::where('id','!=',$offer->id)->where('subcategory_id',request('subcategory_id'))->where('status',$this->activeStatus)->count();

                if($subcate!=0){
                    $fail( __('site.Offer Already Exists'));
                }

            }] ,

            'brand_id' =>['bail','nullable','exists:brands,id',function ($attribute, $value, $fail) use($offer) {

                $brand = Offer::where('id','!=',$offer->id)->where('brand_id',request('brand_id'))->where('status',$this->activeStatus)->count();

                if($brand!=0){
                    $fail( __('site.Offer Already Exists'));
                }

                if(empty(request('category_id'))&&empty(request('subcategory_id'))&&empty(request('brand_id'))){
                    $fail( __('site.Please Select One At Least From Categoires Or Sucategoires Or Brands'));
                }

            }] ,


        ];

        return $this->rules;

    }

}
