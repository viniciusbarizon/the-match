<?php

namespace App\Http\Requests\JobSeeker;

use App\Rules\EmailEqualsSession;
use App\Rules\EmailVerify;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'contract_id' => ['bail', 'required', 'ulid'],
            'currency_id' => ['bail', 'required', 'ulid'],
            'email' => ['bail', 'required', 'max:255', 'email', 'unique:job_seekers', new EmailVerify, new EmailEqualsSession],
            'name' => ['bail', 'required', 'string', 'max:255'],
            'salary' => ['bail', 'required', 'integer', 'max:16777215' , 'min:1'],
            'slug' => ['bail', 'required', 'string', 'max:255', 'lowercase'],
            'url' => ['bail', 'required', 'string', 'max:255', 'lowercase', 'url'],
        ];
    }
}
