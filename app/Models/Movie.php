<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = ['title', 'director', 'genre', 'release_year', 'description'];

    protected $casts = [
        'release_year' => 'integer'
    ];


    /**
     * Get all ratings associated with this movie.
     *
     * @return HasMany Relationship with Rating model
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }


    /**
     * Filter movies by director.
     *
     * @param Builder $query
     * @param string $director
     * @return Builder
     */
    public function scopeDirector(Builder $query, string $director): Builder
    {
        return $query->where('director', $director);
    }


    /**
     * Filter movies by genre.
     *
     * @param Builder $query
     * @param string $genre
     * @return Builder
     */
    public function scopeGenre(Builder $query, string $genre): Builder
    {
        return $query->where('genre', $genre);
    }


    /**
     * Filter movies by release year.
     *
     * @param Builder $query
     * @param int $releaseYear
     * @return Builder
     */
    public function scopeReleaseYear(Builder $query, int $releaseYear): Builder
    {
        return $query->where('release_year', $releaseYear);
    }


    /**
     * Search movies by title.
     *
     * @param Builder $query
     * @param string|null $term Search term
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function ($query) use ($term){
            $query->where(function ($q) use ($term){
                $q->where('title', 'LIKE', "%{$term}%");
            });
        });
    }
}
