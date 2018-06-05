<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectorRequest extends FormRequest
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
            "name" => "required|unique:sectors",
            "responsible_email" => "required|email"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo nome é obrigatório",
            'name.unique' => "Este setor já está cadastrado",
            'responsivle_email.email' => "Digite um email válido",
            'responsible_email.required' => "O campo email do responsavel é obrigatório"

        ];
    }
}
