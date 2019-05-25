<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use App\Desarrollador;
use App\Experiencia_laboral;
use App\Hv_link;
use App\Habilidades;
use Illuminate\Http\Request;
use Validator;
use App\Reclutador;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
         $rules = [
             'nombres' =>'required|string|min:3|max:60',
             'apellidos' =>'required|string|min:3|max:60',
             'fecha'=> 'required|date',
             'telefono'=>'required|Numeric|min:10',
             'email'=> 'required|email|unique:users',
             'password' => 'required|min:4|max:60',
             'password_confirmation'=>'required|same:password',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return $validator->messages()->first();
        }else{


            $persona = new Persona();
            $persona->Nombres = $request->input('nombres');
            $persona->Apellidos = $request->input('apellidos');
            $persona->Fecha_nacimiento = $request->input('fecha');
            $persona->Correo = $request->input('email');
            $persona->Telefono = $request->input('telefono');
            $id = $persona->id;
            if ($request->file('myFile')) {
                $path = Storage::disk('public')->put('image',$request->file('foto'));
                $persona->Foto_perfil = asset($path);
            }else{
                $persona->Foto_perfil = 'null';
            }
            $persona->save();

            $user = new User();
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->remember_token = str_random(60);
            $persona->user()->save($user);
            $user->save();
            $tipo = $request->input('tipo');
            if ($tipo==1) {
                return "hola";
                $experiencia=[
                    [
                        'Nombre_empresa' => 'apps.co',
                        'Cargo' => 'Gerente',
                        'Tiempo' => '2014/05/08'
                    ]
                    ];
                $proyectos=[
                    [
                        'url' => 'comics-gaia.test',
                        'descripcion' => 'esta es una descripcion'
                    ]
                    ];
                $habilidades=[
                    [
                        'Nombre_habilidad' => 'PHP',
                        'Fecha' => '2019/06/05',
                        'Institucion' => 'Centro Inca'
                    ]
                    ];
                $ocupacion =$request->input('ocupacion');
                $disponibilidad =$request->input('disponibilidad');
                $link_HV =$request->input('link_HV');
                $this->insertdesarrollador($persona->id,$experiencia,$ocupacion,$disponibilidad,$habilidades,$link_HV,$proyectos);
            }else{
                if ($tipo == 0) {
                    $this->insertReclutador($persona->id,$request->input('empresa'),$request->input('puesto'));
                }
            }



            return "success";
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }

    public function insertdesarrollador($id_persona,$experiencia,$ocupacion,$disponibilidad,$habilidades,$link_HV,$proyectos)
    {
        $desarrollador = new Desarrollador();
        $desarrollador->id_persona = $id_persona;
        $desarrollador->Ocupacion = $ocupacion;
        $desarrollador->Disponibilidad = $disponibilidad;
        $desarrollador->Link_HV = $link_HV;
        $desarrollador->save();

        $this->inserthabilidades($habilidades,$desarrollador->id);

        $this->insertexperiencia($experiencia,$desarrollador->id);

        $this->insertproyectos($proyectos,$desarrollador->id);



    }

    public function insertexperiencia($experiencias, $id_desarrollador)
    {
        if(!empty($experiencias)){
            foreach ($experiencias as $h) {
                $experiencia = new Experiencia_laboral();
                $experiencia->Nombre_empresa = $h['Nombre_empresa'];
                $experiencia->Cargo = $h['Cargo'];
                $experiencia->Tiempo = $h['Tiempo'];
                $experiencia->id_desarrollador = $id_desarrollador;
                $experiencia->save();
            }
            return true;
        }
        return false;
    }

    public function inserthabilidades($habilidades, $id_desarrollador)
    {
        if(!empty($habilidades)){
            foreach ($habilidades as $h) {
                $habilidad = new Habilidades();
                $habilidad->Nombre_habilidad = $h['Nombre_habilidad'];
                $habilidad->Fecha_aprendizaje = $h['Fecha'];
                $habilidad->Institucion = $h['Institucion'];
                $habilidad->id_desarrollador = $id_desarrollador;
                $habilidad->save();
            }
            return true;
        }
        return false;
    }

    public function insertproyectos($proyectos, $id_desarrollador)
    {
        if(!empty($proyectos)){
            foreach ($proyectos as $h) {
                $proyecto = new Hv_link();
                $proyecto->url = $h['url'];
                $proyecto->descripcion = $h['descripcion'];
                $proyecto->id_desarrollador = $id_desarrollador;
                $proyecto->save();
            }
            return true;
        }
        return false;
    }

    public function insertReclutador($id_persona,$empresa,$puesto)
    {
        $reclutador = new Reclutador();
        $reclutador->id_persona = $id_persona;
        $reclutador->empresa = $empresa;
        $reclutador->puesto = $puesto;
        $reclutador->save();
    }

}
