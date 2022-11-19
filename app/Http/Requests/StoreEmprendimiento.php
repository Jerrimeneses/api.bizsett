<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmprendimiento extends FormRequest
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
            
            'nombre'=>'Required|max:30',
            'categoria'=>'Required',
            'descripcion'=>'Required',

        ];
    }

    public function attributes()
    {
        return [
            
        ];
    }

    public function messages()
    {
        return[
            'nombre.required'=>'Debe ingresar un nombre para el emprendimiento',
            'categoria.required'=>'Debe ingresar una categoría',
            'descripcion.required'=>'Debe ingresar una descripción',

        ];
    }
}
