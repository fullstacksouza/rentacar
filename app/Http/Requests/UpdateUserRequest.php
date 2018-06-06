<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
             'email' =>'nullable|email',
             'rg' => 'required|max:11|min:10|numeric',
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
             'rg.required'=>"O campo rg é obrigatório",
             'rg.min'=>"Digite um rg válido",
             'rg.max'=>"Digite um rg válido",
             'rg.numeric'=>"Digite um rg válido",
             'role.required'=> 'O campo perfil é obrigatório',
             'dob.required'=> 'O campo data de nascimento é obrigatório',
             'registration.required'=> 'O campo matricula é obrigatório',
         ];
     }
}
