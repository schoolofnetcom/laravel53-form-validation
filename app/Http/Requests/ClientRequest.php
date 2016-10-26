<?php

namespace App\Http\Requests;

use App\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $pessoa = Client::getPessoa($this->get('pessoa'));
        $documentType = $pessoa == Client::PESSOA_FISICA ? 'cpf' : 'cnpj';
        $id = $this->route('client');
        $rules = [
            'nome' => 'required|max:100',
            'documento' => "required|documento:$documentType|unique:clients,documento,$id",
            'email' => 'required|email',
            'telefone' => 'required',
        ];

        if ($pessoa == Client::PESSOA_FISICA) {
            $estadosCivis = implode(',', array_keys(Client::ESTADOS_CIVIS));
            $rules = array_merge($rules, [
                'data_nasc' => 'required|date',
                'estado_civil' => "required|in:$estadosCivis",
                'sexo' => 'required|in:m,f'
            ]);
        } else {
            $rules = array_merge($rules, [
                'fantasia' => 'required',
            ]);
        }

        return $rules;

    }

    /*public function messages()
    {
       return [
           'nome.required' => "O campo nome é requerido",
           "nome.max" => "Para o campo nome é não permitido mais que 20 caracteres",
           "documento.documento" => "Documento não é válido"
       ];
    }*/


}
