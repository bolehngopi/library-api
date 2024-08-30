<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Http\Resources\PublisherResource;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paging = $request->input('paging', 10);
        $publishers = Publisher::paginate($paging);

        if ($publishers->isEmpty()) {
            return response()->json(['message' => 'No publishers found'], 404);
        }

        return PublisherResource::collection($publishers)->additional([
            'message' => 'success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublisherRequest $request)
    {
        $publisher = Publisher::create($request->validated());

        if ($publisher) {
            return (new PublisherResource($publisher))->additional([
                'message' => 'Publisher created successfully',
            ])->response()->setStatusCode(201);
        }

        return response()->json(['message' => 'Failed to create publisher'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        if ($publisher) {
            return (new PublisherResource($publisher))->additional([
                'message' => 'success',
            ]);
        }

        return response()->json(['message' => 'Publisher not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        $updated = $publisher->update($request->validated());

        if ($updated) {
            return (new PublisherResource($publisher))->additional([
                'message' => 'Publisher updated successfully',
            ]);
        }

        return response()->json(['message' => 'Failed to update publisher'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        if ($publisher->trashed()) {
            return response()->json(['message' => 'Publisher deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete publisher'], 500);
    }
}
