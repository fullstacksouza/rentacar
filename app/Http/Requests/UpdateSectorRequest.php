<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectorRequest extends FormRequest
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
             'responsible_email' =>'email|required'

         ];
     }

     public function messages()
     {
         return [
             'name.required' => "O campo nome é obrigatório",
             'email.email'=>"Digite um email válido",
             'responsible_email.email' => "Digite um email valido",
             'responsible_email.required'=>"O campo email nao pode ser vazio"
         ];
     }
}
