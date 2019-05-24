<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['Nombres', 'Apellidos','Fecha_nacimiento','Correo','Telefono','Foto_perfil'];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_persona');
    }
    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'id_persona');
    }
    public function reclutador()
    {
        return $this->belongsTo('App\Reclutador', 'id_persona');
    }
}
