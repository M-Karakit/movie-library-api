<?php

namespace App\Services\Rating;

use App\Models\Rating;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Pagination\LengthAwarePaginator;

class RatingService
{
    use ApiResponse;


    /**
     * Retrieve paginated list of ratings with their associated movies.
     *
     * @return LengthAwarePaginator
     * @throws HttpResponseException
     */
    public function listRatings(): LengthAwarePaginator
    {
        try {
            return Rating::with('movie')->paginate();
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not retrieve ratings: ' . $e->getMessage(),
                500
            ));
        }
    }


    /**
     * Create a new rating
     * @param array $data Contains user_id, movie_id, rating, and optional review
     * @return Rating
     * @throws HttpResponseException
     */
    public function createRating(array $data)
    {
        try {
            return Rating::create([
                'user_id'   => $data['user_id'],
                'movie_id'  => $data['movie_id'],
                'rating'    => $data['rating'],
                'review'    => $data['review'] ?? null,
            ]);
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not create rating: ' . $e->getMessage(),
                500
            ));
        }
    }


    /**
     * Show a specific rating with its associated movie
     * @param Rating $rating
     * @return Rating
     * @throws HttpResponseException
     */
    public function showRating(Rating $rating): Rating
    {
        try {
            return $rating->load('movie');
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not show rating: ' . $e->getMessage(),
                500
            ));
        }
    }


    /**
     * Update an existing rating
     * @param array $data Updated rating data
     * @param Rating $rating Rating to update
     * @return Rating
     * @throws HttpResponseException
     */
    public function updateRating(array $data, Rating $rating): Rating
    {
        try {
            $rating->update(array_filter($data));
            return $rating;
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not update rating: ' . $e->getMessage(),
                500
            ));
        }
    }


    /**
     * Delete a rating
     * @param Rating $rating Rating to delete
     * @return bool|null
     * @throws HttpResponseException
     */
    public function deleteRating(Rating $rating): ?bool
    {
        try {
            return $rating->delete();
        }catch (Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'Could not delete rating: ' . $e->getMessage(),
                500
            ));
        }
    }
}
