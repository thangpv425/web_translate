<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRegistrationRequest extends FormRequest
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
            'password'=>'required|min:6|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required|min:6|max:32|same:password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'first_name' => 'required|max:32|regex:/^[a-zA-Z \d]+$/',
            'last_name' => 'required|max:32|regex:/^[a-zA-Z \d]+$/',
            //
        ];
    }
}
