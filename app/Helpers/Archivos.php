<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\File;
use Storage;

class Archivos
{

    /**
     * @param string $nombre
     * @param File $archivo
     * @param string $disk
     * @return string
     */
    public static function storeImagen($nombre, $archivo, $disk)
    {
        $nombreArchivo = strtotime("now") . '_' . str_replace(" ", "_", $nombre) . '.' . $archivo->getClientOriginalExtension();
        Storage::disk($disk)->put($nombreArchivo, file_get_contents($archivo->getRealPath()));
        return $nombreArchivo;
    }

    /**
     * @param string $nombre
     * @param File $archivo
     * @param string $disk
     * @return string
     */
    public static function storeArchivoLibro($nombre, $archivo, $disk)
    {
        $nombreArchivo = strtotime("now") . '_' . str_replace(" ", "_", $nombre) . '.' . $archivo->getClientOriginalExtension();
        Storage::disk($disk)->put($nombreArchivo, file_get_contents($archivo->getRealPath()));
        return $nombreArchivo;
    }


    public static function validarUrlImagenIniciativa($imagen)
    {
        return Storage::disk('iniciativas')->exists($imagen) ? $imagen : false;
    }

}