<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'required_skill_id' => ['required', 'exists:skills,id'],
            'urgency' => ['required', 'in:High,Medium,Low'], // should use the enum here
            'duration' => ['required', 'integer', 'between:1,3'],
            'required_technicians' => ['required', 'integer', 'between:1,3'],
        ];
    }
}
