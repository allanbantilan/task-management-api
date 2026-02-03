<?php

namespace App\Http\Requests;

use App\Models\Task;
use OpenApi\Attributes as OA;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

#[OA\Schema(
    schema: "CommentRequestSchema",
    title: "Comment Request",
    properties: [
        new OA\Property(property: "task_id", type: "integer", example: 5),
        new OA\Property(property: "content", type: "string", example: "This is a comment")
    ]
)]
class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'content' => 'required|string|max:1000',
        ];

        // task_id is only required for creating new comments
        if ($this->isMethod('post')) {
            $rules['task_id'] = [
                'required',
                Rule::exists(Task::class, 'id')->where(function ($query) {
                    $query->where('user_id', $this->user()->id);
                }),
            ];
        }

        return $rules;
    }
}
