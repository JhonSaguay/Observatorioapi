<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriaIndicadore;

class CategoriaIndicadorApiController extends Controller
{
    //
    public function returnVariablesSelect2(Request $request)
    {
        // return('entro');
        $codigo=$request->get('codigo');
        $data = [];
        $categoria_data=CategoriaIndicadore::where('codigo','=',$codigo)->first();
        if ($categoria_data){
            if ($categoria_data->variables){

                $array=json_decode($categoria_data->variables);
                foreach ($array->variables as $variable){
                    $data[] = [
                                'id' => $variable,
                                'text' => $variable
                            ];
                }
                return(
                    $data
                );
            }
        }
        return ([]);
    }
}
