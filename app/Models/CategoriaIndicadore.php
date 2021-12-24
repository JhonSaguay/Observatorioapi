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
    
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/categoria-indicadores/'.$this->getKey());
    }

    
}
