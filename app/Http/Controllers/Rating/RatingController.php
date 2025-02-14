<?php

namespace App\Http\Controllers\Rating;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rating\StoreRatingRequest;
use App\Http\Requests\Rating\UpdateRatingRequest;
use App\Http\Resources\Rating\RatingResource;
use App\Models\Movie;
use App\Models\Rating;
use App\Services\Rating\RatingService;
use App\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    use ApiResponse;

    protected RatingService $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page');
        $rating = $this->ratingService->listRatings($perPage);
        return $this->resourcePaginated(RatingResource::collection($rating));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRatingRequest $request
     * @return JsonResponse
     */
    public function store(StoreRatingRequest $request): JsonResponse
    {
        $data = $request->validated();
        $rating = $this->ratingService->createRating($data);
        return $this->successResponse(new RatingResource($rating), 'Rating created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Rating $rating
     * @return JsonResponse
     */
    public function show(Rating $rating): JsonResponse
    {
        $showRating = $this->ratingService->showRating($rating);
        return $this->successResponse(new RatingResource($showRating));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRatingRequest $request
     * @param Rating $rating
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateRatingRequest $request, Rating $rating): JsonResponse
    {
        $this->authorize('update', $rating);
        $data = $request->validated();
        $updatedRating = $this->ratingService->updateRating($data, $rating);
        return $this->successResponse(new RatingResource($updatedRating), 'Rating updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Rating $rating): JsonResponse
    {
        $this->authorize('delete', $rating);
        $this->ratingService->deleteRating($rating);
        return $this->successResponse(null, '', 204);
    }
}
