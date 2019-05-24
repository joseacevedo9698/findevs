<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use Illuminate\Http\Request;
use Validator;
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
}
