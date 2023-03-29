<?php

namespace App\Http\Requests;

use App\Traits\ApiResponser;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use PHPUnit\Framework\MockObject\Api;

class UpdateInvitedUserRequset extends FormRequest
{

    use ApiResponser;
    /**
     * Determine if the user is authorized to make this request.
     */

    public function messages(): array
    {
        return [
            'status.required' => 'status is required'
        ];
    }

    public function attributes(): array
    {
        return [
            'status' => 'status',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    // protected function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'slug' => Str::slug($this->slug),
    //     ]);
    // }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,rejected,confirmed',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        return $this->errorResponse($errors->messages() , 422);
    }
}
