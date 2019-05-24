<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    protected $table = 'disponibilidads';
    protected $fillable = ['nombre_disponibilidad'];
    protected $guarded = ['id'];

    public function desarrollador()
    {
        return $this->hasOne('App\Desarrollador', 'Disponibilidad');
    }
}
