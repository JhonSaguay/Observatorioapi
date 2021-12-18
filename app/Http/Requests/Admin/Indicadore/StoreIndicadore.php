<?php namespace App\Http\Requests\Admin\Indicadore;

use Brackets\Translatable\TranslatableFormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreIndicadore extends TranslatableFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.indicadore.create');
    }

/**
     * Get the validation rules that apply to the requests untranslatable fields.
     *
     * @return    array
     */
    public function untranslatableRules() {
        return [
            'nombre' => ['required', 'string'],
            'categoria' => ['required', 'string'],
            'tipo' => ['required', 'boolean'],
            'direccion_api' => ['nullable', 'string'],
            'nombre_archivo' => ['nullable', 'string'],
            
        ];
    }

    /**
     * Get the validation rules that apply to the requests translatable fields.
     *
     * @return    array
     */
    public function translatableRules($locale) {
        return [
            'datos_indicador' => ['required', 'string'],
            
        ];
    }
}
