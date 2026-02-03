<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Illuminate\Http\Resources\Json\JsonResource;

#[OA\Schema(
    schema: "TaskResource",
    title: "Task",
    description: "Task resource representation",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "title", type: "string", example: "Finish Laravel API"),
        new OA\Property(property: "description", type: "string", example: "Complete task management endpoints"),
        new OA\Property(property: "status", type: "string", example: "pending")
    ]
)]
class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->value,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
