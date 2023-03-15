<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateNewInvitedUserRequest extends FormRequest
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
            'gender' => 'required' ,
            'insuranceID' => 'required' ,
            'registerDate' => 'required' ,
            'status' => 'required' ,

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
