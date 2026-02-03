<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: "Comments",
    description: "Endpoints for managing comments"
)]
class CommentController extends Controller
{
    #[OA\Post(
        path: "/api/comments",
        summary: "Create a comment for a task",
        tags: ["Comments"],
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/CommentRequestSchema"
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Created comment",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "task_id", type: "integer", example: 5),
                        new OA\Property(property: "content", type: "string", example: "This is my comment"),
                        new OA\Property(
                            property: "user",
                            type: "object",
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "name", type: "string", example: "Allan")
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
    public function store(CommentRequest $request)
    {
        $task = $request->user()->tasks()->find($request->input('task_id'));

        if (!$task) {
            return response()->json([
                'message' => 'You can only comment on your own tasks.'
            ], 403);
        }
        $comment = $request->user()->comments()->create($request->validated());


        $comment->load('user');

        return new CommentResource($comment);
    }


    #[OA\Put(
        path: "/api/comments/{id}",
        summary: "Update a comment",
        tags: ["Comments"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID of the comment to update",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["content"],
                properties: [
                    new OA\Property(property: "content", type: "string", example: "Updated comment content")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Updated comment",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "task_id", type: "integer", example: 5),
                        new OA\Property(property: "content", type: "string", example: "Updated comment content"),
                        new OA\Property(
                            property: "user",
                            type: "object",
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 1),
                                new OA\Property(property: "name", type: "string", example: "Allan")
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Comment not found"
            ),
            new OA\Response(
                response: 422,
                description: "Validation error"
            )
        ]
    )]
    public function update(CommentRequest $request, $id)
    {
        try {
            $comment = $request->user()->comments()->find($id);

            if (!$comment) {
                return response()->json([
                    'message' => 'You can only edit on your own comment.'
                ], 403);
            }

            $comment->update([
                'content' => $request->input('content'),
            ]);

            $comment->load('user');

            return new CommentResource($comment);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }
}
