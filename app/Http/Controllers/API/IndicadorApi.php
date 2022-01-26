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
    public function getDataIndicadorEstructura($categoria)
    {
        // informacion indicador
        $informacion=Indicadore::getIndicadorInfo($categoria);
        // datos del indicador
        $indicadordata=Indicadore::where('categoria','=',$categoria)->where('active','=',1)->first();
        $datos_indicador_ultimacarga=$indicadordata->datos_indicador ? $indicadordata->datos_indicador  : [];
        $estructura=array( 
            "informacion" => $informacion, 
            "datos_indicador_ultimacarga" => $datos_indicador_ultimacarga
        ); 
        $estructuraJson=json_encode($estructura);
        return($estructuraJson);
    }
}
