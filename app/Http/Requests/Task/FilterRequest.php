<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'title' => 'nullable|string',
            'category_id' => 'nullable|int',
            'priority_id' => 'nullable|int',
            'status_id' => 'nullable|int',
            'tags_id' => 'array',
            'archived' => 'nullable|boolean'
        ];
    }

    public function attributes()
    {
        return [
            'archived' => false,
        ];
    }
}
