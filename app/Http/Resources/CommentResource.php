<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;


#[OA\Schema(
    schema: "CommentResource",
    title: "Comment",
    description: "Comment resource representation",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "content", type: "string", example: "This is a comment"),
        new OA\Property(
            property: "user",
            type: "object",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 5),
                new OA\Property(property: "name", type: "string", example: "Allan")
            ]
        )
    ]
)]
class CommentResource extends JsonResource

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
            'content' => $this->content,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
