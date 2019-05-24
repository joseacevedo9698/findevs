<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    protected $table = 'ocupacions';
    protected $fillable = ['nombre_ocupacion'];
    protected $guarded = ['id'];

    public function desarrollador()
    {
        return $this->hasOne('App\Desarrollador', 'Ocupacion');
    }
}
