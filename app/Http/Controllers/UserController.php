<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required','string',
            'password' => 'required','string',
            'email' => 'required','string',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user)
        {
            return response()->json([
            'status' => false,
            'message' => 'user Already Exists',
            ], 422);
        }

        $user = User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'user created successfully',
            'data' => new UserResource($user)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->first();
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'nullable','string',
            'last_name' => 'nullable','string',
            'country' => 'nullable','string',
            'description' => 'nullable','string',
        ]);

        $user = User::where('id', $id)->first();
        $user->update($request->all());

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'Successfully Updated'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
