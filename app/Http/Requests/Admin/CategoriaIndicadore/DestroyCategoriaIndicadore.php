<?php namespace App\Http\Requests\Admin\CategoriaIndicadore;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DestroyCategoriaIndicadore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.categoria-indicadore.delete', $this->categoriaIndicadore);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [];
    }
}
