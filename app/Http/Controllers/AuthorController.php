<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paging = $request->input('paging', 10);
        $authors = Author::paginate($paging);
        // If you want to eager load relationships like 'books', uncomment the line below:
        // $authors = Author::with('books')->paginate($paging);

        if ($authors->isEmpty()) {
            return response()->json(['message' => 'No authors found'], 404);
        }

        return AuthorResource::collection($authors)->additional([
            'message' => 'success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return (new AuthorResource($author))->additional([
            'message' => 'Author created successfully',
        ])->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return (new AuthorResource($author))->additional([
            'message' => 'success',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return (new AuthorResource($author))->additional([
            'message' => 'Author updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(['message' => 'Author deleted successfully'], 200);
    }
}
