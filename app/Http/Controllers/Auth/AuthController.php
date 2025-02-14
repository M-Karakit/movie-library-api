<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;
    public AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handles user registration.
     * Takes validated registration data through RegisterRequest.
     * Passes credentials to AuthService for user creation.
     * Returns JSON response with created user data and success message.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $user = $this->authService->register($credentials);
        return $this->successResponse($user, 'User registered successfully');
    }

    /**
     * Handles user authentication.
     * Validates login credentials through LoginRequest.
     * Uses AuthService to authenticate user.
     * Returns JSON response with user data and authentication token.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $user = $this->authService->login($credentials);
        return $this->successResponse($user, 'User logged in successfully');
    }

    /**
     * Refreshes the authentication token.
     * Returns new token in JSON response.
     * Typically used with JWT authentication.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $newToken = $this->authService->refresh();
        return $this->successResponse($newToken);
    }

    /**
     * Handles user logout.
     * Invalidates current authentication token.
     * Clears user session.
     * Returns empty response with 204 status code (No Content).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return $this->successResponse(null,'',204);
    }

    /**
     * Returns currently authenticated user.
     * Returns null if no user is authenticated.
     * Returns user model implementing Authenticate interface.
     *
     * @return Authenticatable|null
     */
    public function current(): ?Authenticatable
    {
        return auth()->user();
    }
}
