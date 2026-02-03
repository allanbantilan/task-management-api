<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Task Management API",
    description: "API documentation for Task Management Application",
    contact: new OA\Contact(email: "admin@example.com")
)]
#[OA\Server(
    url: "http://localhost:8000",
    description: "Local Development Server"
)]
#[OA\SecurityScheme(
    securityScheme: "sanctum",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT",
    description: "Enter token in format: Bearer {token}"
)]
#[OA\Tag(
    name: "Auth",
    description: "Authentication endpoints"
)]
abstract class Controller
{
    //
}
