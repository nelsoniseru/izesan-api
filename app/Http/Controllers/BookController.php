<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books);
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
        $author = $request->user();
        $request->validate([
            'name' => 'required','string',
        ]);

        $book = Book::create([
            'name' => $request->name,
            'isbn' => uniqid('ISBN'),
            'author_id' => $author->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Book uploaded successfully',
            'data' => $book
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::where('id', $id)->first();
        return new BookResource($book);
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
                'name' => 'required','string'
            ]);

            $book = Book::where('id', $id)->first();
            $book->update($request->all());

            return response()->json([
                'status' => true,
                'data' => $book,
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
