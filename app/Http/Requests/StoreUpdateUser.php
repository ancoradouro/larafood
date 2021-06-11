<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUpdateUser extends FormRequest
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
        $email = $this->segment(3);
        
        return [
            'password' => 'required|string',
            'name' => 'required|string|max:255',
            //'cnpj' => 'required|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\\-\d{2}$/'
            //'email' => 'required|string|email|max:255|unique:users,{$email},id',
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
