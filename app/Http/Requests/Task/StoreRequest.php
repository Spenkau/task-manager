<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'numeric|min:1',
            'priority_id' => 'numeric|min:1|max:3',
            'status_id' => 'numeric|min:1|max:3',
            'user_id' => 'numeric',
            'parentId' => 'numeric',
            'started_at' => 'date_format:Y-m-d',
            'finished_at' => 'date_format:Y-m-d',
        ];
    }
}
