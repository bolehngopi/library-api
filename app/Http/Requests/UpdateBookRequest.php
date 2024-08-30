<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'sometimes|string',
            'cover_url' => 'sometimes|url',
            'description' => 'sometimes|string',
            'author_id' => 'sometimes|exists:authors,id',
            'pages' => 'sometimes|integer',
            'publication_year' => 'sometimes|integer',
            'publisher_id' => 'sometimes|exists:publishers,id',
            'genre_id' => 'sometimes|exists:genres,id',
            'stock' => 'sometimes|integer',
            'active' => 'sometimes|boolean',
            'ISBN' => 'sometimes|string',
        ];
    }
}
