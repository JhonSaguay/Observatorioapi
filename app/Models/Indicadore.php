<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

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

    public static function builder()
    {
        $rs = Indicadore::select('indicadores.nombre','indicadores.descripcion','indicadores.proveedor_dato','indicadores.temporalidad');
        return $rs;
    }
    public static function getIndicadorInfo($categoria)
    {
        $rs = self::builder();
        $rs->addSelect(DB::raw('ejes.nombre as eje'))
            ->addSelect(DB::raw('categorias.nombre as categoria'));
        $rs->join('categoria_indicadores', 'categoria_indicadores.codigo', '=', 'indicadores.categoria')
            ->join('categorias', 'categorias.id', '=', 'categoria_indicadores.categoria_id')
            ->join('ejes', 'ejes.id', '=', 'categoria_indicadores.eje_id');
        
        $rs->where('indicadores.categoria','=',$categoria)
            ->where('indicadores.active','=',1)->first();

        return $rs->get() ?? [];
    }

    
}
