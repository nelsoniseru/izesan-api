<?php

namespace App\Http\Controllers\Auth\Login;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\LoginController;

class UserController extends LoginController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required','string',
            'password' => 'required','string'
        ]);

        // $credentials = request(['email', 'password']);
        $User = User::where('email',$request->email)->first();
        if ($User) {
            $password = Hash::check($request->password, $User->password);
            if ($password) {
                $tokenResult = $User->createToken('Personal Access Token');
                $data = [
                    'id' => $User->id,
                    'name' => $User->first_name,
                    'token' => $tokenResult
                ];
                return response()->json([
                    'status' => true,
                    'message' => 'Login succesful',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Password'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Check supplied data and try again'
            ]);
        }
    }
}
