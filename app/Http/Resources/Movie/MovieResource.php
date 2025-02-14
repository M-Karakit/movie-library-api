<?php

namespace App\Http\Resources\Movie;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'genre' => $this->genre,
            'releaseYear' => $this->release_year,
            'description' => $this->description,
            'rating' => [
                'average' => $this->ratings_avg_rating ? round($this->ratings_avg_rating, 1) : 0,
                'count' => $this->when(isset($this->ratings_count), $this->ratings_count, 0),
            ],
        ];
    }
}
