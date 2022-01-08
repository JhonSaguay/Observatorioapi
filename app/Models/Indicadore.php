<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Indicadore extends Model
{
    use HasTranslations;

    protected $table = 'indicadores';
    protected $fillable = [
        "nombre",
        "categoria",
        "tipo",
        "direccion_api",
        "nombre_archivo",
        "datos_indicador",
        "descripcion",
        "fuente",
        "proveedor_dato",
        "temporalidad",
        "active",
    ];
    public function categorias()
    {
        return $this->belongsTo(CategoriaIndicadore::class, 'categoria', 'codigo');
    }
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];
    
    // these attributes are translatable
    public $translatable = [
        "datos_indicador",
    
    ];
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/indicadores/'.$this->getKey());
    }

    
}
