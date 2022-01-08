<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secuencia extends Model
{
    //
    protected $table = 'secuencias';
    protected $fillable = [
        "codigo_secuencia",
        "secuencia"
    ];

    public static function getCodigoSequence($value)
    {
        $rs = Secuencia::where('codigo_secuencia','=',$value)
        ->max('secuencia');

        return $rs ?? 0;
    }
}
