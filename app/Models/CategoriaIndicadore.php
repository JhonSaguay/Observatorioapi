<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaIndicadore extends Model
{
    
    protected $table = 'categoria_indicadores';
    protected $fillable = [
        "nombre",
        "codigo",
        "archivo_muestra",
        "archivo_json",
        "eje_id",
        "categoria_id"
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];

    public function follows()
    {
        return $this->hasMany('App\Models\FollowIndicador', 'categoria_id', 'codigo');

    }
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }
    public function ejes()
    {
        return $this->belongsTo(Eje::class, 'eje_id', 'id');
    }
    
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/categoria-indicadores/'.$this->getKey());
    }

    
}
