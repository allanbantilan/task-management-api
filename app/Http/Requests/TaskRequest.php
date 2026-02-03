<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use App\Enums\PriorityEnum;
use OpenApi\Attributes as OA;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

#[OA\Schema(
    schema: "TaskRequest",
    title: "Task Request",
    description: "Fields for creating or updating a task",
    required: ["title", "description"],
    properties: [
        new OA\Property(property: "title", type: "string", example: "Finish Laravel API"),
        new OA\Property(property: "description", type: "string", example: "Complete task management endpoints"),
        new OA\Property(property: "status", type: "string", example: "pending"),
        new OA\Property(property: "priority", type: "string", example: "medium"),
        new OA\Property(property: "category_id", type: "integer", example: 1)
    ]
)]
class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', new Enum(TaskStatus::class)],
            'priority' => ['required', new Enum(PriorityEnum::class)],
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
}
