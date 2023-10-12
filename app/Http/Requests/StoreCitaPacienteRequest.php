<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitaPacienteRequest extends FormRequest
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
            'nombres' => 'required|min:4|regex:/^[a-zA-ZñÑ ]+$/u',
            'apellidos' => 'required|min:4|regex:/^[a-zA-ZñÑ ]+$/u',
            'telefono' => 'required|min:4|regex:/^[0-9+]+$/u',
            'fecha_nacimiento' => 'required',
            'ci' => 'required|unique:pacientes|min:5',
            'sexo' => 'required|',
            'direccion' => 'required|min:5',
            'referencia' => 'required|min:5',
            'fecha_registro' => 'required',
            'tipoConsulta_id' => 'required',
            'title' => 'required',
            'estadoConsulta_id' => 'required',
            'profesional_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'id' => 'required',
        ];
    }
}
