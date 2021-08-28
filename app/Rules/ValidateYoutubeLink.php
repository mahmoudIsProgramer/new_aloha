<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateYoutubeLink implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if( $value == null ){ // make it nullabel 
            return true ; 
        } 

        if (preg_match('@^(?:https://(?:www\\.)?youtube.com/)(watch\\?v=|v/)([a-zA-Z0-9_]*)@', $value, $match)) {
            return  true;
        } else {
            return false;
        } 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Enter valid Youtube Link.';
    }
}
