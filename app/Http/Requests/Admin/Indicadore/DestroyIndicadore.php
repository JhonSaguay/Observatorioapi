<?php namespace App\Http\Requests\Admin\Indicadore;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DestroyIndicadore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.indicadore.delete', $this->indicadore);
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
