<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginApiController extends Controller
{
    public function __invoke(Request $request){
        if(!auth()->attempt(['email'=>$request->email, 'password'=>$request->password])){
            return response()->json(['error'=>'email atau password salah'],401);
        }
        $token = auth()->user()->createToken('personal-token', expiresAt:now()->addHour())->plainTextToken;

        return response()->json(['token'=>$token]);
    }        
}
