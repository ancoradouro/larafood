<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePlan extends FormRequest
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
        $url = $this->segment(3);
        return [
            'name' => 'required|min:3|max:255|unique:plans,name,{$url},url',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'description' => 'required|min:3|max:255,description',            
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
            'name' => 'Nome',
            'price' => 'Preço',
            'description' => 'Descrição'
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
            'name.required' => ':attribute é um campo obrigatório.',
            'price.required' => ':attribute é obrigatório.',
            'price.regex' => ':attribute deve ser um número.',
            'description.required' => 'Informe a :attribute.',
            'description.min' => ':attribute deve ter no minimo 3 caracteres.',
        ];
    }

}
