<?php

namespace App\Http\Requests\JobSeeker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'contract_id' => 'bail|required|ulid',
            'currency_id' => 'bail|required|ulid',
            'email' => 'bail|required|max:255|email|unique:job_seekers',
            'name' => 'bail|required|string|max:255',
            'salary' => 'bail|required|integer|max:16777215|min:1',
            'slug' => 'bail|required|string|max:255',
            'url' => 'bail|required|string|max:255|url',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $this->validateSessionMissingEmail($validator);
            }
        ];
    }

    private function validateSessionMissingEmail(Validator $validator): void
    {
        if (session()->has('email') && session()->has('is_email_verified')) {
            return;
        }

        $validator->errors()->add(
            'email',
            __('O e-mail precisa ser verificado.')
        );
    }
}
