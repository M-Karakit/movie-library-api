<?php

namespace App\Policies\Rating;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RatingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rating $rating): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rating $rating): Response
    {
        if ($user->id !== $rating->user_id){
            throw new HttpResponseException(
                response()->json([
                    'status' => 'unauthorized',
                    'message' => 'You can only update your own rating.'
                ], 401)
            );
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rating $rating): Response
    {
        if ($user->id !== $rating->user_id){
            throw new HttpResponseException(
                response()->json([
                    'status' => 'unauthorized',
                    'message' => 'You can only delete your own rating.'
                ], 401)
            );
        }

        return Response::allow();
    }
}
