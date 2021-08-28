<?php

namespace App\Rules;

use App\Subject;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Rule;

class ValidateFileName implements Rule
{
    public function __construct()
    {

    }
    public function passes($attribute, $value)
    {
        $fileName = pathinfo(Input::file('file')->getClientOriginalName(), PATHINFO_FILENAME );
        // \Log::info( "fileName: ". $fileName );

        $explode = explode("_",$fileName);
        // \Log::info( "size: ". strlen($fileName) );
        if( count($explode) != 4 || strlen($fileName)!=14 ){
            // \Log::info( "size: ". strlen($fileName) );
            return false ;
        }

        //subjectCode
        if( empty(Subject::where('code',$explode[0])->first())  ){
            // \Log::info( "subjectCode: " );
            return false ;
        }

        //session
        if(  !in_array( substr( $explode[1] , 0 , 1 ) ,['s','w','m']) ){
            \Log::info( "session: " );
            return false ;
        }
        //year
        if(  !is_int( (int)substr( $explode[1] , 1 , 2 ) )    ){
            \Log::info( "year: " );
            return false ;
        }
        //paperType
        if(  !in_array( $explode[2]  ,['qp','ms','er','gt','sf','su','sp','sm','ir']) ){
            \Log::info( "paperType: " );
            return false ;
        }
        //paperNumber
        if(  !in_array( substr( $explode[3] , 0 , 1 )  ,['1','2','3','4','5','6','6','7','9']) ){
            \Log::info( "paperNumber: " );
            return false ;
        }
        //variantName
        if(  !in_array(  substr( $explode[3] , 1  )  ,['1','2','3','4','5','6','6','7','9']) ){
            \Log::info( "variantName: " );
            return false ;
        }

        // 'subjectCode'=>$explode[0],
        // 'session'=>substr( $explode[1] , 0 , 1 ) ,
        // 'year'=>substr( $explode[1] , 1 , 2 ) ,
        // 'paperType'=>$explode[2],
        // 'paperNumber'=>substr( $explode[3] , 0 , 1 ),
        // 'variantName'=>substr( $explode[3] , 1  ),

        return true ;
    }

    public function message()
    {
        return  __('site.File Name Not Correct');
    }


}
