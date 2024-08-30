<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'cover_url' => $this->cover_url,
            'description' => $this->description,
            'author' => $this->author ? [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ] : null,
            'pages' => $this->pages,
            'publication_year' => $this->publication_year,
            'publisher' => $this->publisher ? [
                'id' => $this->publisher->id,
                'name' => $this->publisher->name,
            ] : null,
            'genre' => $this->genre ? [
                'id' => $this->genre->id,
                'name' => $this->genre->name,
            ] : null,
            'stock' => $this->stock,
            'active' => $this->active,
            'ISBN' => $this->ISBN,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
