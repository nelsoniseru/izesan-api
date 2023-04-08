<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return AuthorResource::collection($authors);
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
            'first_name' => 'required','string',
            'last_name' => 'required','string',
            'country' => 'required','string',
            'password' => 'required','string',
            'email' => 'required','string',
            'description' => 'required','string',
        ]);
        
        $author = Author::where('email', $request->email)->first();
        if($author)
        {
            return response()->json([
            'status' => false,
            'message' => 'Author Already Exists',
            ], 422);
        }

        $author = Author::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'country' => $request->country,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Author created successfully',
            'data' => new AuthorResource($author)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::where('id', $id)->first();
        return new AuthorResource($author);
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

        $author = Author::where('id', $id)->first();
        $author->update($request->all());

        return response()->json([
            'status' => true,
            'data' => $author,
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
