<?php

namespace App\Http\Resources\Rating;

use App\Http\Resources\Movie\MovieResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this['user_id'],
            'movie_id' => $this['movie_id'],
            'rating' => $this['rating'],
            'review' => $this['review'],
            'movie' => new MovieResource($this->whenLoaded('movie')),
        ];
    }
}
