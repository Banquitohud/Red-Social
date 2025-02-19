<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $request->request->add(['username' => Str::slug($request->username)]);

        //validaciones
        $this->validate($request, [
            'name' => 'required|min:3|max:30',  // tambiuen puden ser asi ['required','min:5']
            'username' => 'required|unique:users|min:5|max:15',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:8|max:12'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
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

    public function updatephotho(Request $request)
    {
        // Validación de la imagen
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        // Si el usuario ya tiene una foto, eliminar la anterior
        if ($user->photo_url) {
            Storage::disk('public')->delete($user->photo_url);
        }

        // Obtener la imagen del request
        $imagen = $request->file('photo');

        // Generar un nombre único para la imagen
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        // Procesar la imagen con Intervention Image
        $imagenServidor = Image::make($imagen)->fit(1000, 1000);

        // Definir la ruta de almacenamiento
        $imagenPath = public_path('uploads/profile_pictures/' . $nombreImagen);

        // Verificar si la carpeta "uploads/profile_pictures" existe, si no, crearla
        if (!file_exists(public_path('uploads/profile_pictures'))) {
            mkdir(public_path('uploads/profile_pictures'), 0777, true);
        }

        // Guardar la imagen en el servidor
        $imagenServidor->save($imagenPath);
        $user->update(['Photo_url' => 'uploads/profile_pictures/' . $nombreImagen]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

}
