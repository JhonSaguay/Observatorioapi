<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Indicadore;
use Illuminate\Http\File;
use App\Models\Apidata;
use Illuminate\Support\Facades\DB;
use Storage;

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
        // todos los datos
        $array_indicador_all=array();
        $indicador_all=Indicadore::where('categoria','=',$categoria)->get();
        foreach ($indicador_all as $data){
            $array_data=array(
                "nombre"=>"Carga ".$data->id,
                "fechacarga"=>$data->created_at,
                "ultimacarga"=>$data->active,
                "formato"=>"csv",
                "linkapi"=> route('api.indicador.download',[$categoria,$data->id])
            );
            $array_indicador_all[]=$array_data;
        }
        $estructura=array( 
            "informacion" => $informacion, 
            "descargas_datos_originales" =>  $array_indicador_all,
            "datos" => $datos_indicador_ultimacarga
        ); 
        $estructuraJson=json_encode($estructura);
        return($estructuraJson);
    }

    public function getDataOldIndicadorEstructura($categoria,$indicador){
        // informacion indicador
        $informacion=Indicadore::getIndicadorInfo($categoria);
        // datos del indicador
        $indicadordata=Indicadore::findOrFail($indicador);
        $datos_indicador_ultimacarga=$indicadordata->datos_indicador ? $indicadordata->datos_indicador  : [];
        // todos los datos
        $array_indicador_all=array();
        $indicador_all=Indicadore::where('categoria','=',$categoria)->get();
        foreach ($indicador_all as $data){
            $array_data=array(
                "nombre"=>"Carga ".$data->id,
                "fechacarga"=>$data->created_at,
                "ultimacarga"=>$data->active,
                "linkapi"=> route('api.indicador.download',[$categoria,$data->id])
            );
            $array_indicador_all[]=$array_data;
        }
        $estructura=array( 
            "informacion" => $informacion, 
            "descargas_datos_originales" =>  $array_indicador_all,
            "datos" => $datos_indicador_ultimacarga
        ); 
        $estructuraJson=json_encode($estructura);
        return($estructuraJson);
    }

    public function download($categoria)
    {
        $nombre='indicador_'.$categoria.'.csv';
        $path=storage_path('app/public/indicadores/');
        $informacion=Indicadore::where('categoria','=',$categoria)->where('active','=',1)->first();
        if (!$informacion->fuente){
            if ($informacion->is_original_data){
                $jsonDecoded = json_decode($informacion->datos_indicador, true);  
                $fh = fopen($path.$nombre, 'w');
                if (is_array($jsonDecoded)) { 
                    foreach ($jsonDecoded as $line) {
                        $list_headers=array();
                        $cont=0;
                        foreach ($line as $key => $value) {  
                            $list_headers[]=$key; 
                        }
    
                        if (is_array($line)) {
                            if ($cont==0){
                                fputcsv($fh,$list_headers);
                            }
                            fputcsv($fh,$line);
                            $cont=$cont+1;
                        }
                    }
                }
                fclose($fh);
                $informacion->update(['fuente'=>$nombre]);
                return Storage::disk('indicadores')->download($nombre);
            }
            else{
                // $informacion_api=Apidata::where('categoria','=',$categoria)->get();
                $informacion_api=Apidata::all();
                $fh = fopen($path.$nombre, 'w');
                $cont=0;
                foreach ($informacion_api as $api_data){
                    $line=json_decode($api_data->datosjson, true);
                    $list_headers=array();
                    foreach ($line as $key => $value) {  
                        $list_headers[]=$key; 
                    }
                    if (is_array($line)) {
                        if ($cont==0){
                            fputcsv($fh,$list_headers);
                        }
                        fputcsv($fh,$line);
                        $cont=$cont+1;
                    }
                    
                }
                fclose($fh);
                $informacion->update(['fuente'=>$nombre]);
                return Storage::disk('indicadores')->download($nombre);
            }

        }
        return Storage::disk('indicadores')->download($informacion->fuente);
           
    }

    public function download_indicador($categoria,$indicador)
    {
        $nombre='indicador_'.$indicador.'.csv';
        $path=storage_path('app/public/indicadores/');
        $informacion=Indicadore::find($indicador);
        if (!$informacion->fuente){
            if ($informacion->is_original_data){
                $jsonDecoded = json_decode($informacion->datos_indicador, true);  
                $fh = fopen($path.$nombre, 'w');
                if (is_array($jsonDecoded)) { 
                    foreach ($jsonDecoded as $line) {
                        $list_headers=array();
                        $cont=0;
                        foreach ($line as $key => $value) {  
                            $list_headers[]=$key; 
                        }
    
                        if (is_array($line)) {
                            if ($cont==0){
                                fputcsv($fh,$list_headers);
                            }
                            fputcsv($fh,$line);
                            $cont=$cont+1;
                        }
                    }
                }
                fclose($fh);
                $informacion->update(['fuente'=>$nombre]);
                return Storage::disk('indicadores')->download($nombre);
            }
            else{
                // $informacion_api=Apidata::where('categoria','=',$categoria)->get();
                $informacion_api=Apidata::all();
                $fh = fopen($path.$nombre, 'w');
                $cont=0;
                foreach ($informacion_api as $api_data){
                    $line=json_decode($api_data->datosjson, true);
                    $list_headers=array();
                    foreach ($line as $key => $value) {  
                        $list_headers[]=$key; 
                    }
                    if (is_array($line)) {
                        if ($cont==0){
                            fputcsv($fh,$list_headers);
                        }
                        fputcsv($fh,$line);
                        $cont=$cont+1;
                    }
                    
                }
                fclose($fh);
                $informacion->update(['fuente'=>$nombre]);
                return Storage::disk('indicadores')->download($nombre);
            }

        }
        return Storage::disk('indicadores')->download($informacion->fuente);
           
    }
}
