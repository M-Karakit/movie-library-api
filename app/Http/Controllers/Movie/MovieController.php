<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Http\Resources\Movie\MovieResource;
use App\Models\Movie;
use App\Services\Movie\MovieService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    use ApiResponse;

    protected MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $filters = [
            'per_page' => $request->input('per_page'),
            'title' => $request->input('title'),
            'director' => $request->input('director'),
            'genre' => $request->input('genre'),
            'release_year' => $request->input('release_year'),
            'search' => $request->input('search')
        ];

        $movies = $this->movieService->browseMovies($filters);
        return $this->resourcePaginated(MovieResource::collection($movies));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMovieRequest $request
     * @return JsonResponse
     */
    public function store(StoreMovieRequest $request):JsonResponse
    {
        $data = $request->validated();
        $movie = $this->movieService->createMovie($data);
        return $this->successResponse(new MovieResource($movie), 'Movie created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return JsonResponse
     */
    public function show(Movie $movie): JsonResponse
    {
        $showMovie = $this->movieService->showMovie($movie);
        return $this->successResponse(new MovieResource($showMovie));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMovieRequest $request
     * @param Movie $movie
     * @return JsonResponse
     */
    public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
    {
        $data = $request->validated();
        $updatedMovie = $this->movieService->updateMovie($data, $movie);
        return $this->successResponse(new MovieResource($updatedMovie), 'Movie updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return JsonResponse
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $this->movieService->deleteMovie($movie);
        return $this->successResponse(null,'',204);
    }
}
