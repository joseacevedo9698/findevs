<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Desarrollador;
use App\Ocupacion;
use App\Disponibilidad;

class LecturaController extends Controller
{
    public function DesarrolladoresList(Request $request)
    {
        $reclutador = DB::table('reclutadors')->count();
        if ($reclutador == 1) {
            $desarrollador = Desarrollador::with('hv_link','experiencia','habilidad','ocupacion','disponibilidad','persona')->get();
            return response()->json([
                'User'=>$request->user(),

               'Desarrollador'=> $desarrollador->all()
            ]);
        }
    }
}
