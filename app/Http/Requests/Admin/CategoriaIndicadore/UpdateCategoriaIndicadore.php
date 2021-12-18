<?php namespace App\Http\Requests\Admin\CategoriaIndicadore;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateCategoriaIndicadore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.categoria-indicadore.edit', $this->categoriaIndicadore);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'nombre' => ['sometimes', 'string'],
                        'codigo' => ['sometimes', 'string'],
                        'archivo_muestra' => ['nullable', 'string'],
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
