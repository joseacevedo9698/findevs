<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiencia_laboral extends Model
{
    protected $table = 'experiencia_laborals';
    protected $fillable = ['id_desarrollador','Nombre_empresa','Cargo','Tiempo'];
    protected $guarded = ['id'];
    public function comments()
    {
        return $this->belongsTo('App\Desarrollador', 'id_desarrollador');
    }
}
