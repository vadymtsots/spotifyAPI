<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Artist extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'spotify_id',
        'followers',
        'popularity',
        'genres',
        'url'
    ];

    protected $casts = [
        'genres' => 'array'
    ];

    #[SearchUsingFullText(['genres'])]
    public function toSearchableArray()
    {
        return [
            'genres' => $this->genres,
        ];
    }
}
