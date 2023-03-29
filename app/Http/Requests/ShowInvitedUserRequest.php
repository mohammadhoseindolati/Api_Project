<?php

namespace App\Http\Requests;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShowInvitedUserRequest extends FormRequest
{
    use ApiResponser ;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function attributes(): array
    {
        return [
            'count_of_users' => 'user s count',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'count_of_users' => 'nullable|integer|in:100,1000,10000,100000',
            'show_per_page' => 'nullable|integer|in:10,20,30,40,50',
            'page' => 'nullable|integer',
            'family' => 'nullable|string',
            'national_code' => 'nullable|integer|between:1,10',
            'mobile' => 'nullable|string',
            'status' => 'nullable|string',
            'register_date' => 'nullable|string'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'count_of_users' => $this->count_of_users ? $this->count_of_users : 1000,
            'show_per_page' => $this->show_per_page ? $this->show_per_page : 10,
            'page' => $this->page ? $this->page : 1,
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        return $this->errorResponse($errors->messages() , 422);
    }
}
