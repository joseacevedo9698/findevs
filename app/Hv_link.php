<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hv_link extends Model
{

    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'Link_HV');
    }
}
