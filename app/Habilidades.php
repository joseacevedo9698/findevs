<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilidades extends Model
{
    protected $table = 'habilidades';
    protected $fillable = ['Nombre_habilidad','Fecha_aprendizaje','Institucion','id_desarrollador'];
    protected $guarded = ['id'];
    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'id_desarrollador');
    }
}
