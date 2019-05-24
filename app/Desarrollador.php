<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Desarrollador extends Model
{


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
        return $this->hasOne('App\Hv_link', 'Link_HV');
    }

}
