<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|unique:tipo_usuario|max:30'
        ];

    }
}
