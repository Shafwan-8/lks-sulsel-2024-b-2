<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        
        $tervalidasi = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($tervalidasi->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'data' => $tervalidasi->errors()
            ], 201);
        }
        else
        {
            $data = $tervalidasi->validated();

            if(Auth::attempt($data))
            {
                $token = $request->user()->createToken('token')->plainTextToken;
    
                return response()->json([
                    'status' => true,
                    'message' => 'success login',
                    'token' => $token
                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => 'email or password does not match our record',
                    'token' => null
                ], 201);
            }
        }
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'success logout',
            'token' => null
        ], 200);
    }
}
