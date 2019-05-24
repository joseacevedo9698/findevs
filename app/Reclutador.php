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
}
