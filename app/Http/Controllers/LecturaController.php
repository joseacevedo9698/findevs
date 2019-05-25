<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Desarrollador;
use App\Ocupacion;
use App\Disponibilidad;
use App\Habilidades;

class LecturaController extends Controller
{
    public function DesarrolladoresList(Request $request)
    {
        $reclutador = DB::table('reclutadors')->where('id_persona',$request->user()->id_persona)->count();
        if ($reclutador == 1) {
            $desarrollador = Desarrollador::with('hv_link','experiencia','habilidad','ocupacion','disponibilidad','persona')->get();
            return response()->json([
                'User'=>$request->user(),
                'Desarrollador'=> $desarrollador->all()
            ]);
        }else{
            return response()->json([
                'Response' => 'Access Denied',
                'Description'=>'Is not a Reclutador',
                'Code_error' => '401'
            ]);
        }
    }

    public function DesarrolladoresListHabilidad(Request $request,$name)
    {
        $reclutador = DB::table('reclutadors')->where('id_persona',$request->user()->id_persona)->count();
        if ($reclutador == 1) {
            $habilidades = Habilidades::with('desarrollador')->where('Nombre_habilidad',$name)->get();
            return response()->json([
                'User'=>$request->user(),
                'habilidades'=> $habilidades->all()
            ]);
        }else{
            return response()->json([
                'Response' => 'Access Denied',
                'Description'=>'Is not a Reclutador',
                'Code_error' => '401'
            ]);
        }
    }


}
