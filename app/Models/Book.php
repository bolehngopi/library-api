<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover_url',
        'description',
        'author_id',
        'pages',
        'publication_year',
        'publisher_id',
        'genre_id',
        'stock',
        'active',
        'isbn',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'stock' => 'integer',
        'active' => 'boolean',
        'isbn' => 'integer',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function borrowedBy()
    {
        return $this->hasOne(User::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}
