<?php

namespace App\Services\Movie;


use App\Models\Movie;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MovieService
{
    use ApiResponse;

    /**
     * Browse and filter movies with pagination
     *
     * @param array $filter Filtering options (director, genre, release_year, search)
     * @return LengthAwarePaginator
     * @throws HttpResponseException
     */
    public function browseMovies(array $filter = []): LengthAwarePaginator
    {
        try {

            return Movie::query()
                ->withAvg('ratings as ratings_avg_rating', 'rating')

                ->withCount('ratings')

                ->when(isset($filter['director']), fn($q) => $q->director($filter['director']))

                ->when(isset($filter['genre']), fn($q) => $q->genre($filter['genre']))

                ->when(isset($filter['release_year']), fn($q) => $q->releaseYear($filter['release_year']))

                ->when(isset($filter['search']), fn($q) => $q->search($filter['search']))

                ->paginate(10);

        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'error listing movies: ' . $e->getMessage(),
                500
            ));
        }
    }

    /**
     * Create a new movie record
     *
     * @param array $data Movie data (title, director, genre, release_year, description)
     * @return Movie
     * @throws HttpResponseException
     */
    public function createMovie(array $data): Movie
    {
        try {

            return Movie::create([
                'title'         => $data['title'],
                'director'      => $data['director'],
                'genre'         => $data['genre'],
                'release_year'  => $data['release_year'],
                'description'   => $data['description'] ?? null
            ]);

        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not create movie: ' . $e->getMessage(),
                500
            ));
        }
    }

    /**
     * Update an existing movie record
     *
     * @param array $data Updated movie data
     * @param Movie $movie Movie model instance
     * @return Movie
     * @throws HttpResponseException
     */
    public function updateMovie(array $data, Movie $movie): Movie
    {
        try {
            $movie->update(array_filter($data));
            return $movie;
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not update movie: ' . $e->getMessage(),
                500
            ));
        }
    }

    /**
     * Retrieve a specific movie
     *
     * @param Movie $movie Movie model instance
     * @return Movie
     * @throws HttpResponseException
     */
    public function showMovie(Movie $movie): Movie
    {
        try {
            return $movie
                ->loadAvg('ratings', 'rating')
                ->loadCount('ratings');
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not show movie: ' . $e->getMessage(),
                500
            ));
        }
    }

    /**
     * Delete a movie record
     *
     * @param Movie $movie Movie model instance
     * @return bool|null Returns true on success, null on failure
     * @throws HttpResponseException
     */
    public function deleteMovie(Movie $movie): ?bool
    {
        try {
            return $movie->delete();
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not delete movie: ' . $e->getMessage(),
                500
            ));
        }
    }
}
