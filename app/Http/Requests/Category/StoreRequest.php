<?php

namespace App\Http\Requests\Category;

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
            'name' => 'required|max:81',
            'parent_id' => 'numeric|min:0',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this['name']),
            'parent_id' => $this['parent_id'] ?? null

        ]);
    }
}
