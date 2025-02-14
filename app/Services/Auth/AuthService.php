<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    use ApiResponse;


    /**
     * Register a new user.
     * @param array $credentials User registration data (name, email, password)
     * @return User Created user model
     * @throws HttpResponseException If registration fails
     */
    public function register(array $credentials): User
    {
        try {
            return User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password'])
            ]);
        }catch (\Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'error during registration: ' . $e->getMessage(),
                500
            ));
        }
    }

    /**
     * Authenticate user and generate JWT token.
     * @param array $credentials Login credentials (email, password)
     * @return array Authentication data including token and user
     * @throws HttpResponseException If authentication fails
     */
    public function login(array $credentials): array
    {
        try {
            if (!$token = JWTAuth::attempt($credentials)){
                throw new HttpResponseException($this->errorResponse(
                    null,
                    'Invalid credentials',
                    401
                ));
            }

            $user = auth()->user();

            return [
                'token' => $token,
                'user' => $user,
                'token_type' => 'Bearer'
            ];
        }catch (\Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'error during login: ' . $e->getMessage(),
                500
            ));
        }
    }

    /**
     * Logout user by invalidating current token
     * @return bool Success status
     * @throws HttpResponseException If logout fails
     */
    public function logout(): bool
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return true;
        }catch (\Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'error during logout: ' . $e->getMessage(),
                500
            ));
        }
    }

    /**
     * Refresh current JWT token
     * @return string New JWT token
     * @throws HttpResponseException If token refresh fails
     */
    public function refresh(): string
    {
        try {
            return JWTAuth::refresh(JWTAuth::getToken());
        }catch (\Exception $e){
            throw new HttpResponseException($this->errorResponse(
                null,
                'error during refresh: ' . $e->getMessage(),
                500,
            ));
        }
    }
}
