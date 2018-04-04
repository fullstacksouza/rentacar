<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'title'      => 'required|unique:searches',
            'date_start' => 'required|date|after_or_equal:today',
            'date_end'   => 'required|date|after_or_equal:date_start'
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => "O Titulo da pesquisa é Obrigatório",
            'date_start.required'       => 'A data de inicio da pesquisa é obrigatória',
            'date_start.after_or_equal' => 'A data de inicio da pesquisa não pode ser menor que a data atual',
            'date_end.required'         => 'A data de expiração da pesquisa é obrigatória',
            'date_end.after_or_equal'   => "A data de expiração da pesquisa não pode ser menor que a data de inicio"
        ];
    }
}
