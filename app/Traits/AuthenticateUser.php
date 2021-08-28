<?php

namespace App\Traits;

use Carbon\Carbon;

trait AuthenticateUser {

    public function createAuthToken($object){
        // dd($object);
        $tokenResult = $object->createToken('Personal Access Token');
        $token = $tokenResult->token;
        // dd($token);

        if (request()->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return $tokenResult;
    }

    public function successResponse($tokenResult,$userType){

        return response()->json([
            'userType'=>$userType,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

}
