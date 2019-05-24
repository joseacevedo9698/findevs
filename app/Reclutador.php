<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclutador extends Model
{


    public function persona()
    {
        return $this->hasOne('App\Persona', 'id_persona');
    }
}
