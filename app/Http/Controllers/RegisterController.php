<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd('Creando Usuario...'); //funcion para imprimir datos en pantalla para debuguear


        //Modificar el Request para evitar el username duplicado

        $request->request->add(['username' => Str::slug($request->username)]);


        //Validacion de los campos 

        $this->validate($request, [

            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',

        ]);

        //Registro de Usuarios

        User::create([
            'name' => $request->name,
            'username' => $request->username, //slug guarda el texto como si fuese una url para eliminar los espacios
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticar el usuario

        /*auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);*/

        //otra forma de autenticar

        auth()->attempt($request->only('email', 'password'));

        //redireccionar al usuario una vez creado el usuario

        return redirect()->route('posts.index');
    }
}
