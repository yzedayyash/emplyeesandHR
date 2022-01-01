<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt(['email' => $request->email , 'password' => $request->password , 'status' => 1])) {

            return response()->json([
                'success' => false,
                'message' => 'wrong credentals',
            ] , 401);
        }
        $token_type = 'customer_token';
        $abilities = ['customer'];
        if(auth()->user()->is_hr == 1){
            $token_type = 'hr_token';
            $abilities = ['hr'];

        }
        return response()->json([
            'success' => true,
            'token' => auth()->user()->createToken($token_type , $abilities)->plainTextToken,
        ] , 200);
    }



    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
