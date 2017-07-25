<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CheckKeywordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            //
        ];
    }
}
