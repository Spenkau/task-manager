<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'task.title' => 'required|string',
            'task.content' => 'required|string',
            'task.category_id' => 'required|integer',
            'task.priority_id' => 'required|integer',
            'task.status_id' => 'required|integer',
            'task.started_at' => 'nullable|date',
            'task.finished_at' => 'nullable|date',
            'task.parent_id' => 'nullable|integer',
            'tags' => 'nullable|array',
        ];
    }

    protected function prepareForValidation()
    {
        $user = Auth::user();

        $this->merge([
            'title' => trim($this['title']),
            'content' => trim($this['content']),
            'category_id' => (int) $this['category_id'],
            'priority_id' => (int) $this['priority_id'],
            'status_id' => (int) $this['status_id'],
            'owner_id' => (int) $this['owner_id'] ?? $user['id']
        ]);
    }

//    public function convertDateFormat($date)
//    {
//        $date = Carbon::createFromDate();
//    }
}
