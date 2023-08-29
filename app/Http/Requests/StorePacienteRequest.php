<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
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
            //nombres, apellidos, telefono, fecha_nacimiento, ci, sexo, direccion
            'nombres' => 'required|min:4|regex:/^[a-zA-Z ]+$/u',
            'apellidos' => 'required|min:4|regex:/^[a-zA-Z ]+$/u',
            'telefono' => 'required|min:4|regex:/^[0-9+]+$/u',
            'fecha_nacimiento' => 'required',
            'ci' => 'required|unique:pacientes|min:5',
            'sexo' => 'required|',
            'direccion' => 'required|min:5',
            'fecha_registro' => 'required',
        ];
    }
}
