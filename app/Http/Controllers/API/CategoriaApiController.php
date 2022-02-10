<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;

class CategoriaApiController extends Controller
{
    //

    public function returnDataCategoriaSelect2(Request $request)
    {
        $eje=$request->get('id');
        $data = [];
        $categorias= Categoria::where('eje_id','=',$eje)->get();
       
        // foreach ($categorias as $categoria) {
        //     $data[] = [
        //         'id' => $categoria->id,
        //         'text' => $categoria->name
        //     ];
        // }

        // return ['results' => $data];
        return ($categorias);
    }
    public function returnDataCategoriaAll()
    {
        $data = [];
        $categorias= Categoria::all();
       
        return ($categorias);
    }
    
}
