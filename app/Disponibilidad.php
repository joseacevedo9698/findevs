<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'Disponibilidad');
    }
}
