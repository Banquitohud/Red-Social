<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
       //$input = $request-> all();
       //se obtiene la imagen de l request
        $imagen = $request->file('file');

        //se crear una id unico para la imagen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //le decimos qu ela imagen que tenemos en servidor la obtenga
        $imagenServidor = Image::make($imagen);
        
        //se le dice que la imahen solo pude tener 1000x1000
        $imagenServidor->fit(1000, 1000);

        //secrala ruata de la imagen poner '.jpg' ya que solo sorta formatos .jpeg y .jpg
        $imagenPath = public_path('uploads') . '/' . $nombreImagen; //. '.jpg'

        // Verificar si la carpeta "uploads" existe, si no, crearla
        if (!file_exists(public_path('uploads'))) {
            mkdir(public_path('uploads'), 0777, true);
        }
        
       
        //le diceimos que la imagen que tenemos en servidor la guarde con el metodo save y le pasamos la ruta
        $imagenServidor->save($imagenPath);

       return response()->json(['imagen' => $nombreImagen]);
    }
}
