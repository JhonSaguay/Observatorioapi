<?php namespace App\Http\Requests\Admin\Indicadore;

use Brackets\Translatable\TranslatableFormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateIndicadore extends TranslatableFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.indicadore.edit', $this->indicadore);
    }

/**
     * Get the validation rules that apply to the requests untranslatable fields.
     *
     * @return    array
     */
    public function untranslatableRules() {
        return [
            'nombre' => ['sometimes', 'string'],
            'categoria' => ['sometimes', 'string'],
            'tipo' => ['sometimes', 'boolean'],
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
            'datos_indicador' => ['sometimes', 'string'],
            
        ];
    }


    /**
    * Modify input data
    *
    * @return  array
    */
    public function getSanitized()
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }

}
