<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login (Request $request){

        // if(!Auth::attempt($request->only('email', 'password'))){
        //     return 'false';
            // response(
            //     ["message" => "Correo o contraseña incorrecto."], 401
            //);
        // }

        // return response(["user" => Auth::user()]);


        // $credentials = $request->only('email', 'password');

        // if (!Auth::attempt($credentials)){
        //     return response(
        //         ["message" => "Correo o contraseña incorrecto."], 401
        //     );
        // }

        // $accesToken = Auth::user()->createToken('authTestToken')->accessToken;

        // return response(["user" => Auth::user(), "access_token" => $accesToken]);


        // $credentials = request(['email', 'password']);
        // if (!Auth::attempt($credentials)) {
        //     return response()->json([
        //         'message' => 'Unauthorized'], 401);
        // }
        // $user = $request->user();
        // $tokenResult = $user->createToken('Personal Access Token');
        // $token = $tokenResult->token;
        // if ($request->remember_me) {
        //     $token->expires_at = Carbon::now()->addWeeks(1);
        // }
        // $token->save();
        // return response()->json([
        //     'access_token' => $tokenResult->accessToken,
        //     'token_type' => 'Bearer',
        //     'expires_at' => Carbon::parse(
        //         $tokenResult->token->expires_at)
        //         ->toDateTimeString(),
        // ]);
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    

    
}
