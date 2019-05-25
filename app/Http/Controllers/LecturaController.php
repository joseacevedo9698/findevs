<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Desarrollador;
use App\Ocupacion;
use App\Disponibilidad;
use App\Habilidades;
use App\Persona;
use App\Reclutador;

class LecturaController extends Controller
{
    public function DesarrolladoresList(Request $request)
    {
        $reclutador = DB::table('reclutadors')->where('id_persona', $request->user()->id_persona)->count();
        if ($reclutador == 1) {
            $desarrollador = Desarrollador::with('hv_link', 'experiencia', 'habilidad', 'ocupacion', 'disponibilidad', 'persona')->get();
            return response()->json([
                'User' => $request->user(),
                'Desarrollador' => $desarrollador->all()
            ]);
        } else {
            return $this->NotAuth();
        }
    }

    public function DesarrolladoresListHabilidad(Request $request, $name)
    {

        if ($this->validateReclutador($request) == 1) {
            $habilidades = Habilidades::with('desarrollador')->where('Nombre_habilidad', $name)->get();
            return response()->json([
                'User' => $request->user(),
                'habilidades' => $habilidades->all()
            ]);
        } else {
            return $this->NotAuth();
        }
    }

    public function GetReclutador(Request $request, $id)
    {
        if ($this->validateReclutador($request) == 1) {
            $persona = DB::table('personas')->where('id', $id)->count();
            if ($persona == 1) {
                $reclutador = DB::table('reclutadors')->where('id_persona', $id)->get();
                return response()->json([
                    'User' => $request->user(),
                    'reclutador' => $reclutador,
                    'persona' => DB::table('personas')->where('id', $id)->get()
                ]);
            }
        } else {
            return $this->NotAuth();
        }
    }


    public function GetDesarrollador(Request $request, $id)
    {
        if ($this->validateReclutador($request) == 1) {
            $persona = DB::table('personas')->where('id', $id)->count();
            if ($persona == 1) {
                $desarrollador = DB::table('desarrolladors')->where('id', $id)->get();
                $count = DB::table('desarrolladors')->where('id', $id)->count();
                if ($count == 1) {
                    return response()->json([
                        'User' => $request->user(),
                        'desarrollador' => $desarrollador,
                        'persona' => DB::table('personas')->where('id', $id)->get()

                    ]);
                } else {
                    return response()->json([
                        'Error' => '101',
                        'Description' => 'Register Not Found'
                    ]);
                }
            }
        } else {
            return $this->NotAuth();
        }
    }
    protected function validateReclutador(Request $request)
    {
        return DB::table('reclutadors')->where('id_persona', $request->user()->id_persona)->count();
        # code...
    }

    public function ReclutarDesarrollador(Request $request, $id)
    {
        if ($this->validateReclutador($request) == 1) {

            $reclutador = Reclutador::findOrFail(1);
            $reclutador->desarrollador_observado()->attach($id, ['state' => true]);
            return response()->json('Success');
        } else {
            return $this->NotAuth();
        }
    }

    public function ObservarDesarrollador(Request $request, $id)
    {
        if ($this->validateReclutador($request) == 1) {

            $reclutador = Reclutador::findOrFail(1);
            $reclutador->desarrollador_observado()->attach($id, ['state' => false]);
            return response()->json('Success');
        } else {
            return $this->NotAuth();
        }
    }

    // public function updateDesarrollador(Request $request, $id)
    // {
    //     if ($this->validateReclutador($request) == 1) {

    //         $reclutador = Reclutador::findOrFail(1);
    //         $state = DB::table('desarrollo_observados')->where('id_reclutador', '=', $reclutador->id)->where('id_desarrollador','=',$id)->get();
    //         $state = $state->toJson();
    //         dd($state->toJson());
    //         $reclutador->desarrollador_observado()->updateExistingPivot($id, ['state' => '']);
    //         return response()->json('Success');
    //     } else {
    //         return $this->NotAuth();
    //     }
    // }
    public function NotAuth()
    {
        return response()->json([
            'Response' => 'Access Denied',
            'Description' => 'Is not a Reclutador',
            'Code_error' => '101'
        ]);
    }
}
