<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'new_pass_confirmation' =>'required',
            'new_pass' => 'required|confirmed',
            
        ];
    }

    public function messages()
    {
        return [
            'new_pass.required'=>"Por favor Digite uma Senha",
            'new_pass.confirmed' => "As senhas não conferem"
        ];
    }
}
