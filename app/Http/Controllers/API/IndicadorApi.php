<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Indicadore;

class IndicadorApi extends Controller
{
    //
    public function getDataIndicador()
    {
        $indicadordata=Indicadore::find('1');
        return ($result = $indicadordata->datos_indicador ) ? $result : [];
    }
}
