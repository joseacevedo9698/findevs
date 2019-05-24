<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Desarrollador extends Model
{
    protected $table = 'desarrolladors';
    protected $fillable = ['id_persona', 'Ocupacion','Disponibilidad','Link_HV'];
    protected $guarded = ['id'];


    public function persona()
    {
        return $this->hasone('App\Persona', 'id_persona');
    }
    public function ocupacion()
    {
        return $this->hasOne('App\Ocupacion', 'Ocupacion');
    }

    public function disponibilidad()
    {
        return $this->hasOne('App\Disponibilidad', 'Disponibilidad', 'id');
    }

    public function hv_link()
    {
        return $this->hasMany('App\Hv_link', 'id_desarrollador');
    }

    public function Experiencia()
    {
        return $this->hasMany('App\Experiencia_laboral', 'id_desarrollador');
    }
    public function Habilidad()
    {
        return $this->hasMany('App\Habilidades', 'id_desarrollador');
    }
}
