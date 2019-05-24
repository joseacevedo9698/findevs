<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hv_link extends Model
{
    protected $table = 'hv_links';
    protected $fillable = ['url', 'descripcion' , 'id_desarrollador'];
    protected $guarded = ['id'];

    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'id_desarrollador');
    }
}
