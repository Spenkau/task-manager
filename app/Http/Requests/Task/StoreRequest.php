<?php

namespace App\Http\Requests\Task;

use Carbon\Carbon;
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
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required',
            'priority_id' => 'required',
            'status_id' => 'required',
            'owner_id' => 'required',
            'started_at' => '',
            'finished_at' => '',
            'parent_id' => 'nullable',
            'tag' => ''
        ];
    }

    protected function prepareForValidation()
    {
        $user = Auth::user();

        $this->merge([
            'title' => trim($this['title']),
            'content' => trim($this['content']),
            'owner_id' => $this['owner_id'] ?? $user['id']
        ]);
    }

//    public function convertDateFormat($date)
//    {
//        $date = Carbon::createFromDate();
//    }
}
