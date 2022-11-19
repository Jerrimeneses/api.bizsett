<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            
            'nombre'=>'Required|max:20',
            'apellidos'=>'Required',
            'email'=>'Required',
            'password'=>'Required',
            'numero_documento'=>'Required',
        ];
    }

    public function attributes()
    {
        return [
            'nombre'=>'nombre del ususario',
        ];
    }

    public function messages()
    {
        return[
            'nombre.required'=>'Debe ingresar un nombre',
            'apellidos.required'=>'Debe ingresar al menos un apellido',
            'email.required'=>'Debe ingresar un correo electrónico',
            'password.required'=>'Debe ingresar una contraseña',
            'numero_documento.required'=>'Debe ingresar un número de documento',
        ];
    }
}
