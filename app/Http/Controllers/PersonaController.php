<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use Illuminate\Http\Request;

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
        $credentials = $this->validate(request(),[
            'nombres' =>'required|string|min:3|max:60',
            'apéllidos' =>'required|string|min:3|max:60',
            'fecha'=> 'required|date',
            'telefono'=>'required|Numeric|min:10|max:12',
            'name' => 'required|string|min:3|max:60',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:4|max:60',
            'password_confirmation'=>'required|same:password',

        ]);


         if ($credentials) {
            $persona = new Persona();
            $persona->Nombres = $request->input('nombres');
            $persona->Apellidos = $request->input('apellidos');
            $persona->Fecha_nacimiento = $request->input('fecha');
            $persona->Correo = $request->input('email');
            $persona->Telefono = $request->input('telefono');
            $persona->Foto_perfil = $request->input('foto');
            $user = new User($request->all());

            $user->remember_token = str_random(60);
            $user->password = bcrypt($user->password);
            $user->save();
         }

        return back()
        ->withErrors(['email' => trans('auth.failed'),
        'password' => trans('auth.failed'),
        'password_confirmation' => trans('auth.failed')]);
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
