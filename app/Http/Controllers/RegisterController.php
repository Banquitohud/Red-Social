<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Hash; //para hashear password

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //acceder a ala informacion de del request
        //dd($req); //acceder a todo
        //dd($request->get('email'));//acceder a una 

        //modificar el request
        $request->request->add(['username'=>Str::slug($request->username)]);

        //validaciones
        $this->validate($request, [
            'name'=>'required|min:3|max:30',  // tambiuen puden ser asi ['required','min:5']  
            'username'=>'required|unique:users|min:5|max:15',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:8|max:12'
        ]);
        
        User::create([
            'name'=> $request->name,
            'username'=>$request->username,
            'email'=> $request->email,
            'password'=>$request->password
            //'password'=>Hash::make($request->password)
        ]);

        //Autenticar a un usuario
        /*utlizamos un helper que laravel que se llama auth para autentificar al usuario
        extrallendo el email y la contraseña
        */
        /*auth()->attempt([
            'email'=>$request->email,
           'password'=>$request->password
        ]);*/

        //otra forma de autentificar
        auth()->attempt($request->only('email', 'password'));

        //redireccionado 
        /*rediceccionamos a la ruta posts para mandarle la informacion del
         * usuario autentificado 
         */
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
