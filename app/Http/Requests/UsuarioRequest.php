<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpace;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nombre' => ['required', 'string', new AlphaSpace(),'max:255'],
            'documento' => ['required', 'string','max:255', "unique:usuarios,documento,{$this->id}"],
            'tipo_documento_id' => ['required', 'numeric', 'exists:tipo_documentos,id']
        ];
    }
}
