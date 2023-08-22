<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tipo_consulta_id' => 'required',
            'title' => 'required|min:4',
            'estado_cita_id' => 'required',
            'profesional_id' => 'required',
            'paciente_id' => 'required',
        ];
    }
}
