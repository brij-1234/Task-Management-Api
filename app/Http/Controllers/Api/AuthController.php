<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Helpers\ApiResponse;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /** 
     * Register User
     */
    public function register(RegisterRequest $request) : JsonResponse
    {  
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'password' => $request->password, // it auto has because of the cast in User model 
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return ApiResponse::success('User registered successfully', [
                'access_token' => $token,
                'user' => new UserResource($user),
            ], 201);
        } catch (\Exception $e){
            return ApiResponse::error('Failed to register user', $e->getMessage(), 500);
        }
    }
    /**
     * Login User
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try{
            $validated = $request->validated();
            if (!Auth::attempt($validated)) {
                return ApiResponse::error('Invalid credentials', null, 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return ApiResponse::success('Login successful', [
                'token' => $token,
                'user' => new UserResource($user),
            ], 200);
        } catch( \Exception $e){
            return ApiResponse::error('Failed to login', $e->getMessage(), 500);
        }
    }

    /**
     * Logout User
     */
    public function logout(Request $request): JsonResponse
    {
        try{
            $request->user()->currentAccessToken()->delete();
            return ApiResponse::success('Logout successful', null, 200);
        } catch( \Exception $e){
            return ApiResponse::error('Failed to logout', $e->getMessage(), 500);
        }
    }
}
