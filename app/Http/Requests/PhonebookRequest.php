<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class PhonebookRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:phonebooks',
            'phone' => 'required',
            
        ];
       
    }

    public function messages(){

        return[
        'required' => 'O campo :attribute não pode ser vazio!',
        'name.required' => 'O contato precisa de um nome!',
        'name.min' => 'Titulo Não pode ter menos de 4 caracteres',
        'phone.required' => 'Por favor insira um numero de celular.',
        'email.required' => 'Por favor insira um email.',
        'email.email' => 'email invalido.',
        'email.unique' => 'email já consta em nosso banco de dados',
        
        ];
    }
}
