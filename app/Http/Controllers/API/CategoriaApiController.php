<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;

class CategoriaApiController extends Controller
{
    //

    public function returnDataCategoriaSelect2()
    {
        // $eje=$request->get('id');
        $data = [];
        // $categorias= Categoria::where('eje_id','=',$eje)->get();
        $categorias=Categoria::all();
        foreach ($categorias as $categoria) {
            $data[] = [
                'id' => $categoria->id,
                'text' => $categoria->nombre
            ];
        }

        // return ['results' => $data];
        return ($data);
    }
    public function returnDataCategoriaAll()
    {
        $data = [];
        $categorias= Categoria::all();
       
        return ($categorias);
    }
    
}
