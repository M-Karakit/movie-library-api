<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{

    /**
     * Mass assignable attributes
     * @var array
     */
    protected $fillable = ['user_id', 'movie_id', 'rating', 'review'];


    /**
     * Get the movie associated with this rating
     * @return BelongsTo
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }


    /**
     * Get the user who created this rating
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
