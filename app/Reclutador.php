<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclutador extends Model
{
    protected $table = 'reclutadors';
    protected $fillable = ['id_persona', 'empresa','puesto'];
    protected $guarded = ['id'];


    public function persona()
    {
        return $this->hasOne('App\Persona', 'id_persona');
    }

    public function desarrollador_observado()
    {
        return $this->belongsToMany('App\Desarrollador', 'desarrollo_observados', 'id_reclutador', 'id_desarrollador');
    }
}
