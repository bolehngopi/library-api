<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paging = $request->input('paging', 10);
        $genres = Genre::paginate($paging);

        if ($genres->isEmpty()) {
            return response()->json(['message' => 'No genres found'], 404);
        }

        return GenreResource::collection($genres)->additional([
            'message' => 'success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $genre = Genre::create($request->validated());

        if ($genre) {
            return (new GenreResource($genre))->additional([
                'message' => 'Genre created successfully',
            ])->response()->setStatusCode(201);
        }

        return response()->json(['message' => 'Failed to create genre'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        if ($genre) {
            return (new GenreResource($genre))->additional([
                'message' => 'success',
            ]);
        }

        return response()->json(['message' => 'Genre not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $updated = $genre->update($request->validated());

        if ($updated) {
            return (new GenreResource($genre))->additional([
                'message' => 'Genre updated successfully',
            ]);
        }

        return response()->json(['message' => 'Failed to update genre'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        if ($genre->trashed()) {
            return response()->json(['message' => 'Genre deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete genre'], 500);
    }
}
