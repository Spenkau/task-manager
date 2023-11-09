<?php

namespace App\Http\Requests\Task;

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
            'owner_id' => 'numeric',
            'parentId' => 'numeric',
            'started_at' => 'date_format:Y-m-d',
            'finished_at' => 'date_format:Y-m-d',
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
