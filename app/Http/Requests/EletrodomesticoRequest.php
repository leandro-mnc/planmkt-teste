<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class EletrodomesticoRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        $rules = [];

        if (in_array(request()->method(), ['PUT', 'POST'])) {
            $rules = [
                'nome' => 'required|max:100',
                'descricao' => 'max:255',
                'tensao' => [ 'required', Rule::in('110v', '220v', 'Bivolt')],
                'status' => [ 'required', Rule::in('ativo', 'inativo')],
                'marca' => 'required|exists:marca,codigo'
            ];
        }

        if (request()->isMethod('PUT') === true) {
            $this->merge(['id' => request()->route('eletrodomestico')]);
            $rules['id'] = 'required|exists:eletrodomestico,id';
        }
        
        return $rules;
    }

    public function messages(): array {
        return [
            'id.required' => 'Identificador obrigatório',
            'id.exists' => 'Eletrodoméstico não encontrado',
            'nome.required' => 'Nome é obrigatório',
            'nome.max' => 'Nome precisa ter até 100 caracteres',
            'descricao.max' => 'Descrição precisa ter no máximo 255 caracteres',
            'tensao.required' => 'Tensão é obrigatório',
            'tensao.in' => 'Tensão precisa ser 110v, 220v ou Bivolt',
            'status.required' => 'Status é obrigatório',
            'status.in' => 'Status so pode ser ativo ou inativo',
            'marca.required' => 'Marca é obrigatório',
            'marca.exists' => 'Marca não existe',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'status' => 'error',
            'messages' => $validator->errors()
        ], 402);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
