<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'task.id' => 'integer',
            'task.title' => 'required|string|max:255',
            'task.content' => 'required|string|max:400',
            'task.category_id' => 'required|integer|min:1',
            'task.priority_id' => 'required|integer|min:1|max:3',
//            'task.status_id' => 'nullable|integer|min:0|max:3',
            'task.started_at' => 'nullable|date',
            'task.finished_at' => 'nullable|date',
            'task.parent_id' => 'nullable|integer',
            'tags' => 'nullable|array',
        ];
     }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => trim($this->title),
            'content' => trim($this->content),
        ]);
    }
}
