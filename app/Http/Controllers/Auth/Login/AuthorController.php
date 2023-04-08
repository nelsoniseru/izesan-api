<?php

namespace App\Http\Controllers\Auth\Login;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\LoginController;

class AuthorController extends LoginController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required','string',
            'password' => 'required','string'
        ]);

        // $credentials = request(['email', 'password']);
        $author = Author::where('email',$request->email)->first();
        if ($author) {
            $password = Hash::check($request->password, $author->password);
            if ($password) {
                $tokenResult = $author->createToken('Personal Access Token');
                $data = [
                    'id' => $author->id,
                    'name' => $author->first_name,
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
