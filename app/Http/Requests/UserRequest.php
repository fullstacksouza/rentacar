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
    public function rules()
    {
        return [
            'name' => 'required',
            'email' =>'nullable|email|unique:users',
            'rg' => 'required|max:11',
            'registration'=>'required',
            'sector'=>'required',
            'role' =>'required',
            'dob' =>'required'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo nome é obrigatório",
            'email.email'=>"Digite um email válido",
            'email.unique'=>"Este email já está sendo ultilizado",
            'rg.required'=>"O campo rg é obrigatório",
            'sector.required'=>"O campo setor é obrigatório",
            'role.required'=> 'O campo perfil é obrigatório',
            'dob.required'=> 'O campo data de nascimento é obrigatório',
            'registration.required'=> 'O campo matricula é obrigatório',
        ];
    }
}
