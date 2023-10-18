<?php

namespace App\Http\Requests\Task;

use Carbon\Carbon;
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
            'category_id' => 'required|numeric|min:1',
            'priority_id' => 'required|numeric|min:1|max:3',
            'status_id' => 'numeric|min:1|max:3',
//            'user_id' => 'numeric|min:1',
            'parentId' => 'numeric|min:1',
            'started_at' => 'required',
            'finished_at' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => trim($this->title),
            'task_content' => trim($this->task_content),
        ]);
    }

//    public function convertDateFormat($date)
//    {
//        $date = Carbon::createFromDate();
//    }
}
