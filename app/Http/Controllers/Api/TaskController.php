<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

#[OA\Tag(
    name: "Tasks",
    description: "Endpoints for managing tasks"
)]
class TaskController extends Controller
{
    #[OA\Get(
        path: "/api/tasks",
        summary: "List all tasks for authenticated user",
        tags: ["Tasks"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "page",
                in: "query",
                description: "Page number",
                required: false,
                schema: new OA\Schema(type: "integer", example: 1)
            ),
            new OA\Parameter(
                name: "per_page",
                in: "query",
                description: "Number of items per page",
                required: false,
                schema: new OA\Schema(type: "integer", example: 10)
            ),
            new OA\Parameter(
                name: "status",
                in: "query",
                description: "Filter tasks by status",
                required: false,
                schema: new OA\Schema(
                    type: "string",
                    enum: ["pending", "in_progress", "completed"],
                    example: "pending"
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Paginated list of tasks",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(ref: "#/components/schemas/TaskResource")
                        ),
                        new OA\Property(
                            property: "meta",
                            type: "object",
                            properties: [
                                new OA\Property(property: "current_page", type: "integer", example: 1),
                                new OA\Property(property: "last_page", type: "integer", example: 5),
                                new OA\Property(property: "per_page", type: "integer", example: 10),
                                new OA\Property(property: "total", type: "integer", example: 42),
                            ]
                        ),
                        new OA\Property(
                            property: "links",
                            type: "object",
                            properties: [
                                new OA\Property(property: "next", type: "string", nullable: true),
                                new OA\Property(property: "prev", type: "string", nullable: true),
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $tasks = $request->user()
            ->tasks()
            ->with(['comments', 'category'])
            ->when($request->has('status'), function ($query) use ($request) {
                $query->where('status', $request->query('status'));
            })
            ->when($request->has('priority'), function ($query) use ($request) {
                $query->where('priority', $request->query('priority'));
            })
            ->when($request->has('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->query('category_id'));
            })
            ->orderBy($request->query('sort_by', 'created_at'), $request->query('sort_order', 'desc'))
            ->paginate($perPage);

        return TaskResource::collection($tasks);
    }

    #[OA\Get(
        path: "/api/tasks/{id}",
        summary: "Get a single task by ID",
        tags: ["Tasks"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Task ID",
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Task details",
                content: new OA\JsonContent(ref: "#/components/schemas/TaskResource")
            ),
            new OA\Response(response: 404, description: "Task not found")
        ]
    )]
    public function show(Request $request, $id)
    {
        try {
            $task = $request->user()->tasks()->with(['comments.user', 'category'])->findOrFail($id);
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found'], 404);
        };
    }

    #[OA\Post(
        path: "/api/tasks",
        summary: "Create a new task",
        tags: ["Tasks"],
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/TaskRequest")
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Created task",
                content: new OA\JsonContent(ref: "#/components/schemas/TaskResource")
            ),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function store(TaskRequest $request)
    {
        $task = $request->user()->tasks()->create($request->validated());
        return new TaskResource($task);
    }

    #[OA\Put(
        path: "/api/tasks/{id}",
        summary: "Update an existing task",
        tags: ["Tasks"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/TaskRequest")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Updated task",
                content: new OA\JsonContent(ref: "#/components/schemas/TaskResource")
            ),
            new OA\Response(response: 404, description: "Task not found"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function update(TaskRequest $request, $id)
    {
        try {
            $task = $request->user()->tasks()->findOrFail($id);
            $task->update($request->validated());
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

    #[OA\Delete(
        path: "/api/tasks/{id}",
        summary: "Delete a task",
        tags: ["Tasks"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Task deleted successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Task deleted successfully")
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Task not found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Task not found")
                    ]
                )
            )
        ]
    )]
    public function destroy(Request $request, $id)
    {
        try {
            $task = $request->user()->tasks()->findOrFail($id);
            $task->delete();

            return response()->json([
                'message' => 'Task deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }
    }
}
