<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class LoginController extends Controller
{
    #[OA\Post(
        path: "/api/login",
        summary: "Login user and get access token",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["email", "password"],
                properties: [
                    new OA\Property(property: "email", type: "string", format: "email", example: "user@example.com"),
                    new OA\Property(property: "password", type: "string", format: "password", example: "password123")
                ]
            )
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Successful login",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "access_token", type: "string", example: "1|abc123..."),
                        new OA\Property(property: "token_type", type: "string", example: "Bearer")
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Unauthorized",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Unauthorized")
                    ]
                )
            )
        ]
    )]
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['message' => 'Invalid email or password. Please check your credentials and try again.'], 401);
    }
}
