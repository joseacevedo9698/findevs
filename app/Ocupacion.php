<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'Ocupacion');
    }
}
