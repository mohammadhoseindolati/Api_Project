<?php

namespace App\Http\Requests;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use PHPUnit\Framework\MockObject\Api;

class CreateNewInvitedUserRequest extends FormRequest
{

    use ApiResponser ;
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'marketerUserId' => 'required' ,
            'name' => 'required|max:50' ,
            'family' => 'required|max:50' ,
            'mobile' => 'required|max:50' ,
            'nationalCode' => 'required|max:10' ,
            'birthDate' => 'required' ,
            'gender' => 'in:male,female' ,
            'insuranceID' => 'required' ,
            'status' => 'required' ,

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        return $this->errorResponse($errors->messages() , 422);
    }
}
