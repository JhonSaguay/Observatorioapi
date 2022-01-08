<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowIndicador extends Model
{
    //
    protected $table = 'follow_indicadores';
    protected $fillable = [
        "categoria_id",
        "indicador_id",
        "indicador_nombre",
        "action"
    
    ];
    public function categoria()
    {
        return $this->belongsTo(CategoriaIndicadore::class, 'categoria_id', 'codigo');
    }
    public function indicador()
    {
        return $this->belongsTo(Indicadore::class, 'indicador_id', 'id');
    }
}
