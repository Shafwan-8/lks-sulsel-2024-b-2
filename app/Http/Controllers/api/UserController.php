<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function create(Request $request) {
        
        $tervalidasi = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            'token' => 'nullable',
            'role_id' => 'required',
        ]);
        
        if($tervalidasi->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'failed',
                'message' => $tervalidasi->errors()
            ], 201);
        }
        else
        {
            $data = $tervalidasi->validated();

            User::create($data);

            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => $data,
            ], 200);
        }


    }
}
