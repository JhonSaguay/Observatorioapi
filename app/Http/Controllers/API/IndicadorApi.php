<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Indicadore;

class IndicadorApi extends Controller
{
    //
    public function getDataIndicador($categoria)
    {
        $indicadordata=Indicadore::where('categoria','=',$categoria)->where('active','=',1)->first();
        return ($result = $indicadordata->datos_indicador ) ? $result : [];
    }
}
