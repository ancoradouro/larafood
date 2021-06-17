<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTable extends FormRequest
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
        $id = $this->segment(3);
        return [
            'identify' => ['required', 'min:3', 'max:255', "unique:tables,identify,{$id},id"],
            'description' => ['required', 'min:3', 'max:10000'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'identify' => 'Identificação',
            'description' => 'Descrição',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'identify.required' => ':attribute é um campo obrigatório.',
            'identify.max' => 'O :attribute deve ter no máximo 255 caracteres.',
            'identify.min' => ':attribute deve ter no minimo 3 caracteres.',
            'description.max' => 'O :attribute deve ter no máximo 10000 caracteres.',
            'description.min' => ':attribute deve ter no minimo 3 caracteres.',
        ];
    }
}
