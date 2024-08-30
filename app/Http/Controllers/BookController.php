<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paging = $request->input('paging', 10);
        $books = Book::with(['author', 'genre', 'publisher']) // Eager load relationships
            ->paginate($paging);

        if ($books->isEmpty()) {
            return response()->json(['message' => 'No books found'], 404);
        }

        return BookResource::collection($books)->additional([
            'message' => 'success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        if ($book) {
            return (new BookResource($book))->additional([
                'message' => 'Book created successfully',
            ])->response()->setStatusCode(201);
        }

        return response()->json(['message' => 'Failed to create book'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if ($book) {
            return (new BookResource($book))->additional([
                'message' => 'success',
            ]);
        }

        return response()->json(['message' => 'Book not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $updated = $book->update($request->validated());

        if ($updated) {
            return (new BookResource($book))->additional([
                'message' => 'Book updated successfully',
            ]);
        }

        return response()->json(['message' => 'Failed to update book'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        if ($book->trashed()) {
            return response()->json(['message' => 'Book deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete book'], 500);
    }

    /**
     * Search books by keyword.
     */
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|min:1',
        ]);

        $keyword = $request->input('keyword');

        $books = Book::with(['author', 'genre', 'publisher']) // Eager load relationships
            ->where('title', 'like', "%$keyword%")
            ->orWhereHas('author', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->paginate(10);

        if ($books->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return BookResource::collection($books)->additional([
            'message' => 'success',
        ]);
    }
}
