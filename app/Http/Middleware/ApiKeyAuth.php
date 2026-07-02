<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     * Authenticate using API key from query parameter or header.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get API key from query parameter or header
        $apiKey = $request->query('api_key') ?? $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'API Key is required. Provide it via query parameter (api_key) or header (X-API-Key).'
            ], 401);
        }

        // Find the token using Sanctum's PersonalAccessToken model
        $accessToken = PersonalAccessToken::findToken($apiKey);

        if (!$accessToken) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API Key.'
            ], 401);
        }

        // Authenticate the user
        auth()->setUser($accessToken->tokenable);

        return $next($request);
    }
}
