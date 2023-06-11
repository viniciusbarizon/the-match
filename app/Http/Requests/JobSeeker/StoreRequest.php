<?php

namespace App\Http\Requests\JobSeeker;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'bail|required|integer|max:16777215|min:1',
            'contract_id' => 'bail|required|ulid',
            'currency_id' => 'bail|required|ulid',
            'email' => 'bail|required|max:255|email|unique:job_seekers',
            'name' => 'bail|required|string|max:255',
            'slug' => 'bail|required|string|max:255',
            'url' => 'bail|required|string|max:255|url',
        ];
    }
}
