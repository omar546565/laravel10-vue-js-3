<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function register (Request $request){
      validator($request->all(), [
         'name' => 'required',
         'email' => 'required|email|unique:users',
         'password' => 'required|confirmed'
      ]);

        $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 200,
             'access_token' => $token,
             'token_type' => 'Bearer',
        ]);
   }

   public function login(Request $request){
       $credentials=$request->validate([
           'email' => 'required|email',
           'password' => 'required'
       ]);

        if(!$token=auth()->attempt($credentials)){
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }

        $user = auth()->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 200,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

   }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

         return response()->json([
              'status' => 200,
              'message' => 'Tokens Revoked'
         ]);
    }


}
