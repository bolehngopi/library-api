<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'cover_url' => 'url',
            'description' => 'string',
            'author_id' => 'exists:authors,id',
            'pages' => 'integer',
            'publication_year' => 'integer',
            'publisher_id' => 'exists:publishers,id',
            'genre_id' => 'exists:genres,id',
            'stock' => 'integer',
            'active' => 'boolean',
            'ISBN' => 'string',
        ];
    }
}
