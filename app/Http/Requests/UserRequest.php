<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'required|min:8',
            'token' => '',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'É preciso informar um nome para se cadastrar',
            'email.required' => 'É preciso informar um e-mail para efetuar o cadastro',
            'email.email' => 'É preciso informar um e-mail válido para efetuar o cadastro',
            'email.unique' => 'E-mail ja cadastrado no sistema',
            'password.required' => 'É preciso informar uma senha',
            'password.min' => 'É preciso informar uma senha com no minímo 8 caracteres',
            'password.same:password_confirmation' => 'A senha precisa ser igual a confirmação de senha. Por favor verifique.'
        ];
    }
}
